<?php
/**
 * Created by PhpStorm.
 * User: kyles
 * Date: 12 Feb 2019
 * Time: 11:01.
 */

namespace App\Services\PayChannel;

use App\Order;
use Illuminate\Http\Request;

abstract class PayChannelAbsract
{
    abstract public function getPayInfo(Order $order);

    abstract public function onNotify(Request $request);

    abstract public function isPaymentFinished(Order $order);

    /**
     * 支付通道初始化.
     *
     * @return \App\Order
     */
    public function __construct(Request $request)
    {

    }

    /**
     * 支付通道初始化.
     *
     * @return \App\Services\PayChannel\PayChannelAbsract;
     */
    public static function GetChannelInstance(Request $request)
    {
        $channel_code = $request->route('channel_code');

        //  检查通道文件
        self::checkPayInstance($channel_code);

        switch ($channel_code) {
            case 'kuaijiepay':
                return new PayChannelKuaiJie($request);
            default:
                return null;
        }
    }

    private static function checkPayInstance($channel_code)
    {

    }
}
