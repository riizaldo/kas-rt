<?php

use App\Helpers\StatistikHelper;

if (!function_exists('getStatistikBulananPerRT')) {
    function getStatistikBulananPerRT(int $tahun): array
    {
        return StatistikHelper::getStatistikBulananPerRT($tahun);
    }
}
