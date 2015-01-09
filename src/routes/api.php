<?php

/*
 * API Routes
 */
Route::group(array('prefix' => 'v1', 'namespace' => 'v1'), function () {

    /*
     * Generic Events API
     */
    Route::group(array('prefix' => 'calendar'), function () {

        Route::resource('events', 'EventApi', array(
            'names' => array(
                'index' => 'maintenance.api.calendar.events.index',
                'create' => 'maintenance.api.calendar.events.create',
                'store' => 'maintenance.api.calendar.events.store',
                'show' => 'maintenance.api.calendar.events.show',
                'edit' => 'maintenance.api.calendar.events.edit',
                'update' => 'maintenance.api.calendar.events.update',
                'destroy' => 'maintenance.api.calendar.events.destroy',
            ),
        ));

    });

    /*
     * Work Order API's
     */
    Route::group(array('prefix' => 'work-orders', 'namespace' => 'WorkOrder'), function () {

        Route::resource('events', 'EventApi', array(
            'only' => array(
                'index',
                'show',
            ),
            'names' => array(
                'index' => 'maintenance.api.v1.work-orders.events.index',
                'show' => 'maintenance.api.v1.work-orders.events.show',
            ),
        ));

    });

    /*
     * Inventory API's
     */
    Route::group(array('prefix' => 'inventory', 'namespace' => 'Inventory'), function () {

        Route::resource('inventory.stocks', 'StockApi', array(
            'only' => array(
                'edit',
                'update'
            ),
            'names' => array(
                'edit' => 'maintenance.api.inventory.stocks.edit',
                'update' => 'maintenance.api.inventory.stocks.update',
            ),
        ));

        /*
         * Inventory Event API
         */
        Route::resource('events', 'EventApi', array(
            'only' => array(
                'index',
                'show',
            ),
            'names' => array(
                'index' => 'maintenance.api.v1.inventory.events.index',
                'show' => 'maintenance.api.v1.inventory.events.show',
            ),
        ));

    });

    /*
     * Asset API's
     */
    Route::group(array('prefix' => 'assets', 'namespace' => 'Asset'), function () {

        Route::get('', array(
            'as' => 'maintenance.api.v1.assets.get',
            'uses' => 'AssetApi@get'
        ));

        Route::get('find/{assets}', array(
            'as' => 'maintenance.api.v1.assets.find',
            'uses' => 'AssetApi@find'
        ));

        /*
         * Asset Event API
         */
        Route::resource('events', 'EventApi', array(
            'only' => array(
                'index',
                'show',
            ),
            'names' => array(
                'index' => 'maintenance.api.v1.assets.events.index',
                'show' => 'maintenance.api.v1.assets.events.show',
            ),
        ));

    });

});