@extends('layouts.app')
@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <section class="col-lg-12 connectedSortable">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-table mr-1"></i>
                            List
                        </h3>

                        @include('events.includes.toolbar')
                    </div>

                    <div class="card-body table-responsive">
                    	<table id="table" class="table table-hover" style="width: 100%;">
                    		<thead>
                    			<tr>
                    				<th>ID</th>
                    				<th>Name</th>
                    				<th>Venue</th>
                    				<th>Date</th>
                    				<th>Time</th>
                    				<th>Ticket</th>
                    				<th>Status</th>
                    				<th>Actions</th>
                    			</tr>
                    		</thead>

                    		<tbody>
                    		</tbody>
                    	</table>
                    </div>
                </div>
            </section>
        </div>
    </div>

</section>

@endsection

@push('styles')
	<link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/datatables.bundle.min.css') }}">
	{{-- <link rel="stylesheet" href="{{ asset('css/datatables.bootstrap4.min.css') }}"> --}}
	{{-- <link rel="stylesheet" href="{{ asset('css/datatables-jquery.min.css') }}"> --}}
@endpush

@push('scripts')
	<script src="{{ asset('js/datatables.min.js') }}"></script>
	<script src="{{ asset('js/datatables.bundle.min.js') }}"></script>
	{{-- <script src="{{ asset('js/datatables.bootstrap4.min.js') }}"></script> --}}
	{{-- <script src="{{ asset('js/datatables-jquery.min.js') }}"></script> --}}

	<script>
		$(document).ready(()=> {
			var table = $('#table').DataTable({
				ajax: {
					url: "{{ route('datatable.event') }}",
                	dataType: "json",
                	dataSrc: "",
					data: {
						select: "*",
					}
				},
				columns: [
					{data: 'id'},
					{data: 'name'},
					{data: 'venue'},
					{data: 'date'},
					{data: 'start_time'},
					{data: 'ticket'},
					{data: 'status'},
					{data: 'actions'},
				],
        		pageLength: 25,
				columnDefs: [
					{
						targets: [3],
						render: date => {
							return moment(date).format("MMM DD, YYYY");
						}
					},
					{
						targets: [4],
						render: (start,a,row) => {
							return `${moment(start, 'H:m').format("hh:mm A")} - ${moment(row.end_time, "H:m").format("hh:mm A")}`;
						}
					},
					{
						targets: [5],
						render: ticket => {
							let string = "";
							if(ticket){
								string = `
									BTN
								`;
							}
							else{
								string = "FREE";
							}

							return string;
						}
					},
				],
				// drawCallback: function(){
				// 	init();
				// }
			});
		});

		function view(id){
			$.ajax({
				url: "{{ route('event.get') }}",
				data: {
					select: '*',
					where: ['id', id],
				},
				success: event => {
					event = JSON.parse(event)[0];
					showDetails(event);
				}
			})
		}

		function create(){
			Swal.fire({
				title: "Enter Event Details",
				html: `
	                ${input("name", "Name", null, 3, 9)}
					${input("description", "Description", null, 3, 9)}
					${input("date", "Date", null, 3, 9)}
					<div class="row iRow">
			            <div class="col-md-3 iLabel">
			                Start
			            </div>
			            <div class="col-md-3 iInput">
			                <input type="text" name="start_time" placeholder="Enter Start" class="form-control">
			            </div>
			            <div class="col-md-3 iInput">
			                <input type="text" name="end_time" placeholder="Enter End" class="form-control">
			            </div>
			            <div class="col-md-3 iInput"></div>
			        </div>
					${input("venue", "Venue", null, 3, 9)}
					${input("venue_address", "Address", null, 3, 9)}
				`,
				didOpen: () => {
					$("[name='date']").flatpickr({
						altInput: true,
						altFormat: "F j, Y",
						dateFormat: "Y-m-d",
					});

					$("[name='start_time'], [name='end_time']").flatpickr({
					    enableTime: true,
					    noCalendar: true,
					    dateFormat: "H:i",
					    altFormat: "h:i K",
					    altInput: true
					});
				},
				width: '800px',
				confirmButtonText: 'Create',
				showCancelButton: true,
				cancelButtonColor: errorColor,
				cancelButtonText: 'Cancel',
				preConfirm: () => {
				    swal.showLoading();
				    return new Promise(resolve => {
				    	let bool = true;

			            if($('.swal2-container input:placeholder-shown').length){
			                Swal.showValidationMessage('Fill all fields');
			            }
			            else{
			            	let bool = false;
			            }

			            bool ? setTimeout(() => {resolve()}, 500) : "";
				    });
				},
			}).then(result => {
				if(result.value){
					swal.showLoading();
					$.ajax({
						url: "{{ route('event.store') }}",
						type: "POST",
						data: {
							name: $("[name='name']").val(),
							description: $("[name='description']").val(),
							date: $("[name='date']").val(),
							start_time: $("[name='start_time']").val(),
							end_time: $("[name='end_time']").val(),
							venue: $("[name='venue']").val(),
							venue_address: $("[name='venue_address']").val(),

							_token: $('meta[name="csrf-token"]').attr('content')
						},
						success: () => {
							ss("Success");
							reload();
						}
					})
				}
			});
		}

		function showDetails(event){
			Swal.fire({
				title: 'Event Details',
				html: `
	                ${input("id", "", event.id, 3, 9, 'hidden')}
	                ${input("name", "Name", event.name, 3, 9)}
					${input("description", "Description", event.description, 3, 9)}
					${input("date", "Description", event.date, 3, 9)}
					${input("start_time", "Start", event.start_time, 3, 9)}
					${input("end_time", "End", event.end_time, 3, 9)}
					${input("venue", "Venue", event.venue, 3, 9)}
					${input("venue_address", "Address", event.venue_address, 3, 9)}
				`,
				width: '800px',
				confirmButtonText: 'Update',
				showCancelButton: true,
				cancelButtonColor: errorColor,
				cancelButtonText: 'Cancel',
				didOpen: () => {
					$("[name='date']").flatpickr({
						altInput: true,
						altFormat: "F j, Y",
						dateFormat: "Y-m-d",
					});

					$("[name='start_time'], [name='end_time']").flatpickr({
					    enableTime: true,
					    noCalendar: true,
					    dateFormat: "H:i",
					    altFormat: "h:i K",
					    altInput: true
					});
				},
				preConfirm: () => {
				    swal.showLoading();
				    return new Promise(resolve => {
				    	let bool = true;

			            if($('.swal2-container input:placeholder-shown').length){
			                Swal.showValidationMessage('Fill all fields');
			            }
			            else{
			            	let bool = false;
			            }

			            bool ? setTimeout(() => {resolve()}, 500) : "";
				    });
				},
			}).then(result => {
				if(result.value){
					swal.showLoading();
					update({
						url: "{{ route('event.update') }}",
						data: {
							id: $("[name='id']").val(),
							name: $("[name='name']").val(),
							description: $("[name='description']").val(),
							date: $("[name='date']").val(),
							start_time: $("[name='start_time']").val(),
							end_time: $("[name='end_time']").val(),
							venue: $("[name='venue']").val(),
							venue_address: $("[name='venue_address']").val(),
						},
						message: "Success"
					},	() => {
						reload();
					});
				}
			});
		}

		function del(id){
			sc("Confirmation", "Are you sure you want to delete?", result => {
				if(result.value){
					swal.showLoading();
					update({
						url: "{{ route('event.delete') }}",
						data: {id: id},
						message: "Success"
					}, () => {
						reload();
					})
				}
			});
		}
	</script>
@endpush