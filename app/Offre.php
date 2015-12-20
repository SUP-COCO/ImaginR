<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offres';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['price', 'nb_days'];
}