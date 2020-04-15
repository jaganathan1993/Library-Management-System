<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_details extends Model
{
  protected $fillable = [
    'id', 'name','gender', 'dob','phone','emailID','Address','ID_Proff','ID_Proff_Attachment','User_image'
  ];
}
