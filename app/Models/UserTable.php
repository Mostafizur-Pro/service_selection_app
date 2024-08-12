<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTable extends Model
{
    use HasFactory;
    protected $table = 'user';

    protected $fillable = ['username', 'service_id'];

    public function service()
    {
        return $this->belongsTo(ServiceName::class);
    }

    public function selected()
    {
        return $this->hasOne(Selected::class);
    }

    public function unselected()
    {
        return $this->hasOne(Unselected::class);
    }
}
