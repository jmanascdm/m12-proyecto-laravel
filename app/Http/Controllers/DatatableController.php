<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;

class DatatableController extends Controller
{
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
