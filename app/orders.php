<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
  protected $table = 'orders';
  public $timestamps = false;

  protected $fillable = ['nama_order','tanggal_order','alamat_order','id_customer'];
}
