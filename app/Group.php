<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = true;
    protected $table = 'playsms_featurePhonebook_group';
    protected $primaryKey = 'id';
    protected $fillable = (['uid', 'name', 'code']);
}
