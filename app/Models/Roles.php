<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $fillable = [
        'name',
        'permission_id'
    ];

    public function permission()
    {
        return $this->belongsTo(Permissions::class, 'permission_id');
    }
}
