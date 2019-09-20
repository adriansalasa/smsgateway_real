<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    // public $timestamps = true;
    protected $table = 'playsms_tblSMSInbox';
    protected $primaryKey = 'in_id';
}
