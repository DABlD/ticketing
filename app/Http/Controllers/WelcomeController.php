<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class WelcomeController extends Controller
{
    public function index(){
        $data = 
        return $this->_view('index', [
            'title' => ucfirst($this->table)
        ]);
    }

    private function _view($view, $data = array()){
        return view("$this->table.$view", $data);
    }
}
