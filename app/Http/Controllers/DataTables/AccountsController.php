<?php

namespace App\Http\Controllers\DataTables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Account;

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

    public function getAccounts()
    {
        $items = Account::all();
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
