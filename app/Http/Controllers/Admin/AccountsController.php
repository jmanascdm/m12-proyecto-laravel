<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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

    public function index()
    {
        $items = Account::withTrashed()->select('id', 'establishment', 'account', 'fuc', 'key', 'deleted_at')->get();

        return view('admin.accounts', compact('items'));
    }

    public function getAccounts()
    {
        $items = Account::select('id','account')->get();

        return $items;
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'establishment' => 'required|integer|max:11',
            'account' => 'required|string|max:150',
            'fuc' => 'required|string|max:150',
            'key' => 'required|string|max:150'
        ]);
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

    public function enable(Request $request)
    {
        $request->validate([
            'id' => 'integer'
        ]);
        $id = $request->id;
        $category = Account::withTrashed()->find($id);
        $category->restore();
    }

    public function disable(Request $request)
    {
        $request->validate([
            'id' => 'integer'
        ]);
        $id = $request->id;
        $category = Account::find($id);
        $category->delete();
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'integer'
        ]);
        $id = $request->id;
        $account = Account::withTrashed()->find($id);
        $account->forceDelete();
    }
}
