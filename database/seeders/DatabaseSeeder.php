<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\Sub_category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ADMIN',
            'email' => 'admin',
            'password' => Hash::make('asdqwe123'),
            'role' => 'SUPER-ADMIN',
        ]);

        // Role::create([
        //     'role' => 'SUPER-ADMIN',
        // ]);
        // Role::create([
        //     'role' => 'HEAD-AREA',
        // ]);
        // Role::create([
        //     'role' => 'HEAD-WAREHOUSE',
        // ]);
        // Role::create([
        //     'role' => 'HEAD-STORE',
        // ]);
        // Role::create([
        //     'role' => 'CASHIER',
        // ]);

        // Product::create([
        //     'id_produk' => '1321081971',
        //     'id_ware' => 'WARE-2',
        //     'brand' => 'VANS',
        //     'tanggal' => '2022-10-14',
        //     'produk' => 'Vans Slip On Side Wall Checkerboard',
        //     'desc' => NULL,
        //     'category' => 'SNEAKERS',
        //     'quality' => 'IMPORT',
        //     'n_price' => '300000',
        //     'r_price' => '300000',
        //     'g_price' => '300000',
        //     'm_price' => '300000',
        //     'img' => 'img-1.png',
        //     'users' => 'ADMIN',
        // ]);
    }
}
