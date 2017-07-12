<?php

namespace App\Http\Controllers\Admin;


use App\Game;
use App\Http\Controllers\Controller;
use App\Reservation;
use App\User;
use DateInterval;
use DateTime;
use DB;
use Illuminate\Http\Request;
use Morilog\Jalali\jDatetime;
use Session;

class ReservationsController extends Controller
{


    /**
     * @param $ordered
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderByActivate($ordered)
    {
        $perPage = 10;
        $reservations = Reservation::orderBy('activate', $ordered)->paginate($perPage);
        return view('admin.reservations.index', ['reservations' => $reservations]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        session(['current_menu_select' => 'reservations']);
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $modeSearchAutomatic = 'other';

            if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $keyword)) {
                $date_miladi = jDatetime::createDatetimeFromFormat('Y-m-d', $keyword);
                $keyword = $date_miladi->format('Y-m-d');
                $modeSearchAutomatic = 'date';
            }
            $users = DB::select("select * from users where `email` like N'%$keyword%'");
            if (!empty($users) && (count($users))) {
                foreach ($users as $user) {
                    $keyword = $user->id;
                }
                $modeSearchAutomatic = 'users';
            }
            $games = DB::select("select * from games where `name` like N'%$keyword%'");
            if (!empty($games) && (count($games))) {
                foreach ($games as $game) {
                    $keyword = $game->id;
                }
                $modeSearchAutomatic = 'games';
            }

            switch ($modeSearchAutomatic) {
                case 'games': {
                    $reservations = Reservation::where('game_id', '=', $keyword)
                        ->paginate($perPage);
                }
                    break;
                case 'users': {
                    $reservations = Reservation::where('user_id', '=', $keyword)
                        ->paginate($perPage);
                }
                    break;
                case 'date': {
                    $reservations = Reservation::where('date_reserved', 'LIKE', "%$keyword%")
                        ->paginate($perPage);
                }
                    break;
                case 'other': {
                    $reservations = Reservation::where('time_reserved', 'like', "%$keyword%")
                        ->orWhere('activate', 'LIKE', "%$keyword%")
                        ->orWhere('canceled', 'LIKE', "%$keyword%")
                        ->orWhere('description', 'LIKE', "%$keyword%")
                        ->orWhere('person_count', 'LIKE', "%$keyword%")
                        ->orWhere('sum_price', 'LIKE', "%$keyword%")
                        ->paginate($perPage);
                }
                    break;
            }
        } else {
            $reservations = Reservation::paginate($perPage);
        }


        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        session(['current_menu_select' => 'reservations']);
        $games = Game::All()->where('activate', 1);
        $users = User::All();

        $tempUsers = [];

        foreach ($users as $user) {
            if (!$user->hasRole('admin') && !$user->hasRole('super_admin')) {
                array_push($tempUsers, $user);

            }
        }

        return view('admin.reservations.create', ['gamesAll' => $games, 'usersAll' => $tempUsers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        Reservation::create($requestData);
        Session::flash('flash_message', 'بازی مورد نظر رزرو گردید');
        return redirect('admin/reservations');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->reading = 1;
        $reservation->save();
        return view('admin.reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $user = User::find($reservation->user_id);
        $game = Game::find($reservation->game_id);
        return view('admin.reservations.edit', ['reservation' => $reservation,
            'userSelect' => $user,
            'gameSelect' => $game]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $requestData = $request->all();
        $reservation = Reservation::findOrFail($id);
        $reservation->update($requestData);
        Session::flash('flash_message', 'بازی مورد نظر بروزرسانی شد');
        return redirect('admin/reservations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Reservation::destroy($id);
        Session::flash('flash_message', 'رزرو بازی مورد نظر حذف گردید');
        return redirect('admin/reservations');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function drawOptionsTimesOnDate(Request $request)
    {
        //dd($request->all());
        $select_obj = '<select class="form-control" name="time_reserved" value="">';
        $game_id = $request['game_id'];

        $game = Game::find($game_id);
        $sDate = $request['date_reserved'];
        $dateTime = new DateTime($sDate);
        $stringDate = $dateTime->format('Y-m-d');

        $game_time = intval($game->minutes);

        $game_start = new DateTime('10:00:00');
        $game_end = new DateTime('22:00:00');
        $count_clock = $game_start->diff($game_end);
        $count_games = floor(($count_clock->h * 60) / $game_time);
        for ($i = 0; $i <= $count_games; $i++) {
            $timed = $game_start->format('H:i:s');
            if ($this->findReservItem($stringDate, $timed, $game_id)) {
                $select_obj .= "<option miladi-date='null'  value='null' disabled>رزرو شده</option>";
            } else {
                $select_obj .= "<option miladi-date='$stringDate'  value='$timed'>" . $timed . "</option>";
            }
            $game_start->add(new DateInterval('PT' . $game_time . 'M'));
        }
        $select_obj .= '</select>';
        return $select_obj;
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
     * @return array
     */
    public function changeActivate(Request $request)
    {
        $reserveid = $request['reserveid'];
        $activate = $request['activate'];
        $reserveTableItem = null;
        if (isset($reserveid) && isset($activate)) {
            $reserveTableItem = Reservation::find($reserveid);

            if ($activate == "1") {
                $reserveTableItem->activate = 0;
            } else {
                $reserveTableItem->activate = 1;
            }
            $reserveTableItem->save();
        }

        return array(
            'reserveid' => $reserveid,
            'activate' => $reserveTableItem->activate
        );
    }

    /**
     * @param Request $request
     * @return array
     */
    public function changeCancel(Request $request)
    {
        $cancelReserveId = $request['cancelReserveId'];
        $canceled = $request['canceled'];
        $reserveTableItem = null;

        if (isset($cancelReserveId) && isset($canceled)) {
            $reserveTableItem = Reservation::find($cancelReserveId);
            if ($canceled == "1") {
                $reserveTableItem->canceled = 0;
            } else {
                $reserveTableItem->canceled = 1;
            }
            $reserveTableItem->save();
        }

        return array(
            'cancelreserveid' => $cancelReserveId,
            'canceled' => $reserveTableItem->canceled
        );
    }
}
