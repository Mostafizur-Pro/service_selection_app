<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selected extends Model
{
    use HasFactory;
    protected $table = 'selected';

    protected $fillable = ['user_id', 'service_id'];

    public function user()
    {
        return $this->belongsTo(UserTable::class);
    }

    public function service()
    {
        return $this->belongsTo(ServiceName::class);
    }
}
