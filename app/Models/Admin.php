<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
    	'admin_full_name','admin_username','admin_password','admin_mobile',
    ];
}
