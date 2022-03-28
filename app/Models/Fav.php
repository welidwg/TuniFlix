<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fav extends Model
{
    use HasFactory;
    protected $table = 'favs';
    protected $primaryKey = 'idFav';

    public $timestamps = false;
}
