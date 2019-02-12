<?php

/**
 * Created by PhpStorm.
 * User: kyles
 * Date: 12 Feb 2019
 * Time: 11:14.
 */
class FormStruct
{
    /**
     * 返回通道自定义信息.
     *
     * @param  string $code
     *
     * @return string $struct
     */
    public static function getChannelFormStruct($code)
    {
        switch ($code) {
            case 'kuaijiepay':
                return FormStructKuaiJie::$form_structure;
            case 'yipay':
                return 2;
            case 'xinbeipay':
                return 3;
            default:
                return null;
        }
    }
}
