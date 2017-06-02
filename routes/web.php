<?php


Route::get('/', 'FrontController@index')->name('home');
Route::get('/robot/{id}/{slug?}', 'FrontController@showRobot');
Route::get('/tag/{id}', 'FrontController@showRobotByTag');
Route::get('/category/{id}', 'FrontController@showRobotByCategory');

// dashboard

Route::any('login', 'Admin\LoginController@login')->name('login');
Route::get('logout', 'Admin\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function(){
	Route::get('dashboard', 'Admin\DashboardController@index');
	Route::resource('admin/robot', 'Admin\RobotController');
});

/*
class A{}

class B{
	public function __construct(A $a){
		$this->a = $a;
	}

	public function message(){
    	return "Hello world";
    }
}

class Student
{

    protected $ip;

    // le constructeur récupère son IP
    public function __construct(string $ip)
    {
        $this->ip = $ip;
        $this->id = uniqid('', true);
    }
}

// permet de définir des dépendance dans le conteneur, la fonction de callback le container injecte $app qui est une instance de App classe Laravel


app()->singleton('Student', function ($app) {
    return new Student( $app->make('request')->getClientIp() );
});
*/