<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phonebook_join_Groups extends Model
{
    //
    protected $table = 'playsms_featurePhonebook_group_contacts';
    protected $primaryKey = 'id';
    protected $fillable = (['gpid', 'pid']);
}
