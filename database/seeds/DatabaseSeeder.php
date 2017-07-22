<?php

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
        $data = $this->getData();
        foreach ($data as $table => $rows) {
            DB::table($table)->insert($rows);
        }
    }

    protected function getData()
    {
        $data = [];

        $timestamp = date('Y-m-d H:i:s');

        // password: 123456
        $data['users'] = [
            ['id' => 1, 'name' => 'User 1', 'email' => 'user1@a.aa', 'password' => '$2y$10$d.NQ8BBzwBAYKpIWi97tnOBscldJUgemKSPGi9q4EiiAEtwJROMVe', 'remember_token' => '', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 2, 'name' => 'User 2', 'email' => 'user2@a.aa', 'password' => '$2y$10$d.NQ8BBzwBAYKpIWi97tnOBscldJUgemKSPGi9q4EiiAEtwJROMVe', 'remember_token' => '', 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        $data['products'] = [
            ['id' => 1, 'name' => 'Product 1', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 2, 'name' => 'Product 2', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 3, 'name' => 'Product 3', 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        $data['orders'] = [
            ['id' => 1, 'user_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 2, 'user_id' => 2, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 3, 'user_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 4, 'user_id' => 2, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 5, 'user_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 6, 'user_id' => 2, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 7, 'user_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 8, 'user_id' => 2, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 9, 'user_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 10, 'user_id' => 2, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 11, 'user_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['id' => 12, 'user_id' => 2, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        $data['order_items'] = [
            ['order_id' => 1, 'product_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 2, 'product_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 2, 'product_id' => 2, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 3, 'product_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 3, 'product_id' => 2, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 3, 'product_id' => 3, 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['order_id' => 4, 'product_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 5, 'product_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 5, 'product_id' => 2, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 6, 'product_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 6, 'product_id' => 2, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 6, 'product_id' => 3, 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['order_id' => 7, 'product_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 8, 'product_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 8, 'product_id' => 2, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 9, 'product_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 9, 'product_id' => 2, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 9, 'product_id' => 3, 'created_at' => $timestamp, 'updated_at' => $timestamp],

            ['order_id' => 10, 'product_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 11, 'product_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 11, 'product_id' => 2, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 12, 'product_id' => 1, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 12, 'product_id' => 2, 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['order_id' => 12, 'product_id' => 3, 'created_at' => $timestamp, 'updated_at' => $timestamp],
        ];

        return $data;
    }
}
