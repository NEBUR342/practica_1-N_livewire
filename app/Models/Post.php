<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['titulo','descripcion','estado','imagen','categoria','precio','user_id'];

    // Relacion 1-n con user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
