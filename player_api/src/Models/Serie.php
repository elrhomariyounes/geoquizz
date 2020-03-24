<?php


namespace gq\player\Models;


use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table = 'serie';
    protected $primaryKey ='id';
    public $timestamps=false;

    public function photos(){
        return $this->hasMany('gq\player\Models\Photo');
    }

    public function difficulty(){
        return $this->belongsTo('gq\player\Models\Difficulty');
    }
}