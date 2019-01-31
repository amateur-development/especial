<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/16
 * Time: 16:20
 */

namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'sys_node';

    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['parent_id','icon','title','sort','route','is_show','tree','is_dir'];

    public function inTree($id){
        return false !== strpos($this->getAttribute('tree'),",{$id},");
    }
}