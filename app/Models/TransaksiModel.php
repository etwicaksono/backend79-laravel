<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    protected $table = "transaksi";
    protected $fillable = ["user_id", "transaction_date", "description", "type", "amount"];

    public function nasabah()
    {
        return $this->belongsTo(NasabahModel::class);
    }
}