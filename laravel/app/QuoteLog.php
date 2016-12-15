<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteLog extends Model
{
   //the reason is because we change name of table from quote_logs to quote_log in migration
    protected $table = 'quote_log';
}
