<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['num_serie', 'date_start', 'date_end', 'user_id', 'key', 'valid'];

    public function checkCard(){
        if ($this->valid) {
            $date_start = strtotime($this->date_start);
            $date_end = strtotime($this->date_end);
            $date = strtotime(date('Y-m-d'));

            if($date > $date_start && $date < $date_end) {
                return true;
            } else {
                return false;
            }
        }
    }
}