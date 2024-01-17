<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\District;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('provinces')->insert([

        ]);

        // [
        //     "id" => "92",
        //     "province_name" => "Thành phố Cần Thơ",
        //     "province_type" => "Thành phố Trung ương",
        //     "created_at" => Carbon::now(),
        //     "updated_at" => Carbon::now()
        // ],
        // DB::table('districts')->insert([
        //     ['name' => 'Thanh Khê', 'province_id' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['name' => 'Hải Châu', 'province_id' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        // ]);
        // DB::table('wards')->insert([
        //     ['name' => 'Tân Chính', 'district_id' => '1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        //     ['name' => 'Hải Châu 1', 'district_id' => '2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        // ]);

        // DB::table('roles')->insert([
        //     ['name' => 'user', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        // ]);
    }
}
// nhớ comment khi thêm 1 dòng mới
