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
                            Logs
                        </h3>

                        @include('events.includes.toolbar')
                    </div>

                    <div class="card-body table-responsive">
                    	<table id="table" class="table table-hover" style="width: 100%;">
                    		<thead>
                    			<tr>
                    				<th>ID</th>
                    				<th>Name</th>
                    				<th>Action</th>
                    				<th>Timestamp</th>
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
	<link rel="stylesheet" href="{{ asset('css/splide.min.css') }}">
	{{-- <link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}"> --}}

	{{-- <link rel="stylesheet" href="{{ asset('css/datatables.bootstrap4.min.css') }}"> --}}
	{{-- <link rel="stylesheet" href="{{ asset('css/datatables-jquery.min.css') }}"> --}}

	<style>
		.splide__slide img {
		  width: 100%;
		  height: 100%;
		  object-fit: cover;
		}

		.splide__list{
			display : flex;
			align-items : center;
		}
	</style>
@endpush

@push('scripts')
	<script src="{{ asset('js/datatables.min.js') }}"></script>
	<script src="{{ asset('js/datatables.bundle.min.js') }}"></script>
	<script src="{{ asset('js/splide.min.js') }}"></script>
	{{-- <script src="{{ asset('js/swiper.min.js') }}"></script> --}}
    <script src="https://cdn.tiny.cloud/1/j6hjljyetenwq6iddgak38qqskvfp3f0c9mgqc68lj0rgzab/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

	{{-- <script src="{{ asset('js/datatables.bootstrap4.min.js') }}"></script> --}}
	{{-- <script src="{{ asset('js/datatables-jquery.min.js') }}"></script> --}}

	<script>
		$(document).ready(()=> {
			var table = $('#table').DataTable({
				ajax: {
					url: "{{ route('datatable.log') }}",
                	dataType: "json",
                	dataSrc: "",
					data: {
						select: "*",
						load: ['user']
					}
				},
				columns: [
					{data: 'id'},
					{data: 'user'},
					{data: 'action'},
					{data: 'created_at'}
				],
        		pageLength: 25,
				columnDefs: [
					{
						targets: [1],
						render: user => {
							return user.fname + " " + user.lname;
						}
					},
					{
						targets: [3],
						render: date => {
							return moment(date).format("MMM DD, YYYY");
						}
					}
				],
				ordering: false
				// drawCallback: function(){
				// 	init();
				// }
			});
		});
	</script>
@endpush