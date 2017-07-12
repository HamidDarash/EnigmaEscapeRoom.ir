<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Reservation;
use DB;

class AppServiceProvider extends ServiceProvider
{

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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('unread', $this->getUnreadedReservations());
        view()->share('reserved', $this->getReservedReservations());
        view()->share('reservecancel', $this->getCanceledReservations());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Appzcoder\CrudGenerator\CrudGeneratorServiceProvider');
        }
    }
}
