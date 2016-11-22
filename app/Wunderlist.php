<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wunderlist extends Model
{
    public function user() {
      return $this->belongsTo('App\User');
    }
}
