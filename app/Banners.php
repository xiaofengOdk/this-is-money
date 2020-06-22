<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{

    protected $table='banners';
    protected $primaryKey='banner_id';
    public $timestamps=false;
    protected $guarded=[];
}
?>