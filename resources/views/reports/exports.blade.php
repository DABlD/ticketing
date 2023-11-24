@php
	$b = "font-weight: bold;";
	$c = "text-align: center;";
	$bc = "$b $c";
@endphp

<table>
	<tr>
		<td style="{{ $bc }}">Name</td>
		<td style="{{ $bc }}">Gender</td>
		<td style="{{ $bc }}">Age</td>
		<td style="{{ $bc }}">Contact</td>
		<td style="{{ $bc }}">Email</td>
		<td style="{{ $bc }}">Address</td>
		<td style="{{ $bc }}">Status</td>
		<td style="{{ $bc }}">Mode of Payment</td>
		<td style="{{ $bc }}">Reference</td>
		<td style="{{ $bc }}">Company</td>
		<td style="{{ $bc }}">Position</td>
		<td style="{{ $bc }}">Date Reserved</td>
	</tr>
	@foreach($data as $t)
		<tr>
			<td>{{ $t->fname }} {{ $t->lname }}</td>
			<td style="{{ $c }}">{{ $t->gender }}</td>
			<td style="{{ $c }}">{{ $t->birthday->age }} </td>
			<td style="{{ $c }}">{{ $t->contact }}</td>
			<td style="{{ $c }}">{{ $t->email }}</td>
			<td style="{{ $c }}">{{ $t->address }}</td>
			<td style="{{ $c }}">{{ $t->status }}</td>
			<td style="{{ $c }}">{{ $t->mop }}</td>
			<td style="{{ $c }}">{{ $t->ref }}</td>
			<td style="{{ $c }}">{{ $t->company }}</td>
			<td style="{{ $c }}">{{ $t->position }}</td>
			<td style="{{ $c }}">{{ $t->created_at->toFormattedDateString() }}</td>
		</tr>
	@endforeach
</table>