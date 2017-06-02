<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    public function __construct() {
        view()->composer('partials.nav', function ($view) {

            $categories = DB::table('categories')->select('title', 'id')->get();

            $currentId = (request()->segment(1) == 'category') ? request()->segment(2) : 'home';

            $view->with('categories', $categories);
            $view->with('currentId', $currentId);

        });
    }

    public function login(Request $request){

        if($request->isMethod('post'))
        {

            //dd($request->email);  // $request->input('email')

            $this->validate($request, [
                'email' => 'bail|required|email',
                'password' => 'required|between:6,10',
                'remember' => 'in:remember'
                ], [
                'email.required' => 'email obligatoire',
                'email.email' => 'Syntax email non valide',
                'password.between' => 'le mot de passe doit être compris entre 8 à 10 caractères',
                'password.required' => 'le mot de passe est obligatoire'
                ]);

            if(Auth::attempt([
                'email' => $request->email, 'password' => $request->password])){

                

                session()->flash('message', 'Bienvenu dans le dashboard'); // enregistrer en variable de session

                return redirect()->intended('dashboard'); // redirection propre au niveau de la sécurité

            }

            session()->flash('message', 'Mot de passe ou email invalide');

             return back()->withInput(['email' => $request->email]); // retour en arrière sur la page précédente

         }


         return view('auth.login');

     }

     public function logout() {

        auth()->logout();

        session()->flash('message', 'Thanks so much for visit');

        return redirect()->home();
    }

}
