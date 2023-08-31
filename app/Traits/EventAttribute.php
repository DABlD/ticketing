<?php

namespace App\Traits;

trait EventAttribute{
	public function getActionsAttribute(){
		$id = $this->id;
		$ticket = "$this->ticket";

		$action = "";

		$action .= 	"<a class='btn btn-success' data-toggle='tooltip' title='View' onClick='view($id)'>" .
				        "<i class='fas fa-search'></i>" .
				    "</a>&nbsp;";
		$action .= 	"<a class='btn btn-info' data-toggle='tooltip' title='Images' onClick='viewImages($id)'>" .
				        "<i class='fas fa-images'></i>" .
				    "</a>&nbsp;";
		$action .= 	"<a class='btn btn-warning' data-toggle='tooltip' title='Tickets' onClick='viewTickets($id, &#39;$ticket&#39;)'>" .
				        "<i class='fas fa-ticket'></i>" .
				    "</a>&nbsp;";
		$action .= 	"<a class='btn btn-danger' data-toggle='tooltip' title='Delete' onClick='del($id)'>" .
				        "<i class='fas fa-trash'></i>" .
					    "</a>&nbsp;";

		return $action;
	}
}