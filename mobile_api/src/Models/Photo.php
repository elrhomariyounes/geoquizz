<?php


namespace gq\mobile\Models;


use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photo';
    protected $primaryKey ='id';
    public $timestamps=false;
}