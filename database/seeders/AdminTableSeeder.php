<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin')->delete();

        $adminRecords = [
            [
                'id' => 1,
                'name' => 'admin',
                'type' => 'admin',
                'mobile'=>'00000000',
                'email' => 'admin1@admin.com',
                'password' => Hash::make('password'),
                'image' => '',
                'status'=> 1
            ],
            [
                'id' => 2,
                'name' => 'admin2',
                'type' => 'subadmin',
                'mobile'=>'010000000',
                'email' => 'admin2@admin.com',
                'password' => Hash::make('password'),
                'image' => '',
                'status'=> 1
            ],
            [
                'id' => 3,
                'name' => 'admin3',
                'type' => 'subadmin',
                'mobile'=>'000100000',
                'email' => 'admin3@admin.com',
                'password' => Hash::make('password'),
                'image' => '',
                'status'=> 1
            ],
            [
                'id' => 4,
                'name' => 'admin4',
                'type' => 'subadmin',
                'mobile'=>'000400000',
                'email' => 'admin4@admin.com',
                'password' => Hash::make('password'),
                'image' => '',
                'status'=> 1
            ],
            [
                'id' => 5,
                'name' => 'admin5',
                'type' => 'subadmin',
                'mobile'=>'000500000',
                'email' => 'admin5@admin.com',
                'password' => Hash::make('password'),
                'image' => '',
                'status'=> 1
            ],
        ];

        // foreach ($adminRecords as $key => $record) {
        //     \App\Models\Admin::create($record);
        // }
        DB::table('admin')->insert($adminRecords);


    }
}
