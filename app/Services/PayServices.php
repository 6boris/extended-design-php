<?php

namespace App\Services;

use App\PayChannel;
use App\PayMapChannelType;

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
}
