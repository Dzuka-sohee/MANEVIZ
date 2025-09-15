<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
    
    // Disable create page since orders should be created by customers
    public function mount(): void
    {
        abort(403, 'Orders cannot be created manually. They are created by customers.');
    }
}