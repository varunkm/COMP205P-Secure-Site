<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Snippet extends Model
{
    protected $fillable = ['text'];

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
