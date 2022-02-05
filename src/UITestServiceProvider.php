<?php
/*
This file is part of SeAT

Copyright (C) 2015 to 2020  Leon Jacobs

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/
namespace BUSAGit\Seat\UI-Test;

use Seat\Services\AbstractSeatPlugin;

/**
 * Class CalendarServiceProvider.
 * @package Seat\Kassie\Calendar
 */
class UITestServiceProvider extends AbstractSeatPlugin
{
    public function boot()
    {
        $this->add_routes();
		
		// Uncomment this block to add API documentation
        // $this->add_api_endpoints();
		
        $this->add_publications();

        $this->add_views();

        //$this->add_translations();

        $this->add_migrations();
		
		// Uncomment this block to extend imported SDE tables
        // $this->add_sde_tables();
    }

    public function register()
    {
		$this->mergeConfigFrom(__DIR__ . '/Config/UI-Test.config.php', 'UI-Test.config');
        $this->mergeConfigFrom(__DIR__ . '/Config/UI-Test.locale.php', 'UI-Test.locale');

		// Overload sidebar with your package menu entries
        $this->mergeConfigFrom(__DIR__ . '/Config/Menu/package.sidebar.php', 'package.sidebar');
		
		// Uncomment this block to overload character menu
        // $this->mergeConfigFrom(__DIR__ . '/Config/Menu/package.character.php', 'package.character.menu');

        // Uncomment this block to overload corporation menu
        // $this->mergeConfigFrom(__DIR__ . '/Config/Menu/package.corporation.php', 'package.corporation.menu');

        // Register generic permissions
        $this->registerPermissions(__DIR__ . '/Config/Permissions/other.php', 'other');

        // Uncomment this block to register character permissions
        // $this->registerPermissions(__DIR__ . '/Config/Permissions/character.php', 'character');

        // Uncomment this block to register corporation permissions
        // $this->registerPermissions(__DIR__ . '/Config/Permissions/corporation.php', 'corporation');
    }

     /**
     * Include routes.
     */
    private function add_routes()
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }
	
	/**
     * Import API annotations used to generate Swagger documentation (using Open Api Specifications syntax).
     */
    private function add_api_endpoints()
    {
        $this->registerApiAnnotationsPath([
            __DIR__ . '/Http/Resources',
            __DIR__ . '/Http/Controllers/Api/V2',
        ]);
    }
	
	 /**
     * Add content which must be published (generally, configuration files or static ones).
     */
    private function add_publications()
    {
        $this->publishes([
            __DIR__ . '/resources/css' => public_path('web/css')
            //__DIR__ . '/resources/img' => public_path('UI-Test/img'),
            //__DIR__ . '/resources/js' => public_path('UI-Test/js'),
        ], ['public', 'seat']);
    }
	
    /**
     * Import views.
     */
    private function add_views()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'UI-Test');
    }

    /**
     * Import translations.
     */
    private function add_translations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'UI-Test');
    }

    /**
     * Import database migrations.
     */
    private function add_migrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations/');
    }

    private function addCommands() 
    {
    }

	/**
     * Add SDE tables to be imported.
     */
    private function add_sde_tables()
    {
        $this->registerSdeTables([
            'mapJumps',
        ]);
    }

    /**
     * Return the plugin public name as it should be displayed into settings.
     *
     * @example SeAT Web
     *
     * @return string
     */
    public function getName(): string
    {
        return 'UI-Test';
    }

    /**
     * Return the plugin repository address.
     *
     * @example https://github.com/eveseat/web
     *
     * @return string
     */
    public function getPackageRepositoryUrl(): string
    {
        return 'https://github.com/BUSAGit/UI-Test';
    }

    /**
     * Return the plugin technical name as published on package manager.
     *
     * @example web
     *
     * @return string
     */
    public function getPackagistPackageName(): string
    {
        return 'UI-Test';
    }

    /**
     * Return the plugin vendor tag as published on package manager.
     *
     * @example eveseat
     *
     * @return string
     */
    public function getPackagistVendorName(): string
    {
        return 'BUSAGit';
    }
	
	/**
     * Return the plugin installed version.
     *
     * @return string
     */
    public function getVersion(): string
    {
        return config('UI-Test.config.version');
    }
}