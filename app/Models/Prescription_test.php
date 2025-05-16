<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription_test extends Model
{
    protected $guarded=['id'];
    protected $table = 'prescription_tests';


 public function Test(){
            return $this->hasOne('App\Models\Test', 'id', 'test_id');
}
}
