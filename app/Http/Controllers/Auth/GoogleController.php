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
            $finduser = User::withTrashed()->where('google_id', $user->id)->first();
            
            $statement = DB::select("SHOW TABLE STATUS LIKE 'users'");
            $nextId = $statement[0]->Auto_increment;

            $deletedAt = DB::select('SELECT CURRENT_TIMESTAMP')[0]->CURRENT_TIMESTAMP;

            if($finduser) {
                if($finduser->deleted_at == null) {
                    Auth::login($finduser);
                }
                return redirect('/home');
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy'),
                    'created_by' => $nextId,
                    'updated_by' => $nextId
                ]);
                $newUser->delete();
                return redirect('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
