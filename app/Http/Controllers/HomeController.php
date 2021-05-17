<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = DB::select("SELECT categories.id, categories.category FROM categories
        JOIN payments ON payments.id_category = categories.id
        WHERE categories.deleted_at IS NULL
        AND payments.deleted_at IS NULL
        AND payments.end_date > CURRENT_DATE
        GROUP BY categories.id,categories.category;");

        return view('home',compact('categories'));
    }

    public function error(Request $request)
    {
        $error_title = $request->error_title;
        $error_msg = $request->error_msg;

        return view('error',compact('error_title','error_msg'));
    }

    public function getPayment(Request $request)
    {
        $id = $request->id;
        $payment = Payment::select('title','description','price')->where("id",$id)->get();

        return $payment;
    }

    public function getPayments(Request $request)
    {
        $id = $request->id;
        $payments = Payment::select('id','title')->where("id_category",$id)->where("end_date")->get();
        $payments = DB::select("SELECT id,title FROM payments
        WHERE id_category = $id AND end_date > CURRENT_DATE;");

        return $payments;
    }

}
