<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedirectLog extends Model
{
    protected $fillable = [
        'domain_id', 'url_id', 'client_ip', 'client_country', 'client_city',
        'client_region', 'client_isp',  'client_browser_user_agent',  'client_browser',
        'client_os', 'referer_domain', 'referer_url',
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
