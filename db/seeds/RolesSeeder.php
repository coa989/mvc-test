<?php


use Phinx\Seed\AbstractSeed;

class RolesSeeder extends AbstractSeed
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
        $data = [
            [
                'id'           => 1,
                'role_name'    => 'user',
            ],[
                'id'           => 2,
                'role_name'    => 'admin',
            ]
        ];

        $posts = $this->table('roles');
        $posts->insert($data)
            ->saveData();
    }
}
