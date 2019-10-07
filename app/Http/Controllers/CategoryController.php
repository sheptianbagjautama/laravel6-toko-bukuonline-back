<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Str;
use Storage;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(function($request, $next){

            if(Gate::allows('manage-categories')) return $next($request);
          
            abort(403, 'Anda tidak memiliki cukup hak akses');
          });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('id','desc')->get();
        // return response()->json($categories);
        $filterKeyword = $request->get('keyword');

        if ($filterKeyword) {
            $categories = Category::where("name","LIKE","%$filterKeyword%")
                        ->orderBy('id','desc')
                        ->get();
        }
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            "name" => "required|min:3|max:20",
            "image" => "required"
          ])->validate();

        $name = $request->get('name');
        
        $new_category = new Category;
        $new_category->name = $name;

        if ($request->file('image')) {
            $image_path = $request->file('image')->store('category_image', 'public');
            $new_category->image = $image_path;
        }

        $new_category->created_by = \Auth::user()->id;
        $new_category->slug = Str::slug($name,'-');
        $new_category->save();
        // return response()->json($new_category);
        return redirect()->route('categories.create')->with('status', 'Data Kategori Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $category = Category::findOrFail($id);

        \Validator::make($request->all(), [
            "name" => "required|min:3|max:20",
            // "image" => "required",
            "slug" => [
              "required",
              Rule::unique("categories")->ignore($category->slug, "slug")
            ]
          ])->validate();

        $name = $request->get('name');
        $category->name = $name;

        if ($request->file('image')) {
            if (file_exists(storage_path('app/public/' . $category->image))) {
                Storage::delete('public/'.$category->image);
            }
            $file = $request->file('image')->store('category_image','public');
            $category->image = $file;
        } else {
            $category->image = $category->image;
        }

        $category->updated_by = \Auth::user()->id;
        $category->slug = Str::slug($name, '-');

        $category->save();
        // return response()->json($category);
        return redirect()->route('categories.edit',[$id])->with('status','Data Kategori Berhasil Di Ubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('status', 'Kategori Berhasil dipindahkan ke tong sampah');
    }

    /**
     * Remove the specified resource to trash
     */
    public function trash(){
        $categories = Category::onlyTrashed()->orderBy('id','desc')->get();
        return view('categories.trash', compact('categories'));
    }

    /**
     * Restore the specified resource
     */
    public function restore($id){
        $category = Category::withTrashed()->findOrFail($id);

        if ($category->trashed()) {
            $category->restore();
        } else {
            return redirect()->route('categories.index')->with('status','Kategori tidak berada didalam tong sampah');
        }

        return redirect()->route('categories.index')->with('status','Kategori berhasil di kembalikan');
    }

    /**
     * Delete Permanent
     */
    public function deletePermanent($id){
        $category = Category::withTrashed()->findOrFail($id);

        if (!$category->trashed()) {
            return redirect()->route('categories.index')->with('status','Tidak bisa melakukan delete permanent apabila kategori masih aktif');
        } else {
            $category->forceDelete();
        }

        return redirect()->route('categories.index')->with('status','Kategori berhasil di delete permanen');
    }

    /**
     * Ajax Search
     */
    public function ajaxSearch(Request $request) {
        $keyword = $request->get('q');
        $categories = Category::where("name","LIKE","%$keyword%")->get();
        return $categories;
    }
}
