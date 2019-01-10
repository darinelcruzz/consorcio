<html>
	<head>
		<title>CAP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="icon" href="{{ asset('/img/Logo.ico') }}" />
		<link rel="stylesheet" href="{{ asset('/web/css/main.css') }}" />
	</head>
	<body class="is-preload">

		<header id="header">
			<h1><a href="/">CAP</a></h1>
			{{-- <nav id="nav">
				<ul>
					<li class="special">
						<a href="#menu" class="icon fa-bars">Menu</a>
						<div id="menu">
							<ul>
								<li><a href="/inicio">Intranet</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</nav> --}}
		</header>

		<section id="banner">
			<div class="inner">
				<h2>Consorcio<br />
				Avícola<br />
				Porcícola</h2>
				<ul class="actions special">
					<li><a href="/inicio" class="button large primary">Intranet</a></li>
				</ul>
			</div>
		</section>

		<div class="copyright container">
			<p>&copy;<a href="http://labtr3s.com">Lab3</a></p>
		</div>
		</footer>

		<script src={{ asset("/web/js/jquery.min.js")}}></script>
		<script src={{ asset("/web/js/jquery.scrolly.min.js")}}></script>
		<script src={{ asset("/web/js/browser.min.js")}}></script>
		<script src={{ asset("/web/js/breakpoints.min.js")}}></script>
		<script src={{ asset("/web/js/util.js")}}></script>
		<script src={{ asset("/web/js/main.js")}}></script>

	</body>
</html>
