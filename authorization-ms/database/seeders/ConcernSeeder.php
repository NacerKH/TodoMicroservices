<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;

class ConcernSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //command passport:client 
        foreach (config('auth.providers') as $key => $value) {
            (new ClientRepository())->createPasswordGrantClient(
                null,
                $key,
                'http://localhost',
                $key
            );
        }

        $this->call([
            RoleSeed::class,
            UserSeed::class,

        ]);
    }
}
