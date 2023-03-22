<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    use HasFactory;

    protected $table = "resellers";

    public function users()
    {
        return $this->hasMany(User::class, 'email', 'username');
    }
}
