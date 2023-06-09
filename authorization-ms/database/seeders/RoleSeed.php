<?php

namespace Database\Seeders;

use App\Enum\RolesEnum;
use App\Modules\Authentication\Models\Permission;
use App\Modules\Authentication\Models\Role;

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Permission::insert([
            [ // 1
                'name' => 'default',
            ],
            [ // 2
                'name' => 'create_task',
            ],
            [ // 3
                'name' => 'edit_task',
            ],
            [ // 4
                'name' => 'assigne_task',
            ],
            [ // 5
                'name' => 'edit_task_status',
            ],
            [ // 6
                'name' => 'app_usage',
            ],
            [ // 7
                'name' => 'import_task',
            ],
            [ // 8
                'name' => 'export_task',
            ],
  
        ]);

        Role::create([
            'name' => RolesEnum::ADMINISTRATOR
        ])->permissions()->sync([1, 2, 3, 4, 5, 6, 7, 8]);

 

        Role::create([
            'name' => RolesEnum::MANAGER
        ])->permissions()->sync([1, 2, 3, 4, 5, 6, 7, 8]);

        Role::create([
            'name' => RolesEnum::EMPLOYEE
        ])->permissions()->sync([1, 2, 3, 4, 5, 6, 7, 8]);
    
    }
}
