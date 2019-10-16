<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class buycredit extends Model
{
    protected $table = 'Playsms_BuyCredit';

    protected $fillable = ['nomor_tagihan', 'nominal', 'idUser', 'noRek', 'nmRek', 'createUser', 
    					  'confirmYn', 'nm_ATM'];
}
