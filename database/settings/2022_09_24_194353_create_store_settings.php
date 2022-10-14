<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateStoreSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('store.store_name', 'Storeify');
        $this->migrator->add('store.store_logo', '');
        $this->migrator->add('store.store_address', 'No.67 & 68 FLHE Arkilla SOKOTO');
        $this->migrator->add('store.currency', '&#8358;');
        $this->migrator->add('store.sell_margin', '1.5');
    }
}
