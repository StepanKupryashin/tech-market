<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return $this->successResponse(
            Order::orders(
                auth()->id()
            )
        );
    }

    public function createOrder(Request $request)
    {
        $products = $request->get('products');
        if($products != null) {
            $order = Order::create([
                'user_id' => auth()->id()
            ]);
            // ide не хочет читать что за обьект я создал поэтому добавил коммент ниже(чтобы можно через ctrl провалиться в саму модель)
            /** @var Order $order  */
            $order->products()->sync($products);

            return $this->successResponse($order);
        }

        return $this->failureResponse('Could not create order');

    }
}
