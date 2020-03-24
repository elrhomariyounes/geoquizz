<?php


namespace gq\player\Models;


use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'game';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey ='id';
    public $timestamps=true;
    protected $columns = array('id','token','nb_photos','state','score','player','serie_id','created_at','updated_at');

    public function scopeExclude($query, $value=array()){
        return $query->select( array_diff( $this->columns,(array) $value) );
    }

    public function serie(){
        return $this->belongsTo('gq\player\Models\Serie');
    }
}