<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateStoreSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('store.store_name', 'Storeify');
        $this->migrator->add('store.store_logo', '');
        $this->migrator->add('store.store_address', 'No.67 & 68 FLHE Arkilla SOKOTO');
    }
}
