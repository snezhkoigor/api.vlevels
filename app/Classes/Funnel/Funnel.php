<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 14.11.16
 * Time: 12:48
 */

namespace App\Classes\Funnel;


use Illuminate\Support\Facades\DB;

class Funnel
{
    const FUNNEL_TYPE_CME_INFO = 'cmeInfo';

    const FUNNEL_STEP_LP_CME_INFO = 'lp1.cmeInfo';
    const FUNNEL_STEP_HELLO = 'emails.hello';
    const FUNNEL_STEP_LP_PAYMENT = 'lp2.payment';
    const FUNNEL_STEP_INDICATOR_DOWNLOAD = 'emails.indicator.download';
    const FUNNEL_STEP_CME_INFO_ACTIVATED = 'cmeInfo.activated';
    const FUNNEL_STEP_CME_INFO_NOT_ACTIVATED = 'cmeInfo.notActivated';
    const FUNNEL_STEP_PAYMENT_BILL = 'payment.bill';
    const FUNNEL_STEP_CME_INFO_AND_CVS_ACTIVATED = 'cmeInfo.cvs.activated';

    public static function getPayment($invoice)
    {
        $result = null;

        $invoice = DB::connection('oldMysql')
            ->table('payment')
            ->where('invoce', '=', $invoice)
            ->first();

        if (!empty($invoice)) {
            $tariff = null;
            if (!empty($invoice->tariff)) {
                $tariff = DB::connection('oldMysql')
                    ->table('tariffs')
                    ->where('_id', '=', $invoice->tariff)
                    ->first();
            }

            $user = DB::connection('oldMysql')
                ->table('users')
                ->where('id', '=', $invoice->_id_user)
                ->first();

            if (!empty($user)) {
                $result = [
                    'phone' => $user->phone,
                    'name' => $user->name,
                    'email' => $user->email,
                    'invoice' => $invoice->_invoce,
                    'tariff' => $tariff,
                    'product' => empty($tariff) ? '11 скриптов и индикаторов' : $tariff->name,
                    'pay_till' => date('d.m.Y H:i', strtotime('+3 HOUR', $invoice->_date))
                ];
            }
        }

        return $result;
    }

    public static function addPayment($userId, $amount, $fee, $tariff, $paymentType, $comment)
    {
        $invoice = null;
        $lastPayment = DB::connection('oldMysql')
            ->table('payment')
            ->orderBy('_id', 'desc')
            ->first();

        if ($lastPayment) {
            $invoice = (int)$lastPayment->_invoce + 1;

            DB::connection('oldMysql')
                ->table('payment')
                ->insertGetId(
                    [
                        '_id_user' => $userId,
                        '_request' => '',
                        '_invoce' => $invoice,
                        '_date' => time(),
                        '_tariff' => $tariff,
                        '_payment_type' => $paymentType,
                        '_payer' => '',
                        '_payee' => '',
                        '_amount' => $amount,
                        '_fee' => $fee,
                        '_batch' => '',
                        '_cancel' => 0,
                        '_executed' => 0,
                        '_comment' => $comment
                    ]
                );
        }

        return $invoice;
    }

    public static function addFunnelItem($userId, $step, $nextStep = null, $nextStepAlertDt = null, $nextStepAlerted = false, $type = self::FUNNEL_TYPE_CME_INFO)
    {
        return DB::connection('oldMysql')
            ->table('funnel')
            ->insertGetId(
                [
                    'user_id' => $userId,
                    'step' => $step,
                    'next_step' => $nextStep,
                    'added_dt' => date('Y-m-d H:i:s'),
                    'next_step_alert_dt' => !empty($nextStepAlertDt) ? date('Y-m-d H:i:s', strtotime($nextStepAlertDt)) : null,
                    'next_step_alerted' => (bool)$nextStepAlerted,
                    'type' => $type
                ]
            );
    }
}