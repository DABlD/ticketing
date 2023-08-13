<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Event, Ticket};
use DB;

class DatatableController extends Controller
{
    public function user(Request $req){
        $array = User::select($req->select ?? "*");

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
        // if($req->join){
        //     $alias = substr($req->join, 1);
        //     $array = $array->join("$req->join as $alias", "$alias.fid", '=', 'users.id');
        // }

        $array = $array->get();

        // FOR ACTIONS
        foreach($array as $item){
            $item->actions = $item->actions;
        }

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

    public function event(Request $req){
        $array = Event::select($req->select ?? "*");

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
        // if($req->join){
        //     $alias = substr($req->join, 1);
        //     $array = $array->join("$req->join as $alias", "$alias.fid", '=', 'users.id');
        // }

        $array = $array->get();

        // FOR ACTIONS
        foreach($array as $item){
            $item->actions = $item->actions;
        }

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
}