<?php

namespace App\Exports;

use App\Phonebook;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Session;
use Auth;

class PhonebooksExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Phonebook::select('name','mobile','email','tags')->where('uid', Auth::user()->uid)->get();
    }
}
