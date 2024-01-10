<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;
use App\Filters\OrderFilter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $user = $request->user();

        if(!($user != null && $user->tokenCan('admin'))){
            return response()->json(['message'=> 'User is not allowed to view this records'],401);
        }

        $filter = new OrderFilter();
        $filterItems = $filter->transform($request);

        $paginated = $request->query("paginate");

        $order = Order::where($filterItems);

        $order = $order->with('payments');
        $order = $order->with('users');
        $order = $order->with('books');

        //If paginated=true
        if($paginated)
        {    
            return new OrderCollection($order->paginate()->appends($request->query()));
        }
        else
        {
            return new OrderCollection($order->get());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $user = $request->user();

        $order = Order::create([
            'user_id' => $user['id'],
            'payment_id' => $request->input('payment_id'),
            'order_date' => $request->input('order_date'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'street' => $request->input('street'),
            'building_number' => $request->input('building_number'),
            'apartment_number' => $request->input('apartment_number'),
            'zip_code' => $request->input('zip_code'),
            'total_price' => $request->input('total_price')
        ]);

        $order->books()->attach($request->input('books'));

        return new OrderCollection([$order]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
