<?php

if (! function_exists('html_star')) {
    function html_star(float $value) {
        $intValue = (int)$value;
        $starHtml = '';

        for ($i = 1; $i <= $intValue; $i++) {
            $starHtml .= '<span class="fa fa-star"></span>';
        }

        $leftValue = $value - $intValue;

        if ($leftValue >= 0.5) {
            $starHtml .= '<span class="fa fa-star-half-o"></span>';
        }

        return $starHtml;
    }
}