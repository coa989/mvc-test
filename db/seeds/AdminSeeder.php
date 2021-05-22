<?php

use Phinx\Seed\AbstractSeed;

class AdminSeeder extends AbstractSeed
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
        $dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
        $dotenv->load();
        
        $data = [
            [
                'username' => $_ENV['ADMIN_NAME'],
                'role' => 'admin',
                'email' => $_ENV['ADMIN_EMAIL'],
                'password' => password_hash($_ENV['ADMIN_PASS'], PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $admin = $this->table('users');
        $admin->insert($data)
            ->saveData();
    }
}
