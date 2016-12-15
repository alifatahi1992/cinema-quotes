<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
  //becuase each quotes belongs to one user
  public function author(){
    return $this->belongsTo('App\Author');
  }
}
