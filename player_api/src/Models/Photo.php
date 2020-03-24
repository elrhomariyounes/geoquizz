<?php


namespace gq\player\Models;


use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photo';
    protected $primaryKey ='id';
    public $timestamps=false;
    protected $hidden = ['user_id'];
    protected $columns = array('id','description','position','url','serie_id','game_id','user_id');

    public function scopeExclude($query, $value=array()){
        return $query->select( array_diff( $this->columns,(array) $value) );
    }
}