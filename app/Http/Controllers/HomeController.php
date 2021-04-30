<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Payment;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        return view('home',compact('categories'));
    }

    public function getPayments(Request $request)
    {
        $id = $request->id;
        $payments = Payment::select('id','title')->where("id_category",$id)->where("deleted_at",null)->get();

        return $payments;
    }

    public function getPayment(Request $request)
    {
        $id = $request->id;
        $payments = Payment::select('title','description','price')->where("id",$id)->where("deleted_at",null)->get();

        return $payments;
    }

}
