<?php

namespace App\Traits;

trait EventAttribute{
	public function getActionsAttribute(){
		$id = $this->id;
		$ticket = "$this->ticket";
		$status = "$this->status";

		$action = "";

		$action .= 	"<a class='btn btn-success' data-toggle='tooltip' title='View' onClick='view($id)'>" .
				        "<i class='fas fa-pencil'></i>" .
				    "</a>&nbsp;";
		$action .= 	"<a class='btn btn-info' data-toggle='tooltip' title='Images' onClick='viewImages($id)'>" .
				        "<i class='fas fa-images'></i>" .
				    "</a>&nbsp;";
		$action .= 	"<a class='btn btn-warning' data-toggle='tooltip' title='Tickets' onClick='viewTickets($id, &#39;$ticket&#39;)'>" .
				        "<i class='fas fa-ticket'></i>" .
				    "</a>&nbsp;";

		$route = route('transaction.transaction', ["id" => $id]);

		$action .= 	"<a class='btn btn-dark' data-toggle='tooltip' title='Transactions' href='$route' target='_blank'>" .
				        "<i class='fas fa-money-bills'></i>" .
				    "</a>&nbsp;";
		$action .= 	"<a class='btn btn-primary' data-toggle='tooltip' title='Status' onClick='updateStatus($id, &#39;$status&#39;)'>" .
				        "<i class='fas fa-list-check'></i>" .
				    "</a>&nbsp;";
		$action .= 	"<a class='btn btn-danger' data-toggle='tooltip' title='Delete' onClick='del($id)'>" .
				        "<i class='fas fa-trash'></i>" .
					    "</a>&nbsp;";

		return $action;
	}
}