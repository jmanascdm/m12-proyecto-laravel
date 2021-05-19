<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Category;

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
        $items = Category::withTrashed()->select('id','category','deleted_at')->get();

        return view('admin.categories',compact('items'));
    }

    public function getCategories()
    {
        $items = Category::select('id', 'category')->get();
        
        return $items;
    }

    public function update(Request $request)
    {
        request()->validate([
            'id' => 'nullable|integer',
            'category' => 'required|string|max:150'
        ]);

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

    public function enable(Request $request)
    {
        $request->validate([
            'id' => 'integer'
        ]);
        $id = $request->id;
        $category = Category::withTrashed()->find($id);
        $category->restore();
    }

    public function disable(Request $request)
    {
        $request->validate([
            'id' => 'integer'
        ]);
        $id = $request->id;
        $category = Category::find($id);
        $category->delete();
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'integer'
        ]);
        $id = $request->id;
        $category = Category::withTrashed()->find($id);
        $category->forceDelete();
    }
}
