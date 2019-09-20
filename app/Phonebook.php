<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phonebook extends Model
{
    public $timestamps = true;
    protected $table = 'playsms_featurePhonebook';
    protected $primaryKey = 'id';
    protected $fillable = (['uid', 'mobile', 'name', 'email', 'tags']);
}
