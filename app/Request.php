<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['request', 'response', 'url', 'ip', 'auth_id', 'result', 'subject_type'];
}
