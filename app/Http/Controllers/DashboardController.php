<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Event, Ticket, Transaction};

class DashboardController extends Controller
{
    function index(){
        $te = Event::all();
        $tc = Event::where('status', 'Finished')->get();
        $tu = Event::where('status', 'Upcoming')->geT();
        $ttp = Transaction::whereIn('status', ["Paid", "Used"])->get();
        $ttu = Transaction::where('status', 'Unpaid')->get();

        return $this->_view('dashboard', [
            'title'         => 'Dashboard',
            'te'            => $te,
            'tc'            => $tc,
            'tu'            => $tu,
            'ttp'           => $ttp,
            'ttu'           => $ttu
        ]);
    }

    private function _view($view, $data = array()){
        return view($view, $data);
    }
}
