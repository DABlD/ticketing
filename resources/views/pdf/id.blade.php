<html>
	<head>
		<style>
			.container {
			  position: relative;
			  text-align: center;
			  color: black;
			  width: 170px;
			  height: 303px;
			}

			.centered {
			  position: absolute;
			  top: 60%;
			  text-align: left;
			  left: 10%;
			  font-size: 9px;
/*			  transform: translate(-80%, -80%);*/
			}
		</style>	
	</head>

	<body>
		<br>
		<div class="container">
			<img src="{{ public_path("uploads\\$event->layout") }}" width="170" height="303">
			<div class="centered">
				Name: {{ $transaction->fname }} {{ $transaction->mname }} {{ $transaction->lname }}<br>
				Company: {{ $transaction->company }}<br>
				Position: {{ $transaction->position }}
			</div>
		</div>
	</body>
</html>