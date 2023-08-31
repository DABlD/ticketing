<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Event, Log};
use DB;
use Auth;

use Image;

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
        $data->category = $req->category;
        $data->start_time = $req->start_time;
        $data->end_time = $req->end_time;
        $data->venue = $req->venue;
        $data->venue_address = $req->venue_address;

        echo $data->save();

        $this->log("Created Event ID: " . $data->id);
    }

    public function update(Request $req){
        $req->request->add(['updated_at' => now()]);

        echo DB::table($this->table)->where('id', $req->id)->update($req->except(['id', '_token']));
        $this->log("Updated Data for Event ID: " . $req->id);
    }

    public function uploadImages(Request $req){
        $files = $req->file();
        $filenames = [];

        foreach($files as $file){
            $name = $file->getClientOriginalName();

            $type = strtoupper($file->getClientOriginalExtension());

            $img = Image::make($file);
            $img->orientate();

            $save_path = public_path().'/uploads/' . $req->id;

            if (!file_exists($save_path)) {
                mkdir($save_path, 666, true);
            }

            $img->save($save_path . '/' . $name);

            array_push($filenames, $name);
        }

        $event = Event::find($req->id);
        $event->images = json_encode($filenames);

        echo $event->save();

        $this->log("Uploaded Images for Event ID: " . $event->id);
    }

    public function uploadTicketImage(Request $req){
        $file = $req->file('image');


        $type = strtoupper($file->getClientOriginalExtension());
        $name = "TicketImage$req->id.jpg";

        $img = Image::make($file)->encode('jpg');
        $img->orientate();

        $save_path = public_path().'/uploads/' . $req->id;

        if (!file_exists($save_path)) {
            mkdir($save_path, 666, true);
        }

        $img->save($save_path . '/' . $name);

        $event = Event::find($req->id);
        $event->ticket = $name;

        echo $event->save();

        $this->log("Uploaded Images for Event ID: " . $event->id);
    }

    public function delete(Request $req){
        Event::find($req->id)->delete();
        $this->log("Deleted Event ID: " . $req->id);
    }

    public function index(){
        return $this->_view('index', [
            'title' => ucfirst($this->table)
        ]);
    }

    public function log($action = ""){
        Log::create([
            'user_id' => auth()->user()->id,
            'action' => $action
        ]);
    }

    private function _view($view, $data = array()){
        return view("$this->table.$view", $data);
    }
}
