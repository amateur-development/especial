<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/30
 * Time: 11:19
 */

namespace app\Models;


use Illuminate\Database\Eloquent\Model;

class GoodsContent extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'goods_content';

    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['goods_id','content'];

}