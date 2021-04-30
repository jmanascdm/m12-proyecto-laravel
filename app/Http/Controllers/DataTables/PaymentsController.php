<?php

namespace App\Http\Controllers\DataTables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payment;
use DB;

class PaymentsController extends Controller
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
        $items = DB::select("SELECT payments.id as id, categories.category as id_category, accounts.account as id_account,
        `level`, `order`, `title`, `description`, `price`, `start_date`, `end_date`, `enabled`,
        payments.created_at, payments.updated_at, users1.name as created_by, users2.name as updated_by
        FROM payments
        JOIN categories ON id_category = categories.id
        JOIN accounts ON id_account = accounts.id
        JOIN users users1 ON payments.created_by = users1.id
        JOIN users users2 ON payments.updated_by = users2.id;");

        return view('admin.payments',compact('items'));
    }

    public function deletePayment(Request $request)
    {
        $id = $request->id;
        Payment::find($id)->delete();

        return $id;
    }
}
