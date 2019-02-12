<?php

namespace App\Services;

use App\Order;
use App\PayType;
use App\PayChannel;
use App\PayMapChannelType;
use DB;

class OrderServices
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return /App/Order
     */
    public static function FindOrderById($id)
    {
        $orders = Order::where('orders.user_id', '=', auth()->id())
            ->where('orders.id', '=', $id)
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('pay_channels', 'orders.pay_channel_id', '=', 'pay_channels.id')
            ->leftJoin('pay_types', 'orders.pay_type_id', '=', 'pay_types.id')
            ->select('orders.id',
                'orders.user_id',
                'orders.pay_type_id',
                'orders.pay_channel_id',
                'orders.order_num',
                'orders.account',
                'orders.status',
                'pay_channels.name  as channel_name',
                'pay_types.name     as type_name',
                'orders.created_at',
                'orders.updated_at',
                'orders.finished_at',
                'users.name')
            ->firstOrFail();

//        $orders = Order::where('user_id', '=', auth()->id())->get();
        return $orders;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return /App/Order
     */
    public static function GetOrderByUser()
    {
        $orders = Order::where('user_id', '=', auth()->id())
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('pay_channels', 'orders.pay_channel_id', '=', 'pay_channels.id')
            ->leftJoin('pay_types', 'orders.pay_type_id', '=', 'pay_types.id')
            ->select('orders.id',
                'orders.user_id',
                'orders.pay_type_id',
                'orders.pay_channel_id',
                'orders.order_num',
                'orders.account',
                'orders.status',
                'pay_channels.name  as channel_name',
                'pay_types.name     as type_name',
                'orders.created_at',
                'orders.updated_at',
                'orders.finished_at',
                'users.name')
            ->paginate(10);

//        $orders = Order::where('user_id', '=', auth()->id())->get();
        return $orders;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return /App/Order
     */
    public static function CreateOrder($request)
    {

        $type = PayType::where('code', '=', $request->input('type_code'))->firstOrFail();
        $channel = PayChannel::where('code', '=', $request->input('channel_code'))->firstOrFail();
        $channel_type_map = PayMapChannelType::where('type_code', '=', $request->input('type_code'))
            ->where('channel_code', '=', $request->input('channel_code'))
            ->firstOrFail();

        $order = new Order();
        $order->order_num = self::CreateOrderNumber();
        $order->user_id = auth()->id();
        $order->pay_channel_id = $channel->id;
        $order->pay_type_id = $type->id;
        $order->account = floatval($request->input('account'));
        $order->status = Order::PENDING_STATUS;
        $order->save();

        return $order;
    }

    private static function CreateOrderNumber()
    {
        return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT) . substr(time(), 6, 4);;
    }
}
