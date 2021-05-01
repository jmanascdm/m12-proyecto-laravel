<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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
        $id = $request->id;
        $establishment = $request->establishment;
        $account = $request->account;
        $fuc = $request->fuc;
        $key = $request->key;
        $updated_at = Carbon::now()->toDateTimeString();
        $updated_by = Auth::user()->id;

        if($id) {
            $newAccount = Account::find($id);
        } else {
            $newAccount = new Account;
            $newAccount->created_by = $updated_by;
            $newAccount->created_at = $updated_at;
        }
        
        $newAccount->establishment = $establishment;
        $newAccount->account = $account;
        $newAccount->fuc = $fuc;
        $newAccount->key = $key;
        $newAccount->updated_by = $updated_by;
        $newAccount->updated_at = $updated_at;

        $newAccount->save();
    }

    public function deleteAccount(Request $request)
    {
        $id = $request->id;
        
        Account::find($id)->delete();
    }
}
