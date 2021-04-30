<?php

namespace App\Http\Controllers\DataTables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use DB;

class CategoriesController extends Controller
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
        $items = DB::select("SELECT categories.id as id, `category`,
        categories.created_at as created_at, categories.updated_at as updated_at,
        users1.name as created_by, users2.name as updated_by
        FROM categories
        JOIN users users1 ON categories.created_by = users1.id
        JOIN users users2 ON categories.updated_by = users2.id;");

        return view('admin.categories',compact('items'));
    }
}
