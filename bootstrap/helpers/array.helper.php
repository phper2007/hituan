<?php


/**
 * 合并数组，但不重建索引
 *
 * @param array $arr1
 * @param array $arr2
 * @return array
 */
function array_merge_noreset($arr1, $arr2)
{
    if (empty($arr2)) return $arr1;

    foreach ($arr2 as $key=>$val)
    {
        $arr1[$key] = $val;
    }
    return $arr1;
}