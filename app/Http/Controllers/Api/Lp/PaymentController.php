<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 07.11.16
 * Time: 10:26
 */

namespace App\Http\Controllers\Api\Lp;

use App\Classes\Funnel\Funnel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Omnipay\Omnipay;

class PaymentController extends Controller
{
    public static $messages = [
        'id.required' => 'Не передан пользователь.',
        'id.exists' => 'Не нашли пользователя.',
        'amount.required' => 'Необходимо указать стоимость.',
    ];

    public function get(Request $request)
    {
        $result = [];

        if (empty($request->invoiceId)) {
            $this->response->errorBadRequest();
        } else {
            $invoice = DB::connection('oldMysql')
                ->table('payment')
                ->where('_invoce', '=', $request->invoiceId)
                ->first();

            if ($invoice) {
                $user = DB::connection('oldMysql')
                    ->table('users')
                    ->where('id', '=', $invoice->_id_user)
                    ->first();

                $result = [
                    'invoiceId' => $invoice->_invoce,
                    'amount' => $invoice->_amount,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'name' => $user->name,
                    'surname' => $user->surname
                ];
            }
        }

        return $this->response->array($result);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:oldMysql.users',
            'amount' => 'required'
        ], self::$messages);

        if ($validator->fails()) {
            $this->response->errorBadRequest($validator->messages());
        } else {
            $user = DB::connection('oldMysql')
                ->table('users')
                ->where('id', '=', $request->id)
                ->first();

            $invoice = Funnel::addPayment($request->id, $request->amount, 0, 0, '', $user->email . ':0:' . '11 скриптов и индикаторов');

            return $this->response->array([
                'invoice' => $invoice
            ]);
        }
    }

    public function pay(Request $request)
    {
        $result = null;

        if (!empty($request->paymentSystem) && !empty($request->invoiceId)) {
            $invoice = DB::connection('oldMysql')
                ->table('payment')
                ->where('_invoce', '=', $request->invoiceId)
                ->first();

            if (!empty($request->name)) {
                DB::connection('oldMysql')
                    ->table('users')
                    ->where('id', '=', $invoice->_id_user)
                    ->update([
                        'name' => $request->name
                    ]);
            }

            switch ($request->paymentSystem) {
                case 'WM':
                    DB::connection('oldMysql')
                        ->table('payment')
                        ->where('_invoce', '=', $request->invoiceId)
                        ->update([
                            '_payment_type' => 'Web Money',
                            '_fee' => 0,
                            '_amount' => 1
                        ]);

                    $gateway = Omnipay::create('\Omnipay\WebMoney\Gateway');
                    $gateway->setMerchantPurse('Z229902436381');

                    $response = $gateway->purchase([
                        'amount' => '1.00',
                        'transactionId' => $request->invoiceId,
                        'currency' => 'USD',
                        'testMode' => false,
                        'description' => $request->formComment,
                        'returnUrl' => 'http://cmeinfo.vlevels.ru/success',
                        'cancelUrl' => 'http://cmeinfo.vlevels.ru/payment',
                        'notifyUrl' => 'http://api.vlevels.ru/merchant/webmoney.php'
                    ])->send();

                    $result = [
                        'actionUrl' => $response->getRedirectUrl(),
                        'method' => $response->getRedirectMethod(),
                        'params' => $response->getRedirectData()
                    ];

                    break;
                case 'YM':
                    DB::connection('oldMysql')
                        ->table('payment')
                        ->where('_invoce', '=', $request->invoiceId)
                        ->update([
                            '_payment_type' => 'Yandex.Money',
                            '_fee' => round(($invoice->_amount*0.5)/100, 2)
                        ]);

                    $gateway = Omnipay::create('\yandexmoney\YandexMoney\GatewayIndividual');
                    $gateway->setAccount('41001310031527');
                    $gateway->setLabel($invoice->_comment);
                    $gateway->setPassword('CH+/mBSKzhlKvoX8uKG56att');
                    $gateway->setOrderId($request->invoiceId);
                    $gateway->setMethod('PC');
                    $gateway->setReturnUrl('http://cmeinfo.vlevels.ru/success');
                    $gateway->setCancelUrl('http://cmeinfo.vlevels.ru/payment');

                    $response = $gateway->purchase(['amount' => $invoice->_amount, 'currency' => 'RUB', 'testMode' => false, 'FormComment' => $request->formComment])->send();

                    $result = [
                        'actionUrl' => $response->getEndpoint(),
                        'method' => $response->getRedirectMethod(),
                        'params' => $response->getRedirectData()
                    ];

                    break;

                case 'MC':
                case 'VISA':
                    DB::connection('oldMysql')
                        ->table('payment')
                        ->where('_invoce', '=', $request->invoiceId)
                        ->update([
                            '_payment_type' => 'Yandex.Money',
                            '_fee' => round(($invoice->_amount*0.5)/100, 2)
                        ]);

                    $gateway = Omnipay::create('\yandexmoney\YandexMoney\GatewayIndividual');
                    $gateway->setAccount('41001310031527');
                    $gateway->setLabel($invoice->_comment);
                    $gateway->setPassword('CH+/mBSKzhlKvoX8uKG56att');
                    $gateway->setOrderId($request->invoiceId);
                    $gateway->setMethod('AC');
                    $gateway->setReturnUrl('http://cmeinfo.vlevels.ru/success');
                    $gateway->setCancelUrl('http://cmeinfo.vlevels.ru/payment');

                    $response = $gateway->purchase(['amount' => $invoice->_amount, 'currency' => 'RUB', 'testMode' => false, 'FormComment' => $request->formComment])->send();

                    $result = [
                        'actionUrl' => $response->getEndpoint(),
                        'method' => $response->getRedirectMethod(),
                        'params' => $response->getRedirectData()
                    ];

                    break;
            }
        }

        return $result;
    }
}