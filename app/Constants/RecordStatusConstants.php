<?php

namespace App\Constants;

final class RecordStatusConstants
{
    const STATUS = [
        0 =>
            [
                'value' => 0,
                'label' => 'Deleted'
            ],
        1 =>
            [
                'value' => 1,
                'label' => 'Active'
            ],
    ];

    const QUERY = [
        'inactive' => ['record_status' => self::STATUS[0]['value']],
        'active' => ['record_status' => self::STATUS[1]['value']]
    ];

    private function __construct()
    {
    }
}
