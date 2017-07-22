<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Mail;
use Exception;
use Session;

use App\Reservation;


class DashboardController extends Controller
{
    public function basic_email()
    {
        $data = array('name' => "Virat Gandhi");

        Mail::send(['text' => 'mail'], $data, function ($message) {
            $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
            $message->from('xyz@gmail.com', 'Virat Gandhi');
        });
        echo "Basic Email Sent. Check your inbox.";
    }

    public function html_email()
    {
        $data = array('name' => "Virat Gandhi");
        Mail::send('mail', $data, function ($message) {
            $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
            $message->from('xyz@gmail.com', 'Virat Gandhi');
        });
        echo "HTML Email Sent. Check your inbox.";
    }

    public function attachment_email()
    {
        $data = array('name' => "Virat Gandhi");
        Mail::send('mail', $data, function ($message) {
            $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
            $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
            $message->from('xyz@gmail.com', 'Virat Gandhi');
        });
        echo "Email Sent with attachment. Check your inbox.";
    }


    /**
     * @param Request $request
     * @return string
     */
    public function sendEmail(Request $request)
    {
        $data = $request->all();
        $user = User::where('email','=', $data['emailto'])->get();

        if (count($user) > 0) {
            try {
                /*Mail::send(['text' => 'mail'], ['user' => $user],
                    function ($message) use ($user, $data) {
                        $message->to($user[0]['email'], $data['message'])->subject($data['subject']);
                        $message->from('info@enigmaescaperoom.ir', 'EnigmaEscapeRoom');
                    });*/
                    
                     $to = $data['emailto'];
                     $subject = $data['subject'];
                     $txt = $data['message'];
                     $headers = "From: info@enigmaescaperoom.ir"."\r\n";
                     mail($to,$subject,$txt,$headers);

                return "<div class='alert alert-success'>ایمیل بدرستی ارسال گردید</div>";
            } catch (Exception $ex) {
                return "<div class='alert alert-danger'>در ارسال ایمیل خطایی رخ داد</div>";
            }
        } else {
            return "<div class='alert alert-danger'>در ارسال ایمیل خطایی رخ داد</div>";
        }
        return "<div class='alert alert-danger'>در ارسال ایمیل خطایی رخ داد</div>";
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        session(['current_menu_select' => 'dashboard']);
        $allReserved = count(Reservation::all());
        return view('admin.dashboard', ['allReserved' => $allReserved, 'emails' => $this->getEmailList()]);
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    private function getEmailList()
    {
        $users = User::all('email');
        $array_email = [];
        foreach ($users as $user) {
            array_push($array_email, $user->email);
        }
        return json_encode($array_email);
    }

    /**
     * unRead Reservations
     * @return int
     */
    private function getUnreadedReservations()
    {
        $reservations = Reservation::all()->where('reading', 0);
        if (count($reservations) > 0) {
            return count($reservations);
        }
        return 0;
    }

    /**
     * activate and unread
     *
     * @return int
     */
    private function getReservedReservations()
    {
        $reservations = DB::select(DB::raw("SELECT * FROM `reservations` WHERE `activate` = 1 and `canceled` = 0 and `reading`=0"));
        if (count($reservations) > 0) {
            return count($reservations);
        }
        return 0;
    }

    private function getCanceledReservations()
    {
        $reservations = DB::select(DB::raw("SELECT * FROM `reservations` WHERE `canceled` = 1 and `reading`=0"));
        if (count($reservations) > 0) {
            return count($reservations);
        }
        return 0;
    }

}
