<html>
	<head>
		<title>@TTEND RESERVATION CONFIRMATION</title>
	</head>
	<body>
		{{-- <img src="data:image/png;base64, {{ base64_encode(QrCode::size(300)->format('png')->generate(route("api.verify") . '?crypt=' . $data->crypt)) }} "> --}}
		
		Click <a href="{{ route("api.verify") . '?crypt=' . $data->crypt }}">here</a> to verify.
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