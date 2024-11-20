<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'bn_name', 'thana_id']; // Mass assignable fields

    // Define relationship with Thana
    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }

    public function crimes()
    {
        return $this->hasMany(Crime::class);
    }

}
