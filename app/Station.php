<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'location'];

    public function checkValid(){
        if ($this->valid) {
            return true;
        } else {
            return false;
        }
    }

    public function validation(){
        return $this->hasOne('App\Validation');
    }
}
