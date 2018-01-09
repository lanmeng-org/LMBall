<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = [
        'domain_id', 'url', 'redirect_url', 'description',
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class, 'id', 'domain_id');
    }
}
