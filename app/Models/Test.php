<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'tests';

    protected $guarded = ['id'];
    public function Prescription()
    {
        return $this->hasMany('App\Models\Prescription_test');
    }

    public function ReportFormat()
    {
        return $this->hasOne(ReportFormat::class);
    }
}
