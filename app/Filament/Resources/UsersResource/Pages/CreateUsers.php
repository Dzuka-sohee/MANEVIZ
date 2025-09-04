<?php

namespace App\Filament\Resources\UsersResource\Pages;

use App\Filament\Resources\UsersResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUsers extends CreateRecord
{
    protected static string $resource = UsersResource::class;

    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman index setelah create
        return $this->getResource()::getUrl('index');

        // Kalau mau ke rute custom
        // return route('dashboard');
    }
}
