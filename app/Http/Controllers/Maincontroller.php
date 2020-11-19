<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Order;

class Maincontroller extends Controller
{
    public function search(Request $request)
    {
        $customer= null;
        $query = Customer::with('order.payment');
        if ($request->name) {
            
            $customer = $query->where('company_name', $request->name)->orWhere('mobile', $request->name)->first();
        }
        return view('welcome', compact('customer'));
    }

    public function pay(Request $request) 
    {

        $amount = $request->payment;
        foreach ($request->serail as $key => $value) {
            $get = Payment::where('order_id', $value)->get()->sum('paid_amount');
            $order = Order::find($value);
            if ($get < $order->grand_total) {
                $due = $order->grand_total - $get;
                
                if ($amount < $due) {
                    $data['paid_amount'] = $amount;
                    $data['payment_status'] = 'due';
                } else {
                    $data['paid_amount'] = $due;
                    $data['payment_status'] = 'paid';
                }
                $data['order_id'] = $value;
                $data['customer_id'] = $order->customer_id;
                
                
                if ($amount > 0) {
                    Payment::create($data);
                }
                $amount = ($amount - $order->grand_total);
            }
        }
        
    

    $report = Order::with('payment')->whereIn('id', $request->serail)->get();

    $customer = Customer::find($request->customer);
    return view('report', compact('report', 'customer'));
    }

    public function due(Request $request)
    {
        $customer = Customer::with('order.payment')->get();
        
        return view('due', compact('customer'));
    }

}
