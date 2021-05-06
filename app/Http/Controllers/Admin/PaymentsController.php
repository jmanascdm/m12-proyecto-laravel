<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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
        $items = DB::select("SELECT payments.id as id, categories.id as id_category,
        categories.category as category, accounts.id as id_account, accounts.account as account,
        `level`, `order`, `title`, `description`, `price`, `start_date`, `end_date`,payments.created_at,
        payments.updated_at, users1.name as created_by, users2.name as updated_by, payments.deleted_at
        FROM payments
        JOIN categories ON id_category = categories.id
        JOIN accounts ON id_account = accounts.id
        JOIN users users1 ON payments.created_by = users1.id
        JOIN users users2 ON payments.updated_by = users2.id;");

        return view('admin.payments',compact('items'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $category = $request->category;
        $account = $request->account;
        $level = $request->level;
        $order = $request->order;
        $title = $request->title;
        $description = $request->description;
        $price = $request->price;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $updated_at = Carbon::now()->toDateTimeString();
        $updated_by = Auth::user()->id;

        if($id) {
            $newPayment = Payment::find($id);
        } else {
            $newPayment = new Payment;
            $newPayment->created_by = $updated_by;
            $newPayment->created_at = $updated_at;
        }

        $newPayment->id_category = $category;
        $newPayment->id_account = $account;
        $newPayment->level = $level;
        $newPayment->order = $order;
        $newPayment->title = $title;
        $newPayment->description = $description;
        $newPayment->price = $price;
        $newPayment->start_date = $start_date;
        $newPayment->end_date = $end_date;
        $newPayment->updated_at = $updated_at;
        $newPayment->updated_by = $updated_by;

        $newPayment->save();
    }

    public function enable(Request $request)
    {
        $id = $request->id;
        $category = Payment::withTrashed()->find($id);
        $category->restore();
    }

    public function disable(Request $request)
    {
        $id = $request->id;
        $category = Payment::find($id);
        $category->delete();
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $category = Payment::withTrashed()->find($id);
        $category->forceDelete();
    }
}
