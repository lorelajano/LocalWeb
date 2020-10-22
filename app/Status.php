<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Status extends Model
{
    use HasFactory;
    protected $table = 'statuses';

    protected $fillable = [
        'name'
    ];




    public function users(){
        return $this->hasMany('App\User');
    }

}
