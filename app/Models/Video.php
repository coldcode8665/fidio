<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','video','title','description','thumbnail','visibility','price'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function views(){
        return $this->hasMany(View::class);
    }

}
