<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    protected $table = 'sites';
    protected $fillable = ['url'];

    public function urls()
    {
        return $this->hasMany('App\SitesUrls', 'site_id','id');
    }
    
}
