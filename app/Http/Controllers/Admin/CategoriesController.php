<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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
        JOIN users users2 ON categories.updated_by = users2.id
        WHERE categories.deleted_at IS NULL;");

        return view('admin.categories',compact('items'));
    }

    public function setCategory(Request $request)
    {
        $id = $request->id;
        $category = $request->category;
        $updated_at = Carbon::now()->toDateTimeString();
        $updated_by = Auth::user()->id;

        if($id) {
            $newCategory = Category::find($id);
        } else {
            $newCategory = new Category;
            $newCategory->created_by = $updated_by;
            $newCategory->created_at = $updated_at;
        }

        $newCategory->category = $category;
        $newCategory->updated_by = $updated_by;
        $newCategory->updated_at = $updated_at;

        $newCategory->save();
    }
}
