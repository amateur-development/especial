<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/10
 * Time: 9:47
 */

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
    Route::get('login','Users\AuthController@showLoginForm')->name('admin.login.form');
    Route::post('login/verify','Users\AuthController@login')->name('admin.login.verify');
});

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'auth:sys_users'],function (){
    Route::get('dashboard','Dashboard\IndexController@index')->name('admin.dashboard.index');
    Route::get('logout','Users\AuthController@logout')->name('admin.logout');

    Route::get('user/lists','Users\RegisterController@userLists')->name('admin.users.lists');
    Route::get('register','Users\RegisterController@showRegisterForm')->name('admin.register.form');
    Route::post('register/action','Users\RegisterController@register')->name('admin.register.action');
    Route::post('user/disable','Users\RegisterController@disable')->name('admin.user.disable');
    Route::post('user/delete','Users\RegisterController@delete')->name('admin.user.delete');

    Route::get('node/lists','Basis\NodeController@treeLists')->name('admin.node.lists');
    Route::post('node/treeApi','Basis\NodeController@treeApi')->name('admin.node.api');
    Route::get('node/edit','Basis\NodeController@edit')->name('admin.node.edit');
    Route::post('node/save','Basis\NodeController@save')->name('admin.node.save');
    Route::get('node/bind','Basis\NodeController@bind')->name('admin.node.bind');
    Route::post('node/bind_save','Basis\NodeController@bindSave')->name('admin.node.bind_save');

    Route::get('goods/lists','Goods\GoodsController@lists')->name('admin.goods.lists');
    Route::get('goods/edit','Goods\GoodsController@edit')->name('admin.goods.edit');
    Route::post('goods/save','Goods\GoodsController@save')->name('admin.goods.save');
});