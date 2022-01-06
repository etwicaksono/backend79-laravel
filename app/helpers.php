<?php
if (!function_exists("get_point")) {
    function get_point($desc, $amount)
    {
        $point = 0;

        switch (trim(strtolower($desc))) {
            case "beli pulsa":
                if ($amount > 10000 && $amount <= 30000) {
                    $amount -= 10000;
                    $point = $amount / 1000;
                } else if ($amount > 30000) {
                    $amount -= 30000;
                    $point = 20;
                    $point += ($amount / 1000) * 2;
                }
                break;
            case "bayar listrik":
                if ($amount > 50000 && $amount <= 100000) {
                    $amount -= 50000;
                    $point = $amount / 2000;
                } else if ($amount > 100000) {
                    $amount -= 100000;
                    $point = 25;
                    $point += ($amount / 2000) * 2;
                }
                break;
            default:

                break;
        }
        return $point;
    }
}

if (!function_exists("in_array_r")) {
    function in_array_r($needle, $haystack, $strict = false)
    {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists("date_parser")) {
    function date_parser($date)
    {
        // mengubah d-m-Y menjadi Y-m-d
        if ($date != "") {
            $temp = explode('-', $date);
            $day = $temp[0];
            $month = $temp[1];
            $year = $temp[2];
            return $year . "-" . $month . "-" . $day;
        }
    }
}