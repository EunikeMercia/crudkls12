<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }
    public function type(){
        return $this->belongsTo(Contact_Type::class);
    }
    
}
