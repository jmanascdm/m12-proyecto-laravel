<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        IFNULL(categories.category,'<i class=\"badge badge-warning\">NULL</i>') as category, accounts.id as id_account,
        IFNULL(accounts.account,'<i class=\"badge badge-warning\">NULL</i>') as account, `level`, `order`, `title`,
        `description`, `price`, `start_date`, `end_date`,payments.deleted_at
        FROM payments
        LEFT JOIN categories ON id_category = categories.id
        LEFT JOIN accounts ON id_account = accounts.id;");

        return view('admin.payments',compact('items'));
    }

    public function update(Request $request)
    {
        request()->validate([
            'id' => 'nullable|integer',
            'id_category' => 'required|integer|max:20',
            'id_account' => 'required|integer|max:20',
            'level' => 'required|string',
            'order' => 'required|string|max:20',
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        $id = $request->id;
        $id_category = $request->id_category;
        $id_account = $request->id_account;
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

        $newPayment->id_category = $id_category;
        $newPayment->id_account = $id_account;
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
