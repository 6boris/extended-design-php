<?php

/**
 * Created by PhpStorm.
 * User: kyles
 * Date: 12 Feb 2019
 * Time: 11:14.
 */
trait FormStructKuaiJie
{
    public static $form_structure = [
        'names'=>[
            'show'=>true,
            'title'=>'名称',
            'required'=>true,
            'tag'=>'input',
            'default_value'=>'快捷支付',
            'description'=>''
        ],
        'code'=>[
            'show'=>true,
            'title'=>'别名',
            'required'=>false,
            'tag'=>'input',
            'default_value'=>'kuaijiepay',
            'description'=>''
        ],
    ];
}