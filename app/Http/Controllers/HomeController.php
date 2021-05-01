<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        WHERE payments.deleted_at IS NULL
        GROUP BY categories.id,categories.category;");

        return view('home',compact('categories'));
    }

}
