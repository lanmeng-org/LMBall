<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedirectLog extends Model
{
    protected $fillable = [
        'domain_id', 'url_id', 'client_ip', 'client_position',
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class, 'id', 'domain_id');
    }

    public function url()
    {
        return $this->belongsTo(Url::class, 'id', 'url_id');
    }
}
