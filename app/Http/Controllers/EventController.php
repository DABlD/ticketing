<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use DB;
use Auth;

class EventController extends Controller
{
    public function __construct(){
        $this->table = "events";
    }

    public function get(Request $req){
        $array = DB::table($this->table)->select($req->select);

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
        $data = new Event();
        $data->name = $req->name;
        $data->description = $req->description;
        $data->date = $req->date;
        $data->start_time = $req->start_time;
        $data->end_time = $req->end_time;
        $data->venue = $req->venue;
        $data->venue_address = $req->venue_address;

        echo $data->save();
    }

    public function update(Request $req){
        echo DB::table($this->table)->where('id', $req->id)->update($req->except(['id', '_token']));
    }

    public function delete(Request $req){
        Event::find($req->id)->delete();
    }

    public function index(){
        return $this->_view('index', [
            'title' => ucfirst($this->table)
        ]);
    }

    private function _view($view, $data = array()){
        return view("$this->table.$view", $data);
    }
}
