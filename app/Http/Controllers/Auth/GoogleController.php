<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Socialite;
use Auth;
use Exception;
use App\User; 

class GoogleController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
       return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $usergoogle = User::withTrashed()->where('google_id', $user->id)->first();
            $userdb = User::withTrashed()->where('email', $user->email)->first();
            
            $statement = DB::select("SHOW TABLE STATUS LIKE 'users'");
            $nextId = $statement[0]->Auto_increment;

            if($usergoogle) {
                if($usergoogle->deleted_at == null) {
                    Auth::login($usergoogle);
                }
                return redirect('/');
            } else if($userdb) {
                if($userdb->deleted_at == null) {
                    Auth::login($userdb);
                }
                return redirect('/');
            } else {
                if(preg_match('/^[a-zA-Z0-9]+\@(inscamidemar|xtec)\.cat$/', $user->email)) {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id'=> $user->id,
                        'password' => encrypt('123456dummy'),
                        'created_by' => $nextId,
                        'updated_by' => $nextId
                    ]);
                    Auth::login($newUser);
                    return redirect( route('home') );
                } else {
                    $error_title = 'Email incorrecte';
                    $error_msg = 'Els únics dominis disponibles per registrar-se són <a class="badge badge-info" href="xtec.cat" target="_blank">xtec.cat</a> i 
                    <a class="badge badge-info" href="inscamidemar.cat" target="_blank">inscamidemar.cat</a>.';

                    return redirect( route('error',compact('error_title','error_msg')) );
                }
            }
        } catch (Exception $e) {
            $error_title = 'Hi ha hagut un error amb la comunicació entre la pàgina i Google';
            $error_msg = $e->getMessage();
            
            return redirect( route('error',compact('error_title','error_msg')) );
        }
    }
}
