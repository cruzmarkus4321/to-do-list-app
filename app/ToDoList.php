<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    protected  $fillable = [
        'title', 'description', 'date_time', 'username'
    ];
}
