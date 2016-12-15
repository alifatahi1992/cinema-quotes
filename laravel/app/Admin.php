<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;


//for Authentication on Admin panel
class Admin extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
   use Authenticatable;
}
