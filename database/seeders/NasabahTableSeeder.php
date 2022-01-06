<?php

namespace Database\Seeders;

use App\Models\NasabahModel;
use Illuminate\Database\Seeder;

class NasabahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nasabah = new NasabahModel();
        $nasabah->name = "Andika";
        $nasabah->address = "Malang";
        $nasabah->save();

        $nasabah1 = new NasabahModel();
        $nasabah1->name = "Eko Teguh Wicaksono";
        $nasabah1->address = "Blitar";
        $nasabah1->save();

        $nasabah2 = new NasabahModel();
        $nasabah2->name = "Endro";
        $nasabah2->address = "Blitar";
        $nasabah2->save();

        $nasabah3 = new NasabahModel();
        $nasabah3->name = "Adam";
        $nasabah3->address = "Surabaya";
        $nasabah3->save();
    }
}