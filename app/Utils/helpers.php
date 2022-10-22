<?php

if (!function_exists('number')) {
    function number(string|int|null $number): string
    {
        return $number ? (string) number_format((float) $number, 0, ',', '.') : 0;
    }
}
