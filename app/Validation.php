<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'validations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'user_id', 'station_id'];

    public function validation()
    {
        return $this->belongsTo('App\Station', 'station_id');
    }
}
