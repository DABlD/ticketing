<html>
	<head>
		<style>
			.container {
			  position: relative;
			  text-align: center;
			  color: white;
			}

			.centered {
			  /*position: absolute;
			  top: 80%;
			  left: 50%;
			  transform: translate(-50%, -50%);*/
			}
		</style>	
	</head>

	<body>
		@php
			// dd($transaction);
			$layout = $event->layout;
			// dd(asset("uploads/$layout"))
		@endphp

		<div class="container">
			<img src="http://127.0.0.1:8002/uploads/IDLayout1.jpg" style="width: 100px">
		</div>
	</body>
</html>