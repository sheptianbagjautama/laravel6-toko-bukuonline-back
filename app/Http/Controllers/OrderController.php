<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware(function($request, $next){

            if(Gate::allows('manage-orders')) return $next($request);
          
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
        $orders = Order::with('user')->with('books')->orderBy('id','desc')->get();

        $status = $request->get('status');
        $buyer_email = $request->get('buyer_email');

        $orders = Order::with('user')
                    ->with('books')
                    ->whereHas('user', function($query) use ($buyer_email) {
                        $query->where('email', 'LIKE', "%$buyer_email%");
                    })
                    ->where('status', 'LIKE', "%$status%")
                    ->orderBy('id','desc')
                    ->get();

        return view('orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
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
        $order = Order::findOrFail($id);
        $order->status = $request->get('status');
        $order->save();
        return redirect()->route('orders.edit', [$order->id])->with('status','Status Order Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
