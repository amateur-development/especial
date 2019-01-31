<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SuperUser extends Authenticatable
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'sys_users';
    /**
     * 表明模型是否应该被打上时间戳
     * @var bool
     */
    public $timestamps = false;
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['username','password','plaintext_key','realname','mobile','status','created_at','updated_at'];

    const STATUS_NORMAL = 1;//正常
    const STATUS_DISABLED = 2;//禁用
    const STATUS_DELETE = 99;//删除

    const BADGE = [
        '1' => 'badge-success',//正常
        '2' => 'badge-default',//禁用
    ];
}
