<?php

namespace App\Models;

class Comment extends DatabaseModel
{

    protected static $columns = ['id', 'user_id', 'movie_id', 'created', 'comment'];

    protected static $tableName = "comments";

    protected static $validationRules = [
    			'user_id' => 'numeric,exists:\App\Models\User',
    			'movie_id'=> 'numeric,exists:\App\Models\Movies',
    			'comment' => 'minlength:10,maxlength:1600'
    ];

    public function user()
    {
    	return new User($this->user_id);
    }

    
}