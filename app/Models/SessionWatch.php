<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionWatch extends Model
{
    use HasFactory;
    protected $table = 'Session';
    protected $primaryKey = 'SessionID';

    public $timestamps = false;
}
