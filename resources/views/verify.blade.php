<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ env("APP_NAME") . " | " . "Verification" }}</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

	<link rel="stylesheet" href="{{ asset('fonts/fontawesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/auth/animate.css') }}">
	<link rel="stylesheet" href="{{ asset('css/auth/hamburgers.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/auth/util.css') }}">
	<link rel="stylesheet" href="{{ asset('css/auth/main.css') }}">
	<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">

	<style>
	@if(isset($theme['login_bg_img']))
			.container-login100{
				background-image: url("{{ $theme['login_bg_img'] }}");
				background-size: cover;
				background-repeat: no-repeat;
				background-position: center center;
			}
	@endif
	</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100" style="display: block !important; padding-top: 50px;">
				<div class="text-center">
					<img src="{{ asset("images/logo.png") }}" alt="">
				</div>
				<br>
				<br>
				<span class="login100-form-title">
					Ticket Verification for {{ $event->name }}
				</span>

				<br>
					<div class="row">
						<div class="col-md-12" style="font-size: 20px;">
							Ticket ID: {{ $transaction->id }}-{{ now()->timestamp }}
						</div>
					</div>

					<div class="row">
						<div class="col-md-12" style="font-size: 20px;">
							Name: {{ $transaction->fname }} {{ $transaction->mname }} {{ $transaction->lname }}
						</div>
					</div>

					<div class="row">
						<div class="col-md-12" style="font-size: 20px;">
							Gender: {{ $transaction->gender }}
						</div>
					</div>

					<div class="row">
						<div class="col-md-12" style="font-size: 20px;">
							Birthday: {{ now()->parse($transaction->birthday)->format('F j, Y') }}
						</div>
					</div>

					<div class="row">
						<div class="col-md-12" style="font-size: 20px;">
							Contact: {{ $transaction->contact }}
						</div>
					</div>

					<div class="row">
						<div class="col-md-12" style="font-size: 20px;">
							Email: {{ $transaction->email }}
						</div>
					</div>

					<div class="row">
						<div class="col-md-12" style="font-size: 20px;">
							Address: {{ $transaction->address }}
						</div>
					</div>

					<div class="row">
						<div class="col-md-12" style="font-size: 20px;">
							Company: {{ $transaction->company }}
						</div>
					</div>

					<div class="row">
						<div class="col-md-12" style="font-size: 20px;">
							Position: {{ $transaction->position }}
						</div>
					</div>

					<div class="row">
						<div class="col-md-12" style="font-size: 20px;">
							Status: {{ $transaction->status }}
						</div>
					</div>

					@if(in_array($transaction->status, ["Paid"]))
						<div class="container-login100-form-btn">
							<button class="login100-form-btn" style="width: 30%;" onclick="checkIn({{ $transaction->id }})">
								Check In
							</button>
						</div>
					@elseif(in_array($transaction->status, ["Unpaid"]))
						<div class="container-login100-form-btn">
							<button class="login100-form-btn" style="width: 30%;" onclick="payFirst()">
								Check In
							</button>
						</div>
					@elseif($transaction->status == "Used")
						<div class="container-login100-form-btn">
							<button class="login100-form-btn" style="width: 30%;" href="{{ route('welcome.showID', ['id' => $transaction->id]) }}">
								Download ID
							</button>
						</div>
					@endif
			</div>
		</div>
	</div>

	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap-bundle.min.js') }}"></script>
	<script src="{{ asset('js/auth/tilt.js') }}"></script>
	<script src="{{ asset('js/auth/main.js') }}"></script>
	<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
	<script src="{{ asset('js/custom.js') }}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})

		function checkIn(id){
			Swal.fire({
				icon: "warning",
				title: "Confirmation",
				allowOutsideClick: false,
				showCancelButton: true,
				cancelButtonColor: errorColor,
				confirmButtonText: "Yes",
				confirmButtonColor: successColor,
				text: "Are you sure you want to check-in this ticket?"
			}).then(result => {
				if(result.value){
					update({
						url: "{{ route('api.update') }}",
						data: {id: id},
						message: "Successfully Checked-In"
					},	() => {
						setTimeout(() => {
							window.location.reload();
						}, 1000);
					});
				}
			})
		}

		function showID(id){
			// let layout = "{{ $event->layout }}";
			// Swal.fire({
			// 	html: `
			// 		<canvas id="id" style="width: 500px; height: 250px"></canvas>
			// 	`,
			// 	didOpen: () => {
			// 		var image = new Image();
			// 		image.src = `{{ asset('uploads/${layout}') }}`;

			// 		image.onload = () => {
			// 			var pic = document.getElementById("id");
			// 			pic.getContext('2d').drawImage(image, 0, 0, 600, 50);
			// 		}
			// 	},
			// 	width: "80%",
			// 	// height: "80vh"
			// })
			// window.location = "{{ route('welcome.showID') }}"
		}

		function payFirst(){
			Swal.fire({
				icon: "error",
				title: "Unpaid Ticket",
				text: "Please Pay First"
			})
		}

		@if($errors->all())
			Swal.fire({
				icon: 'error',
                html: `
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br/>
                    @endforeach
                `,
			});
		@endif
	</script>

</body>
</html>