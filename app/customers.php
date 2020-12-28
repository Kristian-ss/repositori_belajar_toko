<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    protected $table = 'customers';
    public $timestamps = false;

    protected $fillable = ['nama_customer','alamat','nomor_telephone'];
}
