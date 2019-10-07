<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Storage;
use Validator;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(function($request, $next){

            if(Gate::allows('manage-users')) return $next($request);
          
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
        $users = User::orderBy('id','desc')->get();

        $filterKeyword = $request->get('keyword');
        $status = $request->get('status');

         if ($filterKeyword) {
                $users = User::where('email','LIKE',"%$filterKeyword%")
                        ->orderBy('id','desc')
                        ->get();
         }

         if ($status) {
            $users = User::where('status', $status)
                    ->orderBy('id','desc')
                    ->get();
        }

        if($filterKeyword && $status) {
            $users = User::where('email','LIKE',"%$filterKeyword%")
                        ->where('status', $status)
                        ->orderBy('id','desc')
                        ->get();
        }


        // return response()->json($users);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
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
            "name"                      => "required|min:5|max:100",
            "username"                  => "required|min:5|max:20|unique:users",
            "roles"                     => "required",
            "phone"                     => "required|digits_between:10,12",
            "address"                   => "required|min:20|max:200",
            "avatar"                    => "required",
            "email"                     => "required|email|unique:users",
            "password"                  => "required",
            "password_confirmation"     => "required|same:password",
        ])->validate();

        $new_user = new User;
        $new_user->name = $request->get('name');
        $new_user->username = $request->get('username');
        $new_user->roles = json_encode($request->get('roles'));
        $new_user->address = $request->get('address');
        $new_user->phone = $request->get('phone');
        $new_user->email = $request->get('email');
        $new_user->password = Hash::make($request->get('password'));

        if ($request->file('avatar')) {
            $file = $request->file('avatar')->store('avatars','public');
            $new_user->avatar = $file;
        }

        // dd($new_user);
        $new_user->save();
        return redirect()->route('users.create')->with('status', 'Data Pengguna Berhasil Dibuat !');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
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
        Validator::make($request->all(), [
            "name" => "required|min:5|max:100",
            "roles" => "required",
            "phone" => "required|digits_between:10,12",
            "address" => "required|min:20|max:200",
        ])->validate();

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->status = $request->get('status');
        $user->username = $request->get('username');
        $user->roles = json_encode($request->get('roles'));
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');

        if ($request->file('avatar')) {
            if (file_exists(storage_path('app/public/' . $user->avatar))) {
                Storage::delete('public/'.$user->avatar);
            }
            $file = $request->file('avatar')->store('avatars','public');
            $user->avatar = $file;
        } else {
            $user->avatar = $user->avatar;
        }

        $user->save();

        return redirect()->route('users.edit', [$id])->with('status', 'Data Pengguna Berhasil Di Ubah');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('status', 'Data Pengguna Berhasil Di Hapus Permanent');
    }
}
