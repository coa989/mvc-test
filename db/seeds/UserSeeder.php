<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
            $data[] = [
                'username'      => 'coa',
                'password'      => password_hash('123456789', PASSWORD_DEFAULT),
                'email'         => 'coa@test.com',
                'created_at'       => date('Y-m-d H:i:s'),
            ];

        $this->table('users')->insert($data)->saveData();
    }
}
