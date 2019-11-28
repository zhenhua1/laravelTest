<?php

/**
 * 获取固定长度的数字随机数
 * @param int $num
 * @return string
 */
function GetFixedRandNumber($num = 15)
{
    $num = $num > 15 ? $num : 15;
    $range = range(0, 9);
    $byteStr = '';
    $max = $num - 14;
    for ($i = 0; $i < $max; $i++) {
        $byteStr .= array_rand($range);
    }
    return date('YmdHis') . $byteStr;
}

/**
 * 参数转义函数
 * @param $params
 * @return mixed
 */
function ParamsFilter(&$params)
{
    foreach ($params as $key => $paramItems) {
        if (!is_array($paramItems)) {
            $params[$key] = htmlspecialchars(trim($paramItems));
        } else {
            ParamsFilter($paramItems);
        }
    }
    return $params;
}
