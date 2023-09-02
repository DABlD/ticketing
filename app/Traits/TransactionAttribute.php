<?php

namespace App\Traits;

trait TransactionAttribute{
	public function getActionsAttribute(){
		$id = $this->id;
		$status = "$this->status";

		$action = "";

		$action .= 	"<a class='btn btn-success' data-toggle='tooltip' title='View' onClick='view($id)'>" .
				        "<i class='fas fa-search'></i>" .
				    "</a>&nbsp;";
		$action .= 	"<a class='btn btn-primary' data-toggle='tooltip' title='Update Status' onClick='updateStatus($id, &#39;$status&#39;)'>" .
				        "<i class='fas fa-list-check'></i>" .
				    "</a>&nbsp;";
		$action .= 	"<a class='btn btn-dark' data-toggle='tooltip' title='Payment Details' onClick='payment($id)'>" .
				        "<i class='fas fa-money-bills'></i>" .
				    "</a>&nbsp;";

		return $action;
	}
}