<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Account;
use DB;

class AccountsController extends Controller
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
        $items = DB::select("SELECT accounts.id AS id, `establishment`, `account`, `fuc`, `key`, accounts.created_at,
        accounts.updated_at, users1.name as created_by, users2.name as updated_by, accounts.deleted_at
        FROM accounts
        JOIN users users1 ON accounts.created_by = users1.id
        JOIN users users2 ON accounts.updated_by = users2.id
        WHERE accounts.deleted_at IS NULL;");

        return view('admin.accounts', compact('items'));
    }

    public function setAccount(Request $request)
    {
        
    }

    public function deleteAccount(Request $request)
    {
        $id = $request->id;
        
        Account::find($id)->delete();
    }
}
