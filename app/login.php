<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class login extends Model
{
  protected $fillable = [
    'id', 'category','userid', 'pw'
];
}
