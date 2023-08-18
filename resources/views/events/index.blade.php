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
                    				<th>Tickets</th>
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

							if(ticket == null){
								string = "NOT SET"
							}
							else if(ticket){
								string = `
									BTN
								`;
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
					<div class="row iRow">
			            <div class="col-md-3 iLabel">
			                Description
			            </div>
			            <div class="col-md-9 iInput">
			                <textarea name="description" id="description" placeholder="Enter Description" class="form-control">
			                </textarea>
			            </div>
			        </div>
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

					tinymce.init({
				      	selector: 'textarea',
				      	// toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons charmap',
				      	// tinycomments_mode: 'embedded',
				    });
				},
				width: '80%',
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
							date: $("[name='date']").val(),
							start_time: $("[name='start_time']").val(),
							end_time: $("[name='end_time']").val(),
							venue: $("[name='venue']").val(),
							venue_address: $("[name='venue_address']").val(),

							description: tinymce.get('description').getContent(),

							_token: $('meta[name="csrf-token"]').attr('content')
						},
						success: () => {
							ss("Success");
							reload();
						}
					})
				}

				// remove wysiwyg
				tinymce.remove();
			});
		}

		function showDetails(event){
			Swal.fire({
				title: 'Event Details',
				html: `
	                ${input("id", "", event.id, 3, 9, 'hidden')}
	                ${input("name", "Name", event.name, 3, 9)}
					${input("date", "Description", event.date, 3, 9)}
					${input("start_time", "Start", event.start_time, 3, 9)}
					${input("end_time", "End", event.end_time, 3, 9)}
					${input("venue", "Venue", event.venue, 3, 9)}
					${input("venue_address", "Address", event.venue_address, 3, 9)}
					<div class="row iRow">
			            <div class="col-md-3 iLabel">
			                Description
			            </div>
			            <div class="col-md-9 iInput">
			                <textarea name="description" id="description" placeholder="Enter Description" class="form-control">
			                </textarea>
			            </div>
			        </div>
				`,
				width: '80%',
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

					tinymce.init({
				      	selector: 'textarea',
				      	// toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | checklist numlist bullist indent outdent | emoticons charmap',
				      	// tinycomments_mode: 'embedded',
				    });

				    setTimeout(() => {
			    		tinymce.get('description').setContent(event.description);
				    }, 500);
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
							date: $("[name='date']").val(),
							start_time: $("[name='start_time']").val(),
							end_time: $("[name='end_time']").val(),
							venue: $("[name='venue']").val(),
							venue_address: $("[name='venue_address']").val(),
							description: tinymce.get('description').getContent(),
						},
						message: "Success"
					},	() => {
						reload();
					});
				}

				// remove wysiwyg
				tinymce.remove();
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

		// IMAGES
		function viewImages(id){
			$.ajax({
				url: '{{ route('event.get') }}',
				data: {
					select: "images",
					where: ['id', id]
				},
				success: result => {
					result = JSON.parse(result)[0];
					
					let imageString = ``;

					if(result && result.images){
						let images = JSON.parse(result.images);
						images.forEach(image => {
							imageString += `
								<li class="splide__slide">
									<img src="uploads/${id}/${image}" alt="Pic">
								</li>
							`;
						});
					}
					else{
						imageString = `
							<li class="splide__slide">
								No Images Uploaded
							</li>
						`;
					}

					showImages(id, imageString);
				}
			})
		}

		function showImages(id, imageString){
			Swal.fire({
				title: "View Images",
				showDenyButton: true,
				denyButtonText: 'Upload Images',
				denyButtonColor: successColor,
     			customClass: 'swal-height',
				html: `
					<div class="splide" role="group" aria-label="Splide Basic HTML Example" style="margin: auto;">
					  <div class="splide__track">
							<ul class="splide__list">
								${imageString}
							</ul>
					  </div>
					</div>
				`,
				width: "100vh",
				didOpen: () => {
					$('.swal-height').css('height', '80vh');
					new Splide( '.splide', {
  						type   : 'loop',
  						height: '100%',
  						width: '60%',
						gap: '5em'
					}).mount();
				}
			}).then(result => {
				if(result.isDenied){
					Swal.fire({
						title: "Upload Image/s",
						input: "file",
						inputAttributes: {
							'accept': 'image/*',
							'multiple': 'multiple'
						},
						showCancelButton: true,
						cancelButtonColor: errorColor,
						confirmButtonText: "Upload",
						preConfirm: () => {
						    swal.showLoading();
						    return new Promise(resolve => {
						    	let bool = true;

					            if($('.swal2-file').val().length == 0){
					                Swal.showValidationMessage('No Image Selected');
					            }
					            else{
					            	let bool = false;
					            }

					            bool ? setTimeout(() => {resolve()}, 500) : "";
						    });
						},
						didOpen: () => {
							$('.swal2-file').on('change', e => {
								let fileInput = e.target;
								let imageString2 = ``;

								$('#swal2-html-container').show();
								$('.swal2-modal').css('width', '100vh');

								for (var i = 0; i < fileInput.files.length; i++) {
									if (fileInput.files && fileInput.files[i]) {
										var reader = new FileReader();
										reader.onload = function(e) {
											imageString2 += `
												<li class="splide__slide">
													<img src="${e.target.result}" alt="Pic">
												</li>
											`;

											uploadFilePreview(imageString2);
										};
										reader.readAsDataURL(fileInput.files[i]);
									}
								}
							});
						}
					}).then(result2 => {
						if(result2.value){
				            swal.showLoading();

				            let formData = new FormData();
				            formData.append('id', id);

				            for (var i = 0; i < $('.swal2-file').prop('files').length; i++) {
				            	formData.append(`images${i}`, $('.swal2-file').prop('files')[i]);
				            	console.log($('.swal2-file').prop('files')[i]);
				            }
				            // formData.append('images[]', $('.swal2-file').prop('files'));
				            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

							uploadImages(formData, id);
						}
						// showImages(id, imageString);
					});
				}
			});
		}

		function uploadFilePreview(imageString2){
			$('#swal2-html-container').html(`
				<div class="splide" role="group" aria-label="Splide Basic HTML Example" style="margin: auto;">
				  <div class="splide__track">
						<ul class="splide__list">
							${imageString2}
						</ul>
				  </div>
				</div>
			`);

			$('.swal-height').css('height', '80vh');
			new Splide( '.splide', {
				type   : 'loop',
				height: '100%',
				width: '60%',
				gap: '5em'
			}).mount();
		}

		async function uploadImages(formData, id){
		    await fetch('{{ route('event.uploadImages') }}', {
		        method: "POST", 
		        body: formData,
		    }).then(result => {
		        console.log(result);
		        ss("Successfully Uploaded Files", "Refreshing");
		        setTimeout(() => {
		            // window.location.reload();
		            viewImages(id);
		        }, 1200);
		    });
		}

		// TICKETS
		function viewTickets(id){
			$.ajax({
				url: '{{ route('event.get') }}',
				data: {
					select: 'ticket',
					where: ['id', id]
				},
				success: result => {
					result = JSON.parse(result)[0].ticket;
					let ticketString = "";
					let checked = "";
					
					if(result == null){
						ticketString = `
							<tr>
								<td colspan="3">NOT SET</td>
							</tr>
						`;
					}
					else{
						let tickets = getTickets(id);
					}


					Swal.fire({
						title: "Ticket Details",
						html: `
							<table class="table table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Test</th>
									</tr>
								</thead>
								<tbody>
									${ticketString}
								</tbody>
							</table>
						`,
						didOpen: () => {
						}
					})
				}
			})
		}

		function getTickets(id){
			$.ajax({
				url: '{{ route('ticket.get') }}',
				data: {
					where: ['event_id', id],
				},
				success: result => {
					result = JSON.parse(result);
					console.log(result, 'yesy');
				}
			})
		}
	</script>
@endpush