<?php

defined('ASSETS_VERSION') || define('ASSETS_VERSION', '201901090916');
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/17
 * Time: 10:05
 */

//从数组列表创建数组树
function createTree(&$list, $parent){
    $tree = array();
    foreach ($parent as $k=>$l){
        if(isset($list[$l['id']])){
            $l['children'] = createTree($list, $list[$l['id']]);
        }
        $tree[] = $l;
    }
    return $tree;
}

// 不想验证路由是否正确的时候使用
function try_route($name, $parameters = [], $absolute = true)
{
    try {
        return route($name, $parameters, $absolute);
    } catch (Throwable $e) {

    }
    return null;
}