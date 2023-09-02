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
                    				<th>Category</th>
                    				<th>Tickets Sold</th>
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
	<link rel="stylesheet" href="{{ asset('css/splide.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
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
	<script src="{{ asset('js/select2.min.js') }}"></script>
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
					{data: 'category'},
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
						targets: [8],
						width: "150px",
					},
					{
						targets: [6],
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
				ordering: false
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
					let array = [];

					$.ajax({
						url: '{{ route('event.get') }}',
						data: {
							select: "category"
						},
						success: result => {
							result = JSON.parse(result);
							let array = [];

							result.forEach(event => {
								array.push(event.category);
							});
							
							showDetails(event, array);
						}
					})

				}
			})
		}

		function create(){
			$.ajax({
				url: '{{ route('event.get') }}',
				data: {
					select: "category"
				},
				success: result => {
					result = JSON.parse(result);
					let array = [];

					result.forEach(event => {
						array.push(event.category);
					});

					create2(array);
				}
			})
		}

		function create2(categories){
			categories.push("Concert", "Music Festival", "Workshop", "Bazaar", "Charity", "Product Launch");
			categories = [...new Set(categories)];

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

			        <div class="row iRow">
					    <div class="col-md-3 iLabel">
					        Category
					    </div>

					    <div class="col-md-3 iInput">
					        <select name="category" class="form-control">
					        	<option value=""></option>
					        </select>
			        	</div>

			        	<div class="col-md-6"></div>
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

                    $('[name="category"]').select2({
                        placeholder: "Select Category",
                        data: categories,
                        tags: true
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
							category: $("[name='category']").val(),
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

		function showDetails(event, categories){
			categories.push("Concert", "Music Festival", "Workshop", "Bazaar", "Charity", "Product Launch");
			categories = [...new Set(categories)];

			Swal.fire({
				title: 'Event Details',
				html: `
	                ${input("id", "", event.id, 3, 9, 'hidden')}
	                ${input("name", "Name", event.name, 3, 9)}
					${input("date", "Description", event.date, 3, 9)}
					${input("start_time", "Start", event.start_time, 3, 9)}
					${input("end_time", "End", event.end_time, 3, 9)}

			        <div class="row iRow">
					    <div class="col-md-3 iLabel">
					        Category
					    </div>

					    <div class="col-md-3 iInput">
					        <select name="category" class="form-control">
					        	<option value=""></option>
					        </select>
			        	</div>

			        	<div class="col-md-6"></div>
				    </div>

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

                    $('[name="category"]').select2({
                        placeholder: "Select Category",
                        data: categories,
                        tags: true
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
				    	$('[name="category"]').val(event.category).trigger('change');
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
							category: $("[name='category']").val(),
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

		function updateStatus(id, status){
			let statuses = {
				"Arranging": "Arranging", 
				"Upcoming": "Upcoming",
				"Finished": "Finished",
				"Cancelled": "Cancelled"
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
						url: "{{ route('event.update') }}",
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

		async function uploadTicketImage(formData, id){
		    await fetch('{{ route('event.uploadTicketImage') }}', {
		        method: "POST", 
		        body: formData,
		    }).then(result => {
		        console.log(result);
		        ss("Successfully Uploaded Image", "Refreshing");
		        setTimeout(() => {
		            // window.location.reload();
		            viewTickets(id);
		        }, 1200);
		    });
		}

		// TICKETS
		function viewTickets(id, ticketImage){
			$.ajax({
				url: '{{ route('ticket.get') }}',
				data: {
					where: ['event_id', id]
				},
				success: result => {
					result = JSON.parse(result);

					let ticketString = "";
					let checked = "";

					if(!result.length){
						ticketString = `
							<tr>
								<td colspan="9">NOT SET</td>
							</tr>
						`;
					}
					else{
						result.forEach(ticket => {
							ticketString += `
								<tr>
									<td>${ticket.id}</td>
									<td>${ticket.type}</td>
									<td>₱${ticket.price}</td>
									<td>${ticket.stock}</td>
									<td>0</td>
									<td>${toDate(ticket.end_date)}</td>
									<td>${ticket.sale_price ? "₱" + ticket.sale_price : "-"}</td>
									<td>${ticket.sale_until ? toDate(ticket.sale_until) : "-"}</td>
									<td>
										<a class="btn btn-success" data-toggle="tooltip" title="Edit" onclick="editTicket(${id}, ${ticket.id}, '${ticketImage}')">
											<i class="fas fa-pencil"></i>
										</a>
									</td>
								</tr>
							`;
						})
					}

					Swal.fire({
						title: "Ticket Details",
						html: `

							<div style="height: 40px;">
								<a class="float-right btn btn-success btn-sm" data-toggle="tooltip" title="Add Ticket" onclick="addTicket(${id})">
									<i class="fas fa-plus"></i>
								</a>

								<a class="float-right btn btn-info btn-sm" data-toggle="tooltip" title="Upload Image" onclick="ticketImage(${id}, '${ticketImage}')" style="margin-right: 5px;">
									<i class="fas fa-image"></i>
								</a>
							</div>

							<table class="table table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Type</th>
										<th>Price</th>
										<th>Stock</th>
										<th>Sold</th>
										<th>Sell Duration</th>
										<th>Sale Price</th>
										<th>Sale End</th>
										<th>Edit</th>
									</tr>
								</thead>
								<tbody>
									${ticketString}
								</tbody>
							</table>
						`,
						width: "80%",
						didOpen: () => {
						}
					})
				}
			})
		}

		function ticketImage(id, image = null){
			Swal.fire({
				title: "View Images",
				showDenyButton: true,
				denyButtonText: 'Upload Image',
				denyButtonColor: successColor,
     			customClass: 'swal-height',
				html: `
					<img id="preview" alt="No image uploaded" src="uploads/${id}/${image}">
				`,
			}).then(result => {
				if(result.isDenied){
					Swal.fire({
						title: "Upload Image",
						input: "file",
						inputAttributes: {
							'accept': 'image/*'
						},
						html: `
							<img id="preview">
						`,
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
								
								if(!$('#preview').is(':visible'))
								{
								    $('#preview').fadeIn();
								}

								var fr = new FileReader();
								fr.readAsDataURL(document.getElementsByClassName("swal2-file")[0].files[0]);

								fr.onload = function (e) {
								    document.getElementById("preview").src = e.target.result;
								};
							});
						}
					}).then(result2 => {
						if(result2.value){
				            swal.showLoading();

				            let formData = new FormData();
				            formData.append('id', id);

				            formData.append(`image`, $('.swal2-file').prop('files')[0]);
				            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

							uploadTicketImage(formData, id);
						}
						// showImages(id, imageString);
					});
				}
			});
		}

		function addTicket(id){
			Swal.fire({
				title: "Enter Details",
				html: `
					${input("type", "Type", null, 3, 9)}
					${input("price", "Price", null, 3, 9, 'number', 'min=0 value="0"')}
					${input("stock", "Stock", null, 3, 9, 'number', 'min=0 value="0"')}
					${input("end_date", "Sell Duration", null, 3, 9)}
					${input("sale_price", "Sale Price", null, 3, 9, 'number', 'min=0')}
					${input("sale_until", "Sale End", null, 3, 9)}
					<br>
					<h6 style="color: red; text-align: left;">Sale Details is optional</h6>
				`,
				didOpen: () => {
					$("[name='end_date'], [name='sale_until']").flatpickr({
						altInput: true,
						altFormat: "F j, Y",
						dateFormat: "Y-m-d",
					});
				},
				preConfirm: () => {
				    swal.showLoading();
				    return new Promise(resolve => {
				    	let bool = true;

			            if($('[name="type"]').val() == "" || $('[name="price"]').val() == "" || $('[name="stock"]').val() == ""){
			                Swal.showValidationMessage('Type, Price, and Stock is required');
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
						url: "{{ route('ticket.store') }}",
						type: "POST",
						data: {
							event_id: id,
							type: $('[name="type"]').val(),
							price: $('[name="price"]').val(),
							stock: $('[name="stock"]').val(),
							end_date: $('[name="end_date"]').val(),
							sale_price: $('[name="sale_price"]').val(),
							sale_until: $('[name="sale_until"]').val(),
							_token: $('meta[name="csrf-token"]').attr('content')
						},
						success: () => {
							ss("Success");
							setTimeout(() => {
								viewTickets(id);
							}, 1000);
						}
					})
				}
			});
		}

		function editTicket(id, tid, image){
			$.ajax({
				url: '{{ route('ticket.get') }}',
				data: {
					where: ['id', tid]
				},
				success: ticket => {
					ticket = JSON.parse(ticket)[0];
					console.log(ticket);

					Swal.fire({
						title: "Enter Details",
						html: `
							${input("type", "Type", ticket.type, 3, 9)}
							${input("price", "Price", ticket.price, 3, 9, 'number', 'min=0 value="0"')}
							${input("stock", "Stock", ticket.stock, 3, 9, 'number', 'min=0 value="0"')}
							${input("end_date", "Sell Duration", ticket.end_date, 3, 9)}
							${input("sale_price", "Sale Price", ticket.sale_price, 3, 9, 'number', 'min=0')}
							${input("sale_until", "Sale End", ticket.sale_until, 3, 9)}
							<br>
							<h6 style="color: red; text-align: left;">Sale Details is optional</h6>
						`,
						didOpen: () => {
							$("[name='end_date'], [name='sale_until']").flatpickr({
								altInput: true,
								altFormat: "F j, Y",
								dateFormat: "Y-m-d",
							});
						},
						preConfirm: () => {
						    swal.showLoading();
						    return new Promise(resolve => {
						    	let bool = true;

					            if($('[name="type"]').val() == "" || $('[name="price"]').val() == "" || $('[name="stock"]').val() == ""){
					                Swal.showValidationMessage('Type, Price, and Stock is required');
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
								url: "{{ route('ticket.update') }}",
								type: "POST",
								data: {
									id: tid,
									type: $('[name="type"]').val(),
									price: $('[name="price"]').val(),
									stock: $('[name="stock"]').val(),
									end_date: $('[name="end_date"]').val(),
									sale_price: $('[name="sale_price"]').val(),
									sale_until: $('[name="sale_until"]').val(),
									_token: $('meta[name="csrf-token"]').attr('content')
								},
								success: () => {
									ss("Success");
									setTimeout(() => {
										viewTickets(id, image);
									}, 1000);
								}
							})
						}
					});
				}
			})
		}
	</script>
@endpush