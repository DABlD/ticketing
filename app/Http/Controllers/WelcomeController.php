<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class WelcomeController extends Controller
{
    public function index(){
        $data = Event::where('date', '>=', now())->orderByDesc('date')->get();
        
        return $this->_view('index', [
            'title' => "@TTEND",
            'data' => $data
        ]);
    }

    private function _view($view, $data = array()){
        return view("welcome", $data);
    }
}
