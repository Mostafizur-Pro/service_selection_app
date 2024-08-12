<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceName extends Model
{
    use HasFactory;
    protected $table = 'service_name';
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(UserTable::class);
    }
}
