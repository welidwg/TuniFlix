<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $table = 'seasons';
    protected $primaryKey = 'idSeason';

    public $timestamps = false;
}
