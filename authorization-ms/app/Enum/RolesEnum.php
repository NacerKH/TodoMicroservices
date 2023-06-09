<?php

namespace App\Enum;



final class RolesEnum
{


    public const ADMINISTRATOR = 'global_administrator';


    public const MANAGER = 'manager';
    public const EMPLOYEE = 'employee';

    public static $admin = [
        self::ADMINISTRATOR,

    ];

    public static $manager = [
        self::MANAGER,
    ];

    public static $all =[
        self::ADMINISTRATOR,
        self::MANAGER,
    ];
}
