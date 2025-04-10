<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

#devi langiarmi con questo comando: php artisan db:seed --class=Database\\Seeders\\EncryptPasswordsSeeder


class EncryptPasswordsSeeder extends Seeder
{
    public function run()
    {
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            if (!Hash::needsRehash($user->password)) {
                continue;
            }

            DB::table('users')
                ->where('id', $user->id)
                ->update(['password' => Hash::make($user->password)]);
            
            $this->command->info("Password criptata per l'utente " . $user->email);
        }

        $this->command->info('Tutte le password sono state criptate con Bcrypt.');
    }
}
