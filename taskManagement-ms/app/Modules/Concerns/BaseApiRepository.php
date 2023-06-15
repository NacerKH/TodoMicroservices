<?php

namespace App\Modules\Concerns;

use App\Models\User;


class BaseApiRepository
{
    // Traits
    use BaseApiResponse,  FileAttachmentTrait;


    // /**
    //  * Logs the login activity for the specified user.
    //  *
    //  * @param User $user The user object.
    //  * @return void
    //  */
    // public function loginLog($user , $class_name  ,$action) 
    // {

    //     ActivityLog::create([
    //         'user_id' => $user->id,
    //         'user_role' =>  $user->role,
    //         'class_name' => $class_name,
    //         'action' => $action,
    //         'title' => $user->name  . ' in  ' . $class_name . ' process ' . $action,
    //         'data' => '',
    //     ]);
    // }

}
