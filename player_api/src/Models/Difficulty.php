<?php


namespace gq\player\Models;


use Illuminate\Database\Eloquent\Model;

class Difficulty extends Model
{
    protected $table = 'difficulty';
    protected $primaryKey ='id';
    public $timestamps=false;
}