<html>
	<head>
		<title>@TTEND RESERVATION CONFIRMATION</title>
	</head>
	<body>
		{!! QrCode::size(300)->format('png')->generate(route("api.verify") . '?crypt=' . $data->crypt) !!}

		<br>
        Event: {{ $data->ticket->event->name }}
        <br>
        Ticket Type: {{ $data->ticket->type }}
        <br>
        Name: {{ $data->fname }} {{ $data->mname }} {{ $data->lname }}
        <br>
        Contact: {{ $data->contact }}
        <br>
        Email: {{ $data->email }}
        <br>
        Company: {{ $data->company }}
        <br>
        Position: {{ $data->position }}
        <br>
        Status: Unpaid
	</body>
</html>