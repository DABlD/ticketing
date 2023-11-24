<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Event, Ticket, Transaction};
use Barryvdh\DomPDF\Facade\Pdf;

use Mail;
use App\Mail\TestMail;

class WelcomeController extends Controller
{
    public function test(){
        $data = [
            'title' => 'this is a test email',
            'body' => 'yes'
        ];

        echo Mail::to('darm.111220@gmail.com')->send(new TestMail($data));
    }

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

    public function showID(Request $req){
        $transaction = Transaction::find($req->id);
        $event = Ticket::find($transaction->ticket_id)->event;

        $data = [];
        $data['transaction'] = $transaction;
        $data['event'] = $event;

        $pdf = Pdf::loadView('pdf.id', $data);
        return $pdf->download("Event#$event->id" . "-$transaction->lname" . "_$transaction->fname.pdf");
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
