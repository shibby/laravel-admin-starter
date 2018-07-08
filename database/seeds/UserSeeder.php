<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        /** @var User $user */
        $user = factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role_id' => User::ROLE_ADMIN,
        ]);

        /** @var User $user */
        $user = factory(User::class)->create([
            'name' => 'Editör',
            'email' => 'editor@editor.com',
            'role_id' => User::ROLE_EDITOR,
        ]);

        factory(\App\User::class, 25)->create([
            'role_id' => User::ROLE_USER,
        ]);
    }
}
