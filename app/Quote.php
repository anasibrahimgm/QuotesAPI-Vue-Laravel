<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $table = 'vue_quotes';

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
