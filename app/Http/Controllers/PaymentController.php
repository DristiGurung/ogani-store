<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function show($paymentGateway){
        if(!session()->has('orderId')){
            return redirect('home');
        }

        $order = Order::where('tracking_id', session('orderId'))->first();
            if($paymentGateway=="cod"){
                return view('payments.cod');
            }
            if($paymentGateway=="khalti"){
                $parameters = [
                        'return_url' => route('thankyou'),
                        'website_url' => config('app.url'),
                        'amount' => $order->total,
                        'purchase_order_id'=>$order->tracking_id,
                        'purchase_order_name'=>"ECOMMERCE ORDER" . $order->tracking_id,
                ];
                $response = Http::withHeaders([
                    'Authorization'=>'Key '. config('khalti.live_secret_key')
                    ])
                    ->post(config('khalti.base_url'). '/epayment/initiate/', $parameters);
            
                    if($response->failed()){
                        dd('Payment with Khalti failed');
                    }
                    $data = $response->json();
                    return redirect($data['payment_url']);
                }
                
                
            }
    public function thankyou(Request $request){
        $data = $request->all();
            //dd($data);

            $order = Order::where('tracking_id', $data['purchase_order_id'])->firstOrFail();
            $orderPayment = $order->payment()->update([
                'payment_status' => 'PAID',
                'price_paid' => $data['amount'],
                'transaction_id' => $data['transaction_id'],
            ]);
            return view('thankyou');
        }
}
