<?php

namespace App\Http\Controllers\DataTables;

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
        $items = DB::select("SELECT accounts.id AS id, `establishment`, `account`, `fuc`, `key`,
        accounts.created_at, accounts.updated_at, users1.name as created_by, users2.name as updated_by
        FROM accounts
        JOIN users users1 ON accounts.created_by = users1.id
        JOIN users users2 ON accounts.updated_by = users2.id;");

        return view('admin.accounts', compact('items'));
    }

    public function setAccount(Request $request)
    {
        $column = $request->column;
        $value = $request->value;
        $id = $request->id;

        Account::where('id',$id)->update([$column => $value]);
    }

    public function deleteAccount()
    {

    }
}
