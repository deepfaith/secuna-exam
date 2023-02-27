<?php

namespace App\Constants;

final class SeverityConstant
{
    const LEVELS = [
        1 =>
            [
                'value' => 1,
                'label' => 'Critical'
            ],
        2 =>
            [
                'value' => 2,
                'label' => 'High'
            ],
        3 =>
            [
                'value' => 3,
                'label' => 'Medium'
            ],
        4 =>
            [
                'value' => 4,
                'label' => 'Low'
            ],
        0 =>
            [
                'value' => 0,
                'label' => 'None'
            ],
    ];

    private function __construct()
    {
    }
}
