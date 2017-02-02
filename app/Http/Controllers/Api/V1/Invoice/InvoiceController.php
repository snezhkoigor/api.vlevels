<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 14.11.16
 * Time: 13:28
 */

namespace App\Http\Controllers\Api\V1\Invoice;


use App\Http\Controllers\Controller;
use App\Classes\Invoice\Invoice;
use Illuminate\Http\Request;
use Validator;

class InvoiceController extends Controller
{
    public static $messages = [
        'user_id.required' => 'No user in request.',
        'user_id.exists' => 'No user.',
        'amount.required' => 'No amount in request.',
        'product_id.required' => 'No product in request.',
        'product_id.exists' => 'No product.',
        'payment_system_id.required' => 'No payment system in request.',
        'payment_system_id.exists' => 'No payment system.',
    ];

    public function add(Request $request)
    {
        $result = null;

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:oldMysql.users',
            'amount' => 'required',
            'product_id' => 'required|exists:oldMysql.products',
            'payment_system_id' => 'required|exists:oldMysql.payment_systems'
        ], self::$messages);

        if ($validator->fails()) {
            $this->response->errorBadRequest($validator->messages());
        } else {
            $invoice = new Invoice();
            $invoice->setConnection('oldMysql');
                $invoice->user_id = $request->user_id;
                $invoice->dt_added = date('Y-m-d H:i:s');
                $invoice->is_executed = false;
                $invoice->is_cancelled = false;
                $invoice->payment_system_id = $request->payment_system_id;
                $invoice->product_id = $request->product_id;
                $invoice->plan_id = $request->plan_id;
                $invoice->dt_executed = null;
                $invoice->dt_cancelled = null;
                $invoice->amount = $request->amount;
                $invoice->currency = $request->currency;
            $invoice->save();

            return $this->response->array([
                'invoice' => $invoice
            ]);
        }
    }
}