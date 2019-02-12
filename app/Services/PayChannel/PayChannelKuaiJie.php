<?php

namespace App\Services\PayChannel;

use App\Order;
use Illuminate\Http\Request;

class PayChannelKuaiJie extends PayChannelAbsract
{
    public function getPayInfo(Order $order)
    {
        // TODO: Implement getPayInfo() method.
    }

    public function onNotify(Request $request)
    {
        // TODO: Implement onNotify() method.

        //  查找订单
        $order = Order
            ::where('order_num', '=', $request->input('order_num'))
            ->firstOrFail();
        //  检查订单状态
        if ($this->isPaymentFinished($order)) {
            abort(403,"Order Already Pay Successd");
        } else {
        //  完成订单
            $order->status = Order::FINISH_STATUS;
            $order->save();
        }

        return $order;
    }

    public function isPaymentFinished(Order $order)
    {
        // TODO: Implement isPaymentFinished() method.
        if ($order->status == Order::FINISH_STATUS) {
            return true;
        }
        return false;

    }

}
