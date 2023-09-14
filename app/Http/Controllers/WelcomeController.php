<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Event, Ticket, Transaction};

class WelcomeController extends Controller
{
    public function index(){
        $data = Event::where('date', '>=', now())->orderByDesc('date')->get();
        $allEvent = Event::all();
        $categories = $allEvent->pluck('category')->unique();
        $transactions = Transaction::all();
        
        return $this->_view('welcome', [
            'title' => "@TTEND",
            'data' => $data,
            'allEvent' => $allEvent,
            'categories' => $categories,
            'transactions' => $transactions
        ]);
    }

    public function event(Request $req){
        $event = Event::find($req->id);
        $tickets = Ticket::where('event_id', $req->id)->get();
        $free = $tickets->count() ? false : true;

        $data = Event::where('date', '>=', now())->where('id', '!=', $req->id)->orderByDesc('date')->get();
        $allEvent = Event::where('id', '!=', $req->id)->get();
        $categories = $allEvent->pluck('category')->unique();

        return $this->_view('event-details', [
            'title' => $event->name,
            'event' => $event,
            'tickets' => $tickets,
            'free' => $free,
            'data' => $data,
            'allEvent' => $allEvent,
            'categories' => $categories
        ]);
    }

    public function verify($crypt){
        $id = base64_decode($crypt);
        $transaction = Transaction::find($id);
        $event = Ticket::find($transaction->ticket_id)->event;

        return $this->_view('verify', [
            'title' => "@TTEND | Verification",
            'transaction' => $transaction,
            'event' => $event
        ]);
    }

    private function _view($view, $data = array()){
        return view($view, $data);
    }
}
