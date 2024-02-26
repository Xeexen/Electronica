<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('template.home_page_title', 'Electronica.');
        $this->migrator->add('template.home_page_description', 'Aqui encontraras todo lo que necesitas!.');
        $this->migrator->add('template.home_page_hero_carousel_handle', '');
        $this->migrator->add('template.home_page_perk_carousel_handle', '');
        $this->migrator->add('template.home_page_sections', []);
    }

    public function down()
    {
        $this->migrator->deleteIfExists('template.home_page_title');
        $this->migrator->deleteIfExists('template.home_page_description');
        $this->migrator->deleteIfExists('template.home_page_hero_carousel_handle');
        $this->migrator->deleteIfExists('template.home_page_perk_carousel_handle');
        $this->migrator->deleteIfExists('template.home_page_sections');
    }
};
