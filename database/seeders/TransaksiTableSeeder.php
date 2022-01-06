<?php

namespace Database\Seeders;

use App\Models\TransaksiModel;
use Illuminate\Database\Seeder;

class TransaksiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaksi = new TransaksiModel();
        $transaksi->user_id = 1;
        $transaksi->transaction_date = "2022-01-01 13:24:56";
        $transaksi->description = "Setor tunai";
        $transaksi->type = "C";
        $transaksi->amount = 200000;
        $transaksi->save();

        $transaksi2 = new TransaksiModel();
        $transaksi2->user_id = 1;
        $transaksi2->transaction_date = "2022-01-01 13:24:56";
        $transaksi2->description = "Setor tunai";
        $transaksi2->type = "C";
        $transaksi2->amount = 300000;
        $transaksi2->save();

        $transaksi3 = new TransaksiModel();
        $transaksi3->user_id = 2;
        $transaksi3->transaction_date = "2022-01-02 13:24:56";
        $transaksi3->description = "Setor tunai";
        $transaksi3->type = "C";
        $transaksi3->amount = 400000;
        $transaksi3->save();

        $transaksi4 = new TransaksiModel();
        $transaksi4->user_id = 2;
        $transaksi4->transaction_date = "2022-01-02 13:24:56";
        $transaksi4->description = "Setor tunai";
        $transaksi4->type = "C";
        $transaksi4->amount = 200000;
        $transaksi4->save();

        $transaksi5 = new TransaksiModel();
        $transaksi5->user_id = 2;
        $transaksi5->transaction_date = "2022-01-03 13:24:56";
        $transaksi5->description = "Beli Pulsa";
        $transaksi5->type = "D";
        $transaksi5->amount = 40000;
        $transaksi5->save();

        $transaksi6 = new TransaksiModel();
        $transaksi6->user_id = 2;
        $transaksi6->transaction_date = "2022-01-03 13:24:56";
        $transaksi6->description = "Bayar Listrik";
        $transaksi6->type = "D";
        $transaksi6->amount = 111000;
        $transaksi6->save();

        $transaksi7 = new TransaksiModel();
        $transaksi7->user_id = 2;
        $transaksi7->transaction_date = "2022-01-04 13:24:56";
        $transaksi7->description = "Bayar Listrik";
        $transaksi7->type = "D";
        $transaksi7->amount = 211000;
        $transaksi7->save();

        $transaksi8 = new TransaksiModel();
        $transaksi8->user_id = 1;
        $transaksi8->transaction_date = "2022-01-04 13:24:56";
        $transaksi8->description = "Bayar Listrik";
        $transaksi8->type = "D";
        $transaksi8->amount = 111000;
        $transaksi8->save();

        $transaksi9 = new TransaksiModel();
        $transaksi9->user_id = 1;
        $transaksi9->transaction_date = "2022-01-05 13:24:56";
        $transaksi9->description = "bayar Listrik";
        $transaksi9->type = "D";
        $transaksi9->amount = 211000;
        $transaksi9->save();

        $transaksi10 = new TransaksiModel();
        $transaksi10->user_id = 1;
        $transaksi10->transaction_date = "2022-01-05 04:37:22";
        $transaksi10->description = "Setor Tunai";
        $transaksi10->type = "C";
        $transaksi10->amount = 100000;
        $transaksi10->save();

        $transaksi11 = new TransaksiModel();
        $transaksi11->user_id = 1;
        $transaksi11->transaction_date = "2022-01-05 04:38:14";
        $transaksi11->description = "Bayar Listrik";
        $transaksi11->type = "D";
        $transaksi11->amount = 100000;
        $transaksi11->save();
    }
}