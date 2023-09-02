<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Models\{Transaction, Ticket};

class ApiController extends Controller
{
    public function get(Request $req){
        $array = DB::table($req->table)->select($req->select ?? "*");

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
        $temp = Ticket::find($req->ticket_id);

        if($temp->stock <= 0){
            echo "oos";
        }
        else{
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

            $data->load('ticket.event');
            $data->save();
            $data->crypt = base64_encode($data->id) . '-' . bin2hex($data->id);

            $temp->decrement('stock');
            echo json_encode($data);
        }
    }

    public function verify(Request $req){
        $id = base64_decode(explode('-', $req->crypt)[0]);
    }
}
