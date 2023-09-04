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

        $days = 15;

        // LABELS
        $labels = [];

        $start = now()->subDays($days);
        while($start->toDateString() != now()->addDay()->toDateString()){
            array_push($labels, $start->format('F j, Y'));
            $start->addDay();
        }
        // END LABELS

        //DATA
        $transactions = Transaction::where('created_at', '>=', now()->subDays($days)->toDateString())->get();
        $dataset1 = [];
        $dataset2 = [];
        $dataset3 = [];
        $dataset4 = [];

        $start = now()->subDays($days);
        while($start->toDateString() != now()->addDay()->toDateString()){
            $temp = $transactions->filter(function($value, $key) use($start){
                return str_starts_with($value->created_at, $start->toDateString());
            });
            array_push($dataset1, $temp->count());

            $temp2 = $transactions->filter(function($value, $key) use($start){
                return str_starts_with($value->created_at, $start->toDateString()) && in_array($value->status, ["Paid", "Used"]);
            });
            array_push($dataset2, $temp->count());

            $temp3 = $transactions->filter(function($value, $key) use($start){
                return str_starts_with($value->created_at, $start->toDateString()) && in_array($value->status, ["Unpaid"]);
            });
            array_push($dataset3, $temp->count());

            $temp4 = $transactions->filter(function($value, $key) use($start){
                return str_starts_with($value->created_at, $start->toDateString()) && in_array($value->status, ["Forfeited"]);
            });
            array_push($dataset4, $temp->count());

            $start->addDay();
        }
        // END DATA

        $dataset1 = []; //ALL
        $dataset2 = []; // PAID/USED
        $dataset3 = []; // UNPAID
        $dataset4 = []; // FORFEITED

        for($i = 0; $i <= 15; $i++){
            $num1 = rand(300,500);
            $num2 = rand(50,95);
            $num3 = rand(1,5);

            array_push($dataset1, $num1);
            array_push($dataset2, round(($num1 / 100) * $num2));
            array_push($dataset3, $num1 - $dataset2[$i] - $num3);
            array_push($dataset4, $num3);
        }

        return $this->_view('dashboard', [
            'title'         => 'Dashboard',
            'te'            => $te,
            'tc'            => $tc,
            'tu'            => $tu,
            'ttp'           => $ttp,
            'ttu'           => $ttu,
            'labels'        => json_encode($labels),
            'dataset1'       => json_encode($dataset1),
            'dataset2'       => json_encode($dataset2),
            'dataset3'       => json_encode($dataset3),
            'dataset4'       => json_encode($dataset4)
        ]);
    }

    private function _view($view, $data = array()){
        return view($view, $data);
    }
}
