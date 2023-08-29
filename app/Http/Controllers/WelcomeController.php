<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Event};

class WelcomeController extends Controller
{
    public function index(){
        $data = Event::where('date', '>=', now())->orderByDesc('date')->get();
        $allEvent = Event::all();
        $categories = $allEvent->pluck('category')->unique();
        
        return $this->_view('welcome', [
            'title' => "@TTEND",
            'data' => $data,
            'allEvent' => $allEvent,
            'categories' => $categories
        ]);
    }

    public function event(Request $req){
        $event = Event::find($req->id);

        return $this->_view('event-details', [
            'title' => $event->name,
            'event' => $event
        ]);
    }

    private function _view($view, $data = array()){
        return view($view, $data);
    }
}
