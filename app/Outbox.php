<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outbox extends Model
{
    // public $timestamps = true;
    protected $table = 'playsms_tblSMSOutgoing';
    protected $primaryKey = 'id';
}
