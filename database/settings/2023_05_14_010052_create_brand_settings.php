<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('brand.slogan', 'Somos tu mejor solucion!.');
        $this->migrator->add('brand.short_description', 'Hacemos mas faciles tus compras y facturas.');
        $this->migrator->add('brand.logo_path', '');
        $this->migrator->add('brand.favicon_path', '');
        $this->migrator->add('brand.cover_path', '');
        $this->migrator->add('brand.social_links', [
            [
                'name' => 'Facebook',
                'url' => '',
                'url_placeholder' => 'https://facebook.com/cartify',
            ],
            [
                'name' => 'Twitter',
                'url' => '',
                'url_placeholder' => 'https://twitter.com/cartify',
            ],
            [
                'name' => 'Pinterest',
                'url' => '',
                'url_placeholder' => 'https://pinterest.com/cartify',
            ],
            [
                'name' => 'Instagram',
                'url' => '',
                'url_placeholder' => 'https://instagram.com/cartify',
            ],
            [
                'name' => 'TikTok',
                'url' => '',
                'url_placeholder' => 'https://tiktok.com/@cartify',
            ],
            [
                'name' => 'Tumblr',
                'url' => '',
                'url_placeholder' => 'https://cartify.tumblr.com',
            ],
            [
                'name' => 'Snapchat',
                'url' => '',
                'url_placeholder' => 'https://snapchat.com/add/cartify',
            ],
            [
                'name' => 'YouTube',
                'url' => '',
                'url_placeholder' => 'https://youtube.com/c/cartify',
            ],
            [
                'name' => 'Vimeo',
                'url' => '',
                'url_placeholder' => 'https://vimeo.com/cartify',
            ],
        ]);
    }

    public function down()
    {
        $this->migrator->deleteIfExists('brand.slogan');
        $this->migrator->deleteIfExists('brand.short_description');
        $this->migrator->deleteIfExists('brand.logo_path');
        $this->migrator->deleteIfExists('brand.favicon_path');
        $this->migrator->deleteIfExists('brand.cover_path');
        $this->migrator->deleteIfExists('brand.socials');
    }
};
