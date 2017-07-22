<?php

namespace App\Http\Controllers;

use App\Post;
use App\Setting;
use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Game;
use App\Reservation;
use App\Slider;
use Auth;
use DB;
use Mail;
use Session;
use function Sodium\compare;

class DefaultController extends Controller
{


    /**
     * @param Request $request
     * @return string
     */
    public function sendEmail(Request $request)
    {
        $data = $request->all();
          try {
                $to = "info@enigmaescaperoom.ir";;
                $subject = $data['subject'];
                $txt = $data['message'];
                $headers = "From: ".$data['emailto']. "\r\n";
                $mail=mail($to,$subject,$txt,$headers);
                return "<div class='alert alert-success'>ایمیل بدرستی ارسال گردید</div>";
            } catch (Exception $ex) {
                return "<div class='alert alert-danger'>در ارسال ایمیل خطایی رخ داد</div>";
            }
         
        return "<div class='alert alert-danger'>در ارسال ایمیل خطایی رخ داد</div>";
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function renderPage(Request $request)
    {
        $games = Game::all()->where('activate', 1);
        $sliders = Slider::all();
        $setting = Setting::all();
        $posts = Post::where('activate', '=', 1)
            ->orderBy('id', 'desc')->take(5)->get();

        foreach ($posts as $post) {
            $content = $post->content;
            $content = preg_replace("/<img[^>]+\>/i", "", $content);
            $post->content = $content;
        }

        if (Auth::check()) {
            $user = Auth::user();
        } else {
            $user = null;
        }

        $status = $request->session()->get('status');

        if($status == 'ok'){ return view('home', ['status' => $status ,'sliders' => $sliders, 'games' => $games, 'setting' => $setting, 'posts' => $posts, 'user' => $user]); }

        return view('home', ['sliders' => $sliders, 'games' => $games, 'setting' => $setting, 'posts' => $posts, 'user' => $user]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function drawTableReservation(Request $request)
    {
        $game_id = $request['gameId'];
        $nextWeek = null;
        $lastWeek = null;
        $sDate = $request['sDate'];
        $nowDate = new \DateTime('now');
        $pastWeek = new \DateTime($sDate);
        $interval = $nowDate->diff($pastWeek);
        $disableClass = 0;
        if ($interval->format('%R%a') < 0) {
            $disableClass = 1;
        }

        if (isset($game_id)) {
            $game = Game::findOrFail($game_id);
            $game_price = $game->price;
            if ($game) {
                $game_time = intval($game->minutes);
                $game_start = new \DateTime('09:30:00');
                $game_end = new \DateTime('22:30:00');
                $count_clock = $game_start->diff($game_end);
                if (empty($sDate)) {
                    $start_date = \date('Y/m/d');
                    $tempDate = \date('Y/m/d');
                    $nextWeek = date('Y/m/d', strtotime($tempDate . "+7 days"));
                    $lastWeek = date('Y/m/d', strtotime($tempDate . "-7 days"));
                } else {
                    $start_date = \date($request['sDate']);
                    $nextWeek = date('Y/m/d', strtotime($request['sDate'] . "+7 days"));
                    $lastWeek = date('Y/m/d', strtotime($request['sDate'] . "-7 days"));
                }

                $count_games = floor(($count_clock->h * 60) / $game_time);
                $tableHead = '';
                $table = '';
                $i = 0;
                for ($i = 0; $i <= 6; $i++) {
                    $date = \Morilog\Jalali\jDate::forge($start_date)->reforge("+ $i days")->format('%d %B ، %Y');
                    $dateMiladi = date("Y-m-d", strtotime($start_date . " + $i day"));
                    $tableHead .= "<th date-miladi='$dateMiladi' date-shamsi='$date' class='text-center' style='background-color: #121b25;color: yellow;'>" . $date . "</th>";
                }
                $i = 0;
                $timed = '';
                for ($i = 0; $i <= $count_games; $i++) {
                    $table .= "<tr>";
                    for ($j = 0; $j <= 6; $j++) {
                        $dateMiladi = date("Y-m-d", strtotime($start_date . " + $j day"));
                        $timed = $game_start->format('H:i');
                        if ($disableClass) {
                            if ($this->findReservItem($dateMiladi, $timed, $game_id)) {
                                $table .= "<td class='dataReservedDisable'><div class='span'>رزرو شده</div></td>";
                            } else {
                                $table .= "<td class='dataDisable'>$timed</td>";
                            }
                        } else {
                            if ($this->findReservItem($dateMiladi, $timed, $game_id)) {
                                $table .= "<td class='dataReservedDisable'><div class='span'>رزرو شده</div></td>";
                            } else {
                                $dateShamsi = \Morilog\Jalali\jDate::forge($dateMiladi)->format('Y-m-d');
                               
                                $TEMPTime = strtotime("+".$game_time." minutes", strtotime($timed));
                                
                                if(date('H:i') > $timed && ($dateMiladi <= date('Y-m-d') )){
                                     $table .= "<td class='dataReservedDisable2'><div class='span'>پایان مهلت</div></td>";
                                }else{
                                   $table .= "<td class='dataReserved table-item-reservation' game-price='$game_price' date-miladi='$dateMiladi' date-shamsi='$dateShamsi' time-select='$timed'>$timed <i class='fa fa-clock-o' aria-hidden='true'></i></td>";  
                                }
                               
                            }
                        }
                    }
                    $game_start->add(new \DateInterval('PT' . $game_time . 'M'));
                    $table .= "</tr>";
                }
            } else {
                $table = '<td colspan="12"> خطای موجود است </td>';
            }
        } else {
            $table = '<td colspan="12"> خطای موجود است </td>';
        }

        return ['tableBody' => $table, 'tableHead' => $tableHead, 'nextWeek' => $nextWeek, 'lastWeek' => $lastWeek];
    }


    /**
     * @param $date
     * @param $time
     * @param $game
     * @return int
     */
    public function findReservItem($date, $time, $game)
    {
        $result = DB::select(DB::raw("SELECT * FROM `reservations` WHERE `date_reserved`= '$date' and `time_reserved` = '$time' and `game_id` = $game"));
        if (count($result) > 0) {
            return 1;
        } else {
            return 0;
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reservedgameforuser(Request $request)
    {
        $status = 'not reserved';
        if (Auth::check()) {
            $data = $request->all();
            if (isset($data)) {
                $date_reserved = new \DateTime($data['dateSelectForReservedInput']);
                $time_reserved = new \DateTime($data['timeSelectForReservedInput']);
                $reserved = new Reservation();
                $reserved->game_id = $data['gameId'];
                $reserved->user_id = Auth::User()->id;
                $reserved->date_reserved = $date_reserved->format('Y-m-d');
                $reserved->time_reserved = $time_reserved->format('H:i:s');
                $reserved->activate = 1;
                $reserved->canceled = 0;
                $reserved->description = '';
                $reserved->person_count = $data['person_count'];
                $reserved->sum_price = 0;
                $reserved->save();
                $request->session()->flash('status', 'ok');
                return redirect('/');

            }else{
                $request->session()->flash('status', 'no');
                return redirect('/');
            }
        }

        $request->session()->flash('status', 'no');
        return redirect('/');
    }

    /**
     * @param Request $request
     * @return int
     */
    public function getGameInformation(Request $request)
    {
        $gameId = $request['game_id'];
        $game = Game::findOrFail($gameId);
        if (count($game) > 0) {
            return $game->information;
        }
        return 0;
    }

    /**
     * @param Request $request
     * @return int
     */
    public function getNews(Request $request)
    {
        $data = $request->all();
        if (isset($data['idNews'])) {
            $post = Post::find($data['idNews']);
            if (count($post) > 0) {
                return $post;
            }
        }
        return 0;
    }


    /**
     * @param Request $request
     * @return response
     */
    public function userUpdate(Request $request)
    {
        $requestData = $request->all();

        if (!empty($requestData['password'])) {
            $requestData['password'] = bcrypt($requestData['password']);
        }

        $user = Auth::user();
        $user->update($requestData);

        if ($requestData['image-data']) {
            try {
                $data = $requestData['image-data'];
                $pos = strpos($data, ';');
                $type = explode(':', substr($data, 0, $pos))[1];
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $decoded = base64_decode($data);

                $lowerCase = strtolower($type);
                $extension = 'unknown';
                if (strpos($lowerCase, "png") !== false) {
                    $extension = "png";
                } else if (strpos($lowerCase, "jpg") !== false || strpos($lowerCase, "jpeg") !== false) {
                    $extension = "jpg";
                } else if (strpos($lowerCase, "bmp") !== false) {
                    $extension = "bmp";
                } else if (strpos($lowerCase, "tiff") !== false) {
                    $extension = "tiff";
                } else if (strpos($lowerCase, "gif") !== false) {
                    $extension = "gif";
                }
                $filename = 'profile_user_' . $user->id . '.' . $extension;
                file_put_contents(public_path() . '/img/users/' . $filename, $decoded);
                $user->avatar = $filename;
                $user->save();

            } catch (Exception $exception) {
                dd($exception->getMessage());
            }
        }
        return redirect('/');
    }
}

//php artisan crud:generate gateway_transactions_logs --fields="port#string;price#decimal;ref_id#string;time_reserved#string;activate#boolean;canceled#boolean;description#text;" --view-path=admin --controller-namespace=Admin --route-group=admin