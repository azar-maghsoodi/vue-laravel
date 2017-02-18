<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1=[
        	'name' => 'navid',
        	'email'=> 'torabazary@gmail.com',
        	'password'=> Hash::make('1111'),
        ];

        User::create($user1);
    }
}
