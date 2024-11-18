<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zilla extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'latitude', 'longitude'
    ];

    public function thanas()
    {
        return $this->hasMany(Thana::class);
    }

    public function crimes()
    {
        return $this->hasMany(Crime::class);
    }

}
