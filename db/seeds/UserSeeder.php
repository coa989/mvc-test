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

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'username'      => $faker->userName,
                'role_id'       => $faker->optional($weight = 0.1, $default = 0)->numberBetween($min = 0, $max = 1),
                'password'      => sha1($faker->password),
                'email'         => $faker->email,
                'created_at'       => date('Y-m-d H:i:s'),
            ];
        }

        $this->table('users')->insert($data)->saveData();
    }
}
