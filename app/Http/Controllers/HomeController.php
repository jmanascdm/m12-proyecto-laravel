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
        WHERE categorias.deleted_at IS NULL
        AND payments.deleted_at IS NULL
        GROUP BY categories.id,categories.category;");

        return view('home',compact('categories'));
    }

    public function getPayment(Request $request)
    {
        $id = $request->id;
        $payment = Payment::select('title','description','price')->where("id",$id)->where("deleted_at",null)->get();

        return $payment;
    }

    public function getPayments(Request $request)
    {
        $id = $request->id;
        $payments = Payment::select('id','title')->where("id_category",$id)->where("deleted_at",null)->get();

        return $payments;
    }

}
