<?php

namespace App\Modules\TodoList\Enum;


final class TaskPriorityEnum
{


    public const PRIORITY_HIGH_LEVEL = '2';
    public const PRIORITY_MEDUIM_LEVEL = '1';
    public const PRIORITY_LOW_LEVEL = '0';

    public static $PriorityLevelList = [
        self::PRIORITY_LOW_LEVEL,
        self::PRIORITY_MEDUIM_LEVEL,
        self::PRIORITY_HIGH_LEVEL,

    ];
 
    public static function getPriorityLevel($priority)
    {
        switch ($priority) {
            case self::PRIORITY_HIGH_LEVEL:
                return 'High';
            case self::PRIORITY_MEDUIM_LEVEL:
                return 'Medium';
            case self::PRIORITY_LOW_LEVEL:
                return 'Low';
            default:
                return 'Unknown';
        }
    }



}
