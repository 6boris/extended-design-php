<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const PENDING_STATUS = '待审核';
    public const CONFRIM_STATUS = '已确认';
    public const REFUSE_STATUS = '拒绝';
    public const EXCEPTION_STATUS = '异常';
    public const FINISH_STATUS = '已完成';

    //    表名称
    protected $table = 'orders';
    //    主键
    protected $primaryKey = 'id';
    //    日期格式
    protected $dateFormat = 'Y-m-d H:i:s';
    //    自动记录创建和修改时间
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $dates = ['created_at', 'created_at', 'delete_at'];
    //    在模型数组或 JSON 显示中隐藏某些属性
    protected $hidden = [
        // 'password', 'remember_token',
    ];
}
