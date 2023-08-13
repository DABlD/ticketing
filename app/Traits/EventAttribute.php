<?php

namespace App\Traits;

trait EventAttribute{
	public function getActionsAttribute(){
		$id = $this->id;
		$action = "";

		$action = 	"<a class='btn btn-success' data-toggle='tooltip' title='View' onClick='view($id)'>" .
				        "<i class='fas fa-search'></i>" .
				    "</a>&nbsp;";
		$action .= 	"<a class='btn btn-danger' data-toggle='tooltip' title='Delete' onClick='del($id)'>" .
				        "<i class='fas fa-trash'></i>" .
					    "</a>&nbsp;";

		return $action;
	}
}