<?php


namespace gq\backoffice\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey ='id';
    public $timestamps=true;
}