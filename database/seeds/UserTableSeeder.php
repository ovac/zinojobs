<?php

use App\Models\User;
use App\Services\UserService;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = app(UserService::class);

        if (!User::where('name', 'admin')->first()) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('admin'),
                'phone' => '0553577261',
            ]);

            $service->create($user, 'admin', 'admin', false);
        }

        factory(App\Models\User::class, 100)->create()->each(function ($user) use ($service) {
            $service->create($user, 'dummy', 'member', false);
        });

    }
}
