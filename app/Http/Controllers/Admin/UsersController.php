<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;

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
        $items = DB::select("SELECT users0.id, users0.name, users0.email, users0.created_at,
        users0.updated_at, users1.name AS created_by, users2.name AS updated_by, users0.deleted_at
        FROM users users0
        JOIN users users1 ON users0.created_by = users1.id
        JOIN users users2 ON users0.updated_by = users2.id
        WHERE users0.deleted_at IS NULL;");

        return view('admin.users',compact('items'));
    }

    
}
