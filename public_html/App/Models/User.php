<?php

namespace App\Models;

class User extends DatabaseModel
{
	protected static $tableName = "users";
	protected static $columns = ['id','username','email','password','role'];
	protected static $fakeColumns = ['password2'];
	protected static $validationRules = [
					"username"      => "minlength:1",
					"email" 		=> "email,unique:App\Models\User",
					"password" 		=> "minlength:6",
					"password2" 	=> "match:password"

	];
	public function __construct($input = null)
	{
		parent::__construct($input);
		if($this->role === null){
			$this->role = 'user';
		}
	}
	public function gravatar( $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() )
	{
	    $url = 'http://www.gravatar.com/avatar/';
	    $url .= md5( strtolower( trim( $this->email ) ) );
	    $url .= "?s=$s&d=$d&r=$r";
	    if ( $img ) {
	        $url = '<img src="' . $url . '"';
	        foreach ( $atts as $key => $val )
	            $url .= ' ' . $key . '="' . $val . '"';
	        $url .= ' />';
	    }
	    return $url;
	}
	
}