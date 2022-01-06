<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahModel extends Model
{
    protected $table = "nasabah";
    protected $fillable = ["name", "address"];
}