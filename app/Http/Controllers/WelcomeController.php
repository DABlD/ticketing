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
        
        return $this->_view('index', [
            'title' => "@TTEND",
            'data' => $data,
            'allEvent' => $allEvent,
            'categories' => $categories
        ]);
    }

    private function _view($view, $data = array()){
        return view("welcome", $data);
    }
}
