<?php 

namespace App\Services;
use App\Models\User;
use App\Services\Exceptions\InsufficientPrivilegesException;
use App\Models\Exceptions\ModelNotFoundException;

class AuthenticationService
{
	private static $currentUser;

	public function __construct()
	{
		if(! isset($_SESSION['AuthenticationService'])){
			$this->resetSession();
		}
		if(isset($_SESSION['AuthenticationService']['currentUser']))
		{
			try{
				//if the user is in the database
				static::$currentUser = User::findBy('email', $_SESSION['AuthenticationService']['currentUser']->email);
				
			} catch (ModelNotFoundException $e){
				//user has signed out, reset session
				$this->resetSession();
			}
		}
	}
	public function resetSession()
	{
		$_SESSION['AuthenticationService'] = [
					'currentUser' => null ];
	}

	public function attempt($email, $password)
	{
		// get the user with the matching email
		try{
		  $user = User::findBy('email', $email);
		} catch (ModelNotFoundException $e){
			return false;
		}

		//compare passwords
		if($this->comparePassword($password, $user)){
				$this->loginUser($user);
				return true;			
			}
			return false;
	}
	public function check()
	{
		return(static::$currentUser ? true : false);
	}

	private function comparePassword($password, User $user)
	{
		if (password_verify($password, $user->password)) {
			if(password_needs_rehash($user->password, PASSWORD_DEFAULT)){
				$user->password = password_hash($password, PASSWORD_DEFAULT);
				$user->store();
			}
			return true;
		}
		return false;
	}
	public function loginUser(User $user)
	{
		$_SESSION['AuthenticationService']['currentUser'] = $user;
		static::$currentUser = $user;
	}
	public function user()
	{
		return static::$currentUser;
	}
	public function logout()
	{
		unset($_SESSION['AuthenticationService']);
		static::$currentUser = null;
	}
	
	public function isAdmin()
	{
		if($this->check()){
			return static::$currentUser->role === 'admin';
		}
	}
	public function mustBeAdmin()
	{
		if( ! $this->isAdmin()) {
			throw new InsufficientPrivilegesException();
		}
	}
}