<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RightsHoldersUsers extends Model
{
    protected $table = 'rights_holder_users';

    protected $fillable = [
        'rights_holder_id',
        'user_id',
    ];

    public function rightsHolder()
    {
        return $this->belongsTo(RightsHolders::class, 'rights_holder_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
