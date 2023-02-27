<?php

namespace App\Constants;

final class RequestStatusConstants
{
    const STATUS = [
        0 =>
            [
                'value' => 0,
                'label' => 'New'
            ],
        1 =>
            [
                'value' => 1,
                'label' => 'Resolved'
            ],
    ];
    private function __construct()
    {
    }
}
