<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Category;
use Str;
use Auth;
use Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware(function($request, $next){

            if(Gate::allows('manage-books')) return $next($request);
          
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
        // $books = Book::with('categories')->orderBy('id','desc')->get();
        $status = $request->get('status');
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';

        if($status){
            $books = Book::with('categories')->where('title', "LIKE", "%$keyword%")->where('status', strtoupper($status))->orderBy('id','desc')->get();
        } else {
            $books = Book::with('categories')->where('title', "LIKE", "%$keyword%")->orderBy('id','desc')->get();
        }

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        \Validator::make($request->all(), [
            "title" => "required|min:5|max:200",
            "description" => "required|min:20|max:1000",
            "author" => "required|min:3|max:100",
            "publisher" => "required|min:3|max:200",
            "price" => "required|digits_between:0,10",
            "stock" => "required|digits_between:0,10",
            "cover" => "required"
        ])->validate(); 

        $new_book = new Book;
        $new_book->title = $request->get('title');
        $new_book->description = $request->get('description');
        $new_book->author = $request->get('author');
        $new_book->publisher = $request->get('publisher');
        $new_book->price = $request->get('price');
        $new_book->stock = $request->get('stock');
        $new_book->status = $request->get('save_action');

        $cover = $request->file('cover');
        if ($cover) {
            $cover_path = $cover->store('book-covers','public');
            $new_book->cover = $cover_path;
        }

        $new_book->slug = Str::slug($request->get('title'));
        $new_book->created_by = Auth::user()->id;
        $new_book->save();
        $new_book->categories()->attach($request->get('categories'));

        if ($request->get('save_action') == 'PUBLISH') {
            return redirect()
                    ->route('books.create')
                    ->with('status','Buku berhasil disimpan dan dipublish');
        } else {
            return redirect()
                    ->route('books.create')
                    ->with('status','Book berhasil disimpan sebagai draft');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit',compact('book'));
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

        $book = Book::findOrFail($id);

        \Validator::make($request->all(), [
            "title" => "required|min:5|max:200",
            "slug" => [
                "required",
                Rule::unique("books")->ignore($book->slug, "slug")
            ],
            "description" => "required|min:20|max:1000",
            "author" => "required|min:3|max:100",
            "publisher" => "required|min:3|max:200",
            "price" => "required|digits_between:0,10",
            "stock" => "required|digits_between:0,10",
        ])->validate();  

        $book->title = $request->get('title');
        $book->slug = $request->get('slug');
        $book->description = $request->get('description');
        $book->author = $request->get('author');
        $book->publisher = $request->get('publisher');
        $book->stock = $request->get('stock');
        $book->price = $request->get('price');

        // $new_cover = $request->file('cover');

        if ($request->file('cover')) {
            if (file_exists(storage_path('app/public/' . $book->cover))) {
                Storage::delete('public/'.$book->cover);
            }
            $file = $request->file('cover')->store('covers','public');
            $book->cover = $file;
        } else {
            $book->cover = $book->cover;
        }

        $book->updated_by = \Auth::user()->id;

        $book->status = $request->get('status');
        $book->slug = Str::slug($request->get('title'));

        $book->save();

        $book->categories()->sync($request->get('categories'));

        return redirect()->route('books.edit', [$book->id])->with('status', 'Buku Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index')->with('status','Buku Berhasil Di Hapus Ke Dalam Tong Sampah');
    }

    public function trash(){
        $books = Book::onlyTrashed()->orderBy('id','desc')->get();
        return view('books.trash', compact('books'));
      }

      public function restore($id){
        $book = Book::withTrashed()->findOrFail($id);
      
        if($book->trashed()){
          $book->restore();
          return redirect()->route('books.trash')->with('status', 'Buku Berhasil Di Kembalikan');
        } else {
          return redirect()->route('books.trash')->with('status', 'Buku Tidak Berada Dalam Status tong sampah');
        }
      }

      public function deletePermanent($id){
        $book = Book::withTrashed()->findOrFail($id);
      
        if(!$book->trashed()){
          return redirect()->route('books.trash')->with('status', 'Buku tidak berada dalam status tong sampah')->with('status_type', 'alert');
        } else {
          $book->categories()->detach();
          $book->forceDelete();
      
          return redirect()->route('books.trash')->with('status', 'Buku berhasil didelete permanent!');
        }
      }
}
