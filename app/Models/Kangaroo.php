<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kangaroo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'name',
        'nickname',
        'weight',
        'height',
        'gender',
        'color',
        'friendliness',
        'birthday'
    ];

    protected $table = 'kangaroos';
 
    public $timestamps = false;
}
