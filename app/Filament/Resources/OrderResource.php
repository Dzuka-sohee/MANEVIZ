<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Orders Management';

    protected static ?string $modelLabel = 'Order';

    protected static ?string $pluralModelLabel = 'Orders';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Order Information')
                    ->schema([
                        Forms\Components\TextInput::make('order_number')
                            ->label('Order Number')
                            ->disabled()
                            ->columnSpanFull(),
                        
                        Forms\Components\Select::make('status')
                            ->label('Order Status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state === 'shipped') {
                                    $set('shipped_date', now());
                                } elseif ($state === 'delivered') {
                                    $set('delivered_date', now());
                                    $set('shipped_date', now()); // Ensure shipped_date is set
                                }
                            }),
                        
                        Forms\Components\Select::make('payment_status')
                            ->label('Payment Status')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'failed' => 'Failed',
                            ])
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Customer Information')
                    ->schema([
                        Forms\Components\TextInput::make('user.name')
                            ->label('Customer Name')
                            ->disabled(),
                        
                        Forms\Components\TextInput::make('user.email')
                            ->label('Customer Email')
                            ->disabled(),
                        
                        Forms\Components\TextInput::make('shipping_name')
                            ->label('Shipping Name')
                            ->disabled(),
                        
                        Forms\Components\Textarea::make('shipping_address')
                            ->label('Shipping Address')
                            ->disabled()
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Order Details')
                    ->schema([
                        Forms\Components\TextInput::make('total_amount')
                            ->label('Subtotal')
                            ->disabled()
                            ->prefix('IDR')
                            ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.')),
                        
                        Forms\Components\TextInput::make('shipping_cost')
                            ->label('Shipping Cost')
                            ->disabled()
                            ->prefix('IDR')
                            ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.')),
                        
                        Forms\Components\TextInput::make('grand_total')
                            ->label('Grand Total')
                            ->disabled()
                            ->prefix('IDR')
                            ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.')),
                        
                        Forms\Components\TextInput::make('payment_method')
                            ->label('Payment Method')
                            ->disabled()
                            ->formatStateUsing(function ($state) {
                                $methods = [
                                    'bank_transfer' => 'Bank Transfer',
                                    'credit_card' => 'Credit Card',
                                    'ewallet' => 'E-Wallet',
                                    'cod' => 'Cash on Delivery (COD)',
                                ];
                                return $methods[$state] ?? $state;
                            }),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Forms\Components\Section::make('Tracking Information')
                    ->schema([
                        Forms\Components\DateTimePicker::make('order_date')
                            ->label('Order Date')
                            ->disabled(),
                        
                        Forms\Components\DateTimePicker::make('shipped_date')
                            ->label('Shipped Date')
                            ->helperText('Automatically filled when status is set to shipped'),
                        
                        Forms\Components\DateTimePicker::make('delivered_date')
                            ->label('Delivered Date')
                            ->helperText('Automatically filled when status is set to delivered'),
                    ])
                    ->columns(3)
                    ->collapsible(),

                Forms\Components\Section::make('Notes')
                    ->schema([
                        Forms\Components\Textarea::make('notes')
                            ->label('Order Notes')
                            ->disabled()
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('Order Number')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Order number copied')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'primary' => 'processing',
                        'info' => 'shipped',
                        'success' => 'delivered',
                        'danger' => 'cancelled',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                        default => $state,
                    }),

                Tables\Columns\BadgeColumn::make('payment_status')
                    ->label('Payment')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger' => 'failed',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('grand_total')
                    ->label('Total')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('order_date')
                    ->label('Order Date')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('orderItems_count')
                    ->label('Items')
                    ->counts('orderItems')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->formatStateUsing(function ($state) {
                        $methods = [
                            'bank_transfer' => 'Bank Transfer',
                            'credit_card' => 'Credit Card',
                            'ewallet' => 'E-Wallet',
                            'cod' => 'COD',
                        ];
                        return $methods[$state] ?? $state;
                    })
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('transaction_id')
                    ->label('Transaction ID')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Order Status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ]),

                Tables\Filters\SelectFilter::make('payment_status')
                    ->label('Payment Status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                    ]),

                Tables\Filters\SelectFilter::make('payment_method')
                    ->label('Payment Method')
                    ->options([
                        'bank_transfer' => 'Bank Transfer',
                        'credit_card' => 'Credit Card',
                        'ewallet' => 'E-Wallet',
                        'cod' => 'Cash on Delivery',
                    ]),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Order Date From'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Order Date Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('order_date', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('order_date', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                
                Tables\Actions\Action::make('updateStatus')
                    ->label('Update Status')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->label('New Status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'shipped' => 'Shipped',
                                'delivered' => 'Delivered',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data, Order $record): void {
                        $oldStatus = $record->status;
                        
                        $updates = ['status' => $data['status']];
                        
                        // Auto-fill dates based on status
                        if ($data['status'] === 'shipped' && !$record->shipped_date) {
                            $updates['shipped_date'] = now();
                        }
                        
                        if ($data['status'] === 'delivered') {
                            if (!$record->delivered_date) {
                                $updates['delivered_date'] = now();
                            }
                            if (!$record->shipped_date) {
                                $updates['shipped_date'] = now();
                            }
                        }
                        
                        $record->update($updates);
                        
                        Notification::make()
                            ->title('Status Updated Successfully')
                            ->body("Order {$record->order_number} status changed from {$oldStatus} to {$data['status']}")
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('viewItems')
                    ->label('View Items')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->modalHeading(fn (Order $record): string => "Items in Order {$record->order_number}")
                    ->modalContent(fn (Order $record) => view('filament.order-items-modal', ['order' => $record]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('updateStatusBulk')
                        ->label('Update Status')
                        ->icon('heroicon-o-arrow-path')
                        ->color('warning')
                        ->form([
                            Forms\Components\Select::make('status')
                                ->label('New Status')
                                ->options([
                                    'pending' => 'Pending',
                                    'processing' => 'Processing',
                                    'shipped' => 'Shipped',
                                    'delivered' => 'Delivered',
                                    'cancelled' => 'Cancelled',
                                ])
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            $count = 0;
                            foreach ($records as $record) {
                                $updates = ['status' => $data['status']];
                                
                                if ($data['status'] === 'shipped' && !$record->shipped_date) {
                                    $updates['shipped_date'] = now();
                                }
                                
                                if ($data['status'] === 'delivered') {
                                    if (!$record->delivered_date) {
                                        $updates['delivered_date'] = now();
                                    }
                                    if (!$record->shipped_date) {
                                        $updates['shipped_date'] = now();
                                    }
                                }
                                
                                $record->update($updates);
                                $count++;
                            }
                            
                            Notification::make()
                                ->title('Bulk Status Update')
                                ->body("Successfully updated {$count} orders to {$data['status']} status")
                                ->success()
                                ->send();
                        }),
                ]),
            ])
            ->defaultSort('order_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['user', 'orderItems.product'])
            ->withCount('orderItems');
    }
}