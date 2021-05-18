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
        IFNULL(categories.category,'NULL') as category, accounts.id as id_account, IFNULL(accounts.account,'NULL') as account,
        `level`, `order`, `title`, `description`, `price`, `start_date`, `end_date`,payments.deleted_at
        FROM payments
        LEFT JOIN categories ON id_category = categories.id
        LEFT JOIN accounts ON id_account = accounts.id;");

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
