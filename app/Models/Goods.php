<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/30
 * Time: 11:04
 */

namespace app\Models;


use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'goods';

    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['title','unit','market_price','recent_quotation','promotion','cateid_tree','remark','album'];

    const STATUS_PASS = 1;//正常
    const STATUS_DISABLE = 2;//禁用
    const STATUS_CHECK = 3;//待审核
    const STATUS_REFUSE = 4;//审核不通过
    const STATUS_DEL = 99;//删除

}