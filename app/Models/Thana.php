<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'zilla_id']; // Include zilla_id in the fillable array

    public function zilla()
    {
        return $this->belongsTo(Zilla::class);
    }

    // Define relationship with Union
    public function unions()
    {
        return $this->hasMany(Union::class);
    }

    public function crimes()
    {
        return $this->hasMany(Crime::class);
    }

}
