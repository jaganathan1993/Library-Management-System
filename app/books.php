<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class books extends Model
{
  protected $table = 'books';
  protected $fillable = [
    'id', 'bookID','bname', 'author', 'price', 'description', 'publisher', 'bCategory', 'bcount', 'bImage', 'status'
];
}
