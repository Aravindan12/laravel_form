<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $table = 'userreg';
    protected $fillable = [
        'name',
        'email',
        'password',
        'confirm_password'
       ];
}
