<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Transaction};
use DB;
use Auth;

class TransactionController extends Controller
{
    public function __construct(){
        $this->table = "transaction";
    }

    public function get(Request $req){
        $array = DB::table($this->table)->select($req->select ?? "*");

        // IF HAS SORT PARAMETER $ORDER
        if($req->order){
            $array = $array->orderBy($req->order[0], $req->order[1]);
        }

        // IF HAS WHERE
        if($req->where){
            $array = $array->where($req->where[0], isset($req->where[2]) ? $req->where[1] : "=", $req->where[2] ?? $req->where[1]);
        }

        // IF HAS WHERE2
        if($req->where2){
            $array = $array->where($req->where2[0], isset($req->where2[2]) ? $req->where2[1] : "=", $req->where2[2] ?? $req->where2[1]);
        }

        // IF HAS JOIN
        if($req->join){
            $alias = substr($req->join, 1);
            $array = $array->join("$req->join as $alias", "$alias.fid", '=', "$this->table.id");
        }

        $array = $array->get();

        // IF HAS LOAD
        if($array->count() && $req->load){
            foreach($req->load as $table){
                $array->load($table);
            }
        }

        // IF HAS GROUP
        if($req->group){
            $array = $array->groupBy($req->group);
        }

        echo json_encode($array);
    }

    public function store(Request $req){
        $data = new Transaction();
        $data->ticket_id = $req->ticket_id;
        $data->fname = $req->fname;
        $data->mname = $req->mname;
        $data->lname = $req->lname;
        $data->gender = $req->gender;
        $data->birthday = $req->birthday;
        $data->contact = $req->contact;
        $data->email = $req->email;
        $data->address = $req->address;

        echo $data->save();

        $this->log("Created Transaction ID: " . $data->id);
    }

    public function update(Request $req){
        $req->request->add(['updated_at' => now()]);
        echo DB::table($this->table)->where('id', $req->id)->update($req->except(['id', '_token']));
        $this->log("Updated Data for Ticket ID: " . $req->id);
    }

    public function delete(Request $req){
        Ticket::find($req->id)->delete();
        $this->log("Deleted Ticket ID: " . $req->id);
    }

    public function index(){
        return $this->_view('index', [
            'title' => ucfirst($this->table)
        ]);
    }

    public function log($action = ""){
        Log::create([
            'user_id' => auth()->user()->id ?? 0,
            'action' => $action
        ]);
    }

    private function _view($view, $data = array()){
        return view("$this->table.$view", $data);
    }
}
