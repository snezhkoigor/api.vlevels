<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 08.11.16
 * Time: 11:05
 */

namespace App;


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

    public static function addFunnelItem($user_id, $step, $nextStep = null, $nextStepAlertDt = null, $nextStepAlerted = false, $type = self::FUNNEL_TYPE_CME_INFO)
    {
        return DB::connection('oldMysql')
            ->table('funnel')
            ->insertGetId(
                [
                    'user_id' => $user_id,
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