<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RolesTableSeeder::class);
        $this->call(UserTableSeeder::class);

        // factory(App\Models\User::class, 100)->create();
        factory(App\Job::class, 1000)->create();
        factory(App\Company::class, 1000)->create();
        factory(App\Application::class, 1000)->create();
        factory(App\Question::class, 1000)->create();
        factory(App\Message::class, 1000)->create();
        factory(App\Invitation::class, 300)->create();

        Model::reguard();
    }
}
