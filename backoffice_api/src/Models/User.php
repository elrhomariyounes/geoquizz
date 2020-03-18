<?php


namespace gq\backoffice\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey ='id';
    public $timestamps=true;
}