<?php

use App\AzPos\Domain\UserModel\EloquentUser;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * @var EloquentUser
     */
    private $user;

    /**
     * UsersTableSeeder constructor.
     *
     * @param EloquentUser $user
     */
    public function __construct(EloquentUser $user)
    {
        $this->user = $user;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->user->create(
            [
                'first_name' => 'Laura',
                'last_name' => 'Zapata',
                'username' => 'lauraazapataa',
                'email' => 'lauraazapataa@gmail.com',
                'phone' => '+573212032851',
                'password' => Hash::make('1q2w3e4r'),
                'active' => true

            ]
        );
    }
}
