<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emplyee extends Model
{
    use HasFactory;

    protected $fillable = ['image' ,'name', 'email', 'phone', 'dependant', 'age', 'department'];
    protected $table = 'employee';
    public $timestamps = false;
    // public $timestamps = ["created_at"]; //only want to used created_at column
    // const UPDATED_AT = null
}
