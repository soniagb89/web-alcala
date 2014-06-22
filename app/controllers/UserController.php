<?php

class UserController extends BaseController {

    public function viewLogin(){
        return View::make('panel.login');
    }

    public function login(){

        $data = Input::all();
        $credentials = ['username' => $data['username'], 'password' => $data['password']];

        if( Auth::attempt( $credentials ) ){
            return Redirect::route('panel.categorias.index');
        }

        return Redirect::back()->with('login_error', 'Usuario o contraseña incorrectos');
    }

    public function logout(){
        Auth::logout();

        return Redirect::route('index');
    }

} 