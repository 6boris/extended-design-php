<?php

namespace App\Services;

use App\PayChannel;
use App\PayMapChannelType;

class PayServices
{
    public static function GetAllPayChannel()
    {
        $pay_channels = PayChannel::all()->toArray();
//        dd($pay_channels);

        for ($i = 0; $i < count($pay_channels); ++$i) {
            $pay_channels[$i]['types'] =PayMapChannelType::where('channel_code', '=', $pay_channels[$i]['code'])
                ->leftJoin('pay_types', 'pay_map_channel_type.type_code', '=', 'pay_types.code')
                ->get();
        }
        dd($pay_channels);
        foreach ($pay_channels as $channel) {
//            $channel->types =  PayMapChannelType::where('channel_code','=',$channel->code)
//                ->leftJoin('pay_types', 'pay_map_channel_type.type_code', '=', 'pay_types.code')
//                ->get();
            $channel['types'] = 1;
        }
        dd($pay_channels);

//        dd($pay_channels);
        $pay_map_channel_type = PayMapChannelType
            ::leftJoin('pay_channels', 'pay_map_channel_type.channel_code', '=', 'pay_channels.code')
            ->leftJoin('pay_types', 'pay_map_channel_type.type_code', '=', 'pay_types.code')
            ->select([
                'pay_channels.id    AS  id',
                'pay_channels.name  AS  channel_name',
                'pay_channels.code  AS  channel_code',
                'pay_types.code     AS  type_code',
                'pay_types.name     AS  type_name',
            ])
            ->get();

        //  find source data

        $res = array();
        foreach ($pay_channels as $channel) {
            //  create the channel root
            array_push($res, array(
                'id' => $channel->id,
                'channel_name' => $channel->name,
                'channel_code' => $channel->code,
            ));

            foreach ($pay_map_channel_type as $type) {
//                dump($type->channel_code);
//                dump($channel->channel_code);
                if ($type->channel_code == $res->channel_code) {
                    dump(1);
                    array_push($res->types, array(
                        'type_code' => $type->code,
                        'type_name' => $type->name,
                    ));
                }
            }
        }

        dump($pay_channels);
        dump($pay_map_channel_type);
        dump($res);
        exit;

        return self::GenerateChannels($pay_channels);
    }

    private static function GenerateChannels($pay_channels)
    {
        $res = array();
        foreach ($pay_channels as $channel) {
            array_push($res, array(
                'id' => $channel->id,
                'channel_name' => $channel->channel_name,
                'channel_code' => $channel->channel_code,
            ));
        }
        //  channel 数组去重
        $tmp = array();
        foreach ($pay_channels as $channel) {
            if (!in_array($channel->id, $tmp)) {
                array_push($tmp, $channel->id);
            }
        }
        //  add channel name
        for ($i = 0; $i < count($tmp); ++$i) {
        }
        foreach ($pay_channels as $channel) {
            if (!in_array($channel->id, $tmp)) {
                array_push($tmp, $channel->id);
            }
        }

        dump($tmp);

        return $res;
    }
}
