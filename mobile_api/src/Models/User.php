<?php


namespace gq\mobile\Models;


class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'user';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey ='id';
    public $timestamps=true;
}