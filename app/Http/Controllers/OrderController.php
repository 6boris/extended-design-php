<?php

namespace App\Http\Controllers;

use App\Services\PayServices;
use Illuminate\Http\Request;
use App\Services\OrderServices;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    /**
     * list the orders by user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = OrderServices::GetOrderByUser();

        return view('orders.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pay_channels = PayServices::GetAllPayChannel();
        return response()->json($pay_channels);
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = OrderServices::CreateOrder($request);

        return redirect()->to('orders/' . $order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = OrderServices::FindOrderById($id);

        return view('orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
