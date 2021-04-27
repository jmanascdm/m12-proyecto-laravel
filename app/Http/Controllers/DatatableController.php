<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;

class DatatableController extends Controller
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
        $result = Account::all();
        return view('datatable', compact('result'));
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $account = Account::find($id);
        if($account->delete()) return true;
        else return false;
    }
}
