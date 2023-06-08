<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Jackiedo\Cart\Facades\Cart;

class CheckoutController extends Controller
{
    public function show(){
        $shoppingCart = Cart::name('shopping');
        $items = $shoppingCart->getItems();
        $total = $shoppingCart->getTotal();
        $subtotal = $shoppingCart->getSubTotal();
        

        return view('checkout',[
            'items' => $items,
            'total' => $total,
           'subtotal' => $subtotal
        ]);
    }

    public function store(Request $request){
        $shoppingCart = Cart::name('shopping');
        $items = $shoppingCart->getItems();
        $total = $shoppingCart->getTotal();
       
            $data = $request->validate([
                'first_name'=> 'required',
                'last_name'=>'required',
                'email'=>'required|email',
                'address'=>'required',
                'phone'=>'required',
                'country'=> 'required',
                'district' => 'required',
                'province' => 'required',
                'zip' => 'required',
                'payment_gateway' => 'required',
            ]);

            //Create Order
            $address = Address::create([
                'country' => $data['country'],
                'province' => $data['province'],
                'district' => $data['district'],
                'street' => $data['address'],
                'zipcode' => $data['zip'],  
            ]);
            //findng payment gateway idS
            $paymentGateway = PaymentGateway::where('code',$data['payment_gateway'])->first();

            //Create payment

            $payment = Payment::create([
                'payment_gateway_id' => $paymentGateway->id,
                'payment_status' => "NOT_PAID",
                'price_paid' => 0
            ]);

            //Create Order
            $order = Order::create([
                'tracking_id' => "ORG-".uniqid(),
                'total' => $total,
                'full_name' => $data['first_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
               'billing_id' => $address->id,
               'shipping_id' => $address->id,
               'payment_id' => $payment->id
            ]);

//Create Order Items
                foreach ($items as $item){ 
                $orderItems = OrderItem::create([
                    'order_id'=>$order->id,
                    'product_id'=>$item->getId(),
                    'name' => $item->getTitle(),
                    'quantity'=> $item->getQuantity(),
                    'price'=> $item->getPrice()*100,
                ]);

                $shoppingCart->destroy();

                return redirect()->route('payment.show',['paymentGateway' => $data ['payment_gateway']]);
            }
       }
}
