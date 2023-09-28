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

                        @include('transactions.includes.toolbar')
                    </div>

                    <div class="card-body table-responsive">
                    	<table id="table" class="table table-hover" style="width: 100%;">
                    		<thead>
                    			<tr>
                    				<th>ID</th>
                    				<th>Name</th>
                    				<th>Sex</th>
                    				<th>DOB</th>
                    				<th>Contact</th>
                    				<th>Company</th>
                    				<th>Position</th>
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
	{{-- <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}"> --}}
	<link rel="stylesheet" href="{{ asset('css/datatables.bundle.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
	{{-- <link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}"> --}}

	{{-- <link rel="stylesheet" href="{{ asset('css/datatables.bootstrap4.min.css') }}"> --}}
	{{-- <link rel="stylesheet" href="{{ asset('css/datatables-jquery.min.css') }}"> --}}

	<style>
		.bb{
			border-bottom: 1px solid rgb(128, 128, 128, 0.5);
		}
	</style>
@endpush

@push('scripts')
	<script src="{{ asset('js/datatables.min.js') }}"></script>
	<script src="{{ asset('js/datatables.bundle.min.js') }}"></script>
	<script src="{{ asset('js/select2.min.js') }}"></script>
	{{-- <script src="{{ asset('js/swiper.min.js') }}"></script> --}}

	{{-- <script src="{{ asset('js/datatables.bootstrap4.min.js') }}"></script> --}}
	{{-- <script src="{{ asset('js/datatables-jquery.min.js') }}"></script> --}}

	<script>
		$(document).ready(()=> {
			var table = $('#table').DataTable({
				ajax: {
					url: "{{ route('datatable.transaction') }}",
                	dataType: "json",
                	dataSrc: "",
					data: {
						select: "*",
						whereIn: ['ticket_id', {{ $event->tickets->pluck('id') }}]
					}
				},
				columns: [
					{data: 'id'},
					{data: 'fname'},
					{data: 'gender'},
					{data: 'birthday'},
					{data: 'contact'},
					{data: 'company'},
					{data: 'position'},
					{data: 'status'},
					{data: 'actions'},
				],
        		pageLength: 25,
				columnDefs: [
					{
						targets: [3],
						render: date => {
							return moment(date).format("MMM DD, YYYY") + ` (${moment().diff(date, 'years')}yo)`;
						}
					},
				],
				ordering: false
			});
		});

		function view(id){
			$.ajax({
				url: "{{ route('transaction.get') }}",
				data: {
					select: '*',
					where: ['id', id],
				},
				success: transaction => {
					transaction = JSON.parse(transaction)[0];

					Swal.fire({
						title: "Customer Details",
						html: `
							<div class="row iRow">
					            <div class="col-md-3 bb">
					                Name
					            </div>
					            <div class="col-md-9 bb">
					                ${transaction.fname} ${transaction.mname} ${transaction.lname}
					            </div>
					        </div>

							<div class="row iRow">
					            <div class="col-md-3 bb">
					                Gender
					            </div>
					            <div class="col-md-9 bb">
					                ${transaction.gender}
					            </div>
					        </div>

							<div class="row iRow">
					            <div class="col-md-3 bb">
					                Birthday
					            </div>
					            <div class="col-md-9 bb">
					                ${moment(transaction.birthday).format("MMM DD, YYYY")}
					            </div>
					        </div>

							<div class="row iRow">
					            <div class="col-md-3 bb">
					                Contact
					            </div>
					            <div class="col-md-9 bb">
					                ${transaction.contact}
					            </div>
					        </div>

							<div class="row iRow">
					            <div class="col-md-3 bb">
					                Email
					            </div>
					            <div class="col-md-9 bb">
					                ${transaction.email}
					            </div>
					        </div>

							<div class="row iRow">
					            <div class="col-md-3 bb">
					                Address
					            </div>
					            <div class="col-md-9 bb">
					                ${transaction.address}
					            </div>
					        </div>

							<div class="row iRow">
					            <div class="col-md-3 bb">
					                Company
					            </div>
					            <div class="col-md-9 bb">
					                ${transaction.company}
					            </div>
					        </div>

							<div class="row iRow">
					            <div class="col-md-3 bb">
					                Position
					            </div>
					            <div class="col-md-9 bb">
					                ${transaction.position}
					            </div>
					        </div>
						`
					})
				}
			})
		}

		function payment(id){
			$.ajax({
				url: "{{ route('transaction.get') }}",
				data: {
					select: '*',
					where: ['id', id],
				},
				success: transaction => {
					transaction = JSON.parse(transaction)[0];

					Swal.fire({
						title: "Payment Details",
						showCancelButton: true,
						cancelButtonColor: errorColor,
						confirmButtonColor: successColor,
						confirmButtonText: "Save",
						html: `
			                ${input("mop", "MOP", transaction.mop, 3, 9)}
							${input("ref", "Ref #", transaction.ref, 3, 9)}
						`
					}).then(result => {
						if(result.value){
							swal.showLoading();

							let data = {
								id: id,
								mop: $('[name="mop"]').val(),
								ref: $('[name="ref"]').val()
							};

							if(data.mop != "" && data.ref != "" && transaction.status != "Used"){
								data = {
									...data,
									status: "Paid"
								}
							}

							update({
								url: "{{ route('transaction.update') }}",
								data: data,
								message: "Successfully Updated Payment Details"
							},	() => {
								reload();
							});
						}
					})
				}
			})
		}

		function updateStatus(id, status){
			let statuses = {
				"Paid": "Paid", 
				"Unpaid": "Unpaid",
				"Used": "Used",
				"Forfeited": "Forfeited"
			};

			Swal.fire({
				html: "Update Status",
				input: "select",
				inputOptions: statuses,
				didOpen: () => {
					$('.swal2-select').val(status).trigger('change');
				}
			}).then(result => {
				if(result.value && $('.swal2-select').val() != status){
					swal.showLoading();
					update({
						url: "{{ route('transaction.update') }}",
						data: {
							id: id,
							status: $('.swal2-select').val()
						},
						message: "Successfully Updated"
					},	() => {
						reload();
					});
				}
			});
		}
	</script>
@endpush