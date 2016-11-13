<?php namespace Clake\DataStructures;

use Backend;
use System\Classes\PluginBase;

/**
 * DataStructures Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Data Structures',
            'description' => 'Data structures and components which utilize them!',
            'author'      => 'clake',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Clake\DataStructures\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'clake.datastructures.some_permission' => [
                'tab' => 'DataStructures',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'datastructures' => [
                'label'       => 'DataStructures',
                'url'         => Backend::url('clake/datastructures/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['clake.datastructures.*'],
                'order'       => 500,
            ],
        ];
    }

}
