<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    public function channels() {
        return $this->belongsTo(Channel::class);
    }
}
