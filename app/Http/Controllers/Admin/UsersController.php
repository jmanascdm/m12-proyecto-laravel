<?php

namespace App\Http\Controllers\Admin;

use App\Code;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mail;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $items = User::withTrashed()->select('id', 'name', 'email', 'admin', 'deleted_at')->get();

        return view('admin.users',compact('items'));
    }

    public function update(Request $request)
    {
        request()->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'admin' => 'required|integer|max:1',
        ]);

        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $admin = $request->admin;
        $updated_at = Carbon::now()->toDateTimeString();
        $updated_by = Auth::user()->id;

        $newUser = User::find($id);
        
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->admin = $admin;
        $newUser->updated_by = $updated_by;
        $newUser->updated_at = $updated_at;

        $newUser->save();
    }

    public function create(Request $request)
    {
        $email = $request->email;

        $code = new Code();
        $code->code = Str::random(6);
        $code->created_by = Auth::user()->id;
        $code->save();

        Mail::send('mail.user', ['code' => $code->code], function($message) use ($email) {
            $message->to($email)->subject
                ('Codi de registre | Pagaments INS Camí de Mar');
        });
    }

    public function enable(Request $request)
    {
        $id = $request->id;
        $category = User::withTrashed()->find($id);
        $category->restore();
    }

    public function disable(Request $request)
    {
        $id = $request->id;
        $category = User::find($id);
        $category->delete();
    }

    /* public function delete(Request $request)
    {
        $id = $request->id;
        $category = User::withTrashed()->find($id);
        $category->forceDelete();
    } */
}
