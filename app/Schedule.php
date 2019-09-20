<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    protected $table = 'playsms_tblSMSOutgoing_queue';
    protected $primaryKey = 'id';
}
