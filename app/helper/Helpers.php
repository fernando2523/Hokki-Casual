<?php

if (!function_exists('Currency_IDR')) {
    function Currency_IDR($value)
    {
        return "Rp. " . number_format($value, 0, ',', '.');
    }
}
