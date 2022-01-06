<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("user_id")->unsigned();
            $table->dateTime("transaction_date");
            $table->string("description");
            $table->enum("type", ["D", "C"]);
            $table->integer("amount");
            $table->timestamps();
            $table->engine = "InnoDB";

            $table->foreign("user_id")
                ->references("account_id")
                ->on("nasabah")
                ->onDelete("cascade")
                ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_models');
    }
}