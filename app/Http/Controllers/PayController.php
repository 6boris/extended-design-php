<?php

namespace App\Http\Controllers;

use App\PayChannel;
use App\Order;
use App\Services\PayServices;
use Illuminate\Http\Request;

class PayController extends Controller
{
    /**
     * 支付页面.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function pay($id)
    {
        $order = PayServices::GetPayInfoById($id);

        return view('pays.show')->with('order', $order);
    }

    /**
     * 支付回调 [针对不同的通道做不同的处理].
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function callback(Request $request)
    {
        $channel_code = $request->route('channel_code');

        PayChannel::where('code', '=', $channel_code)->firstOrFail();
        $res = PayServices::CheckOrderCallback($request);

        return view('pays.callback');
    }
}
