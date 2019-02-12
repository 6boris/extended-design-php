<?php

namespace App\Services;

use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\PayChannel;
use App\PayMapChannelType;
use App\Services\PayChannel\PayChannelAbsract;

class PayServices
{

    public static function GetAllPayChannel()
    {
        $pay_channels = PayChannel::all()->toArray();

        for ($i = 0; $i < count($pay_channels); ++$i) {
            $pay_channels[$i]['types'] = PayMapChannelType::where('channel_code', '=', $pay_channels[$i]['code'])
                ->leftJoin('pay_types', 'pay_map_channel_type.type_code', '=', 'pay_types.code')
                ->get();
        }

        return $pay_channels;
    }

    /**
     * 获取支付订单
     *
     * @param int $id
     *
     * @return /App/Order
     */
    public static function GetPayInfoById($id)
    {
        $order = Order::where('orders.id', '=', $id)
            ->where('user_id', '=', auth()->id())
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('pay_channels', 'orders.pay_channel_id', '=', 'pay_channels.id')
            ->leftJoin('pay_types', 'orders.pay_type_id', '=', 'pay_types.id')
            ->select(
                'orders.id',
                'orders.user_id',
                'orders.pay_type_id',
                'orders.pay_channel_id',
                'orders.order_num',
                'orders.account',
                'orders.status',
                'pay_channels.name  as channel_name',
                'pay_channels.code  as channel_code',
                'pay_types.name     as type_name',
                'orders.created_at',
                'orders.updated_at',
                'orders.finished_at',
                'users.name')
            ->firstOrFail();

        return $order;
    }


    public static function GetOrderPayInfo($order_num){
    }


    /**
     * 处理回调
     *
     * @param int $id
     *
     * @return /App/Order
     */
    public static function CheckOrderCallback($request)
    {
        $pay_channle_instance = PayChannelAbsract::GetChannelInstance($request);

        if (!$pay_channle_instance) {
            abort(403,"Channel not exists");
        }

        $res = $pay_channle_instance->onNotify($request);
        return $res;
    }
}
