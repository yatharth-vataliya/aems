<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    //
    protected $fillable=['college_name','department','course','status'];

    public function changeStatus(){
    	$this->status == 'active' ? $this->update(['status'=>'deactive']) : $this->update(['status'=>'active']);
    }

}
