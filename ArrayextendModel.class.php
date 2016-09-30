<?php
function add_lower_and_upper_nonrepeat_sorted_indexnumbered($arr_origin_2d)
{
    foreach ($arr_origin_2d as $arr_origin_sub_1d) {
        foreach ($arr_origin_sub_1d as $arr_origin_element) {
            $arr_tmp[] = $arr_origin_element;
            $arr_tmp[] = strtoupper($arr_origin_element);
            $arr_tmp[] = strtolower($arr_origin_element);
            $arr_tmp[] = ucwords($arr_origin_element);
            $arr_tmp[] = ucfirst($arr_origin_element);
            $arr_tmp[] = lcfirst($arr_origin_element);
            $arr_product = array_values(array_unique($arr_tmp));
        }
    }
    return $arr_product;
}
