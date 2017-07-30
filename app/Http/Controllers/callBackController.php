<?php

namespace App\Http\Controllers;

use App;
use App\Reservation;
use App\Transaction;
use Exception;
use Gateway;
use Auth;
use Illuminate\Http\Request;
use Larabookir\Gateway\Exceptions\InvalidRequestException;
use Larabookir\Gateway\Exceptions\NotFoundTransactionException;
use Larabookir\Gateway\Exceptions\PortNotFoundException;
use Larabookir\Gateway\Exceptions\RetryException;
use Session;


class callBackController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function sendDataToBank(Request $request)
    {
        $data = $request->all();

        $request->session()->forget('paymentInfo');
        $request->session()->flush();
        $request->session()->push('paymentInfo', $data);

        if (isset($data) && !empty($data)) {
            try {
               $gateway = Gateway::Zarinpal();
               $gateway->setCallback(url('/callBackRequest'));
               $gateway->price($data['price'])->ready();
               $gateway->setDescription($data['description']);
               $refId = $gateway->refId();
               $transID = $gateway->transactionId();
               $request->user()->Transactions()->attach($transID);

               return $gateway->redirect();

               // Session::flash('reserve_person', 'بازی جدید اضافه گردید');

                //return redirect('/',200);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        return 0;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function requestCallback(Request $request)
    {
        //delete paymentInfo key of session after read
        $data = $request->session()->pull('paymentInfo');
        $gateway = null;
        try {
            $gateway = Gateway::verify();
            $trackingCode = $gateway->trackingCode();
            $refId = $gateway->refId();
            $cardNumber = $gateway->cardNumber();
            if ($trackingCode != null) {
                if (Auth::check()) {
                    if (isset($data)) {
                        $date_reserved = new \DateTime($data[0]['dateSelectForReservedInput']);
                        $time_reserved = new \DateTime($data[0]['timeSelectForReservedInput']);
                        $reserved = new Reservation();
                        $reserved->game_id = $data[0]['gameId'];
                        $reserved->user_id = Auth::User()->id;
                        $reserved->date_reserved = $date_reserved->format('Y-m-d');
                        $reserved->time_reserved = $time_reserved->format('H:i');
                        $reserved->activate = 1;
                        $reserved->canceled = 0;
                        $reserved->law_ok = 1;
                        $reserved->description = '';
                        $reserved->person_count = $data[0]['person_count'];
                        $reserved->sum_price = $data[0]['sumPrice'];
                        $reserved->save();
                    }
                }

            }

            return view('request', ['refId' => $refId, 'cardNumber' => $cardNumber, 'trackingCode' => $trackingCode]);
        } catch (RetryException $e) {
            return view('errpayment', ['errorMessage' => $e->getMessage()]);
        } catch (PortNotFoundException $e) {
            return view('errpayment', ['errorMessage' => $e->getMessage()]);
        } catch (InvalidRequestException $e) {
            return view('errpayment', ['errorMessage' => $e->getMessage()]);
        } catch (NotFoundTransactionException $e) {
            return view('errpayment', ['errorMessage' => $e->getMessage()]);
        } catch (Exception $e) {
            return view('errpayment', ['errorMessage' => $e->getMessage()]);
        }
    }
}
