<!DOCTYPE html>
<html>

<head>
	@include('frontend.includes.head')
</head>

<body>
	<div class="container">
		<header>
			@include('frontend.includes.header')
		</header>
		<nav id="main_nav">
			@include('frontend.includes.menu')
		</nav>
		<section id="banner">
			<div class="left_banner">
				<article class="p1">
					<figure><img src="images/maq/banner1.png"></figure>
				</article>
				<article class="p2">
					<figure><img src="images/maq/banner2.png"></figure>
				</article>
			</div><div class="right_banner">
				<figure><img src="images/maq/banner3.jpg"></figure>
				<div class="paginate"><img src="images/maq/paginate.jpg" alt=""></div>
			</div>
		</section>
		<section id="news">
			<div class="title_news">Últimas noticias</div>
			<ul class="option_news">
				<li><span class="circle"></span><a href="#" class="active">Ultimas</a></li><li><span class="circle"></span><a href="#">People's Choice Awards</a></li><li><span class="circle"></span><a href="#">MTV EMA 2013</a></li><li><span class="circle"></span><a href="#">Rafael Nadal en Lima</a></li><li><span class="circle"></span><a href="#">Representantes de lo Nuestro</a></li><li><span class="circle"></span><a href="#">Miembros de mesa</a></li><li><span class="circle"></span><a href="#">Elecciones 2013</a></li>
			</ul>
			<section>
				<article >
					<div class="media"></div>
					<div class="text">Peoples Choice 2014: The Walking Dead vence como Drama de TV Favorito</div>
					<div class="opt">
						<ul>
							<li class="e1"><a href="#">+Espectáculos</a></li><li class="e2"><a href="#"></a></li><li class="e3">Hace 10 min.</li>
						</ul>
					</div>
				</article>
				<article >
					<div class="media"></div>
					<div class="text">PSY graba canción con Steven Tyler</div>
					<div class="opt">
						<ul>
							<li class="e1"><a href="#">+K-pop</a></li><li class="e2"><a href="#"></a></li><li class="e3">Hace 10 min.</li>
						</ul>
					</div>
				</article><article >
					<div class="media">						
						<div class="exclusive_label">Exclusivo</div>
					</div>
					<div class="text">Justin Bieber y Selena Gomez disfrutaron un romántico camping</div>
					<div class="opt">
						<ul>
							<li class="e1"><a href="#">+Espectáculos</a></li><li class="e2"><a href="#"></a></li><li class="e3">Hace 10 min.</li>
						</ul>
					</div>
				</article><article >
					<div class="media"></div>
					<div class="text">Arquero de Bayern Munich fue el mejor del 2013 según la IFFHS</div>
					<div class="opt">
						<ul>
							<li class="e1"><a href="#">+Deportes</a></li><li class="e2"><a href="#"></a></li><li class="e3">Hace 10 min.</li>
						</ul>
					</div>
				</article><article >
					<div class="media">
						<a class="play_video" href="#"></a>
					</div>
					<div class="text">Real Madrid vs Osasuna: En vivo 3:30 p.m. por DirecTV Copa del Rey Fotos</div>
					<div class="opt">
						<ul>
							<li class="e1"><a href="#">+Deportes</a></li><li class="e4"><a href="#"></a></li><li class="e3">Hace 10 min.</li>
						</ul>
					</div>
				</article><article >
					<div class="media"></div>
					<div class="text">Miley Cyrus se divierte junto a Snoop Dogg - Fotos</div>
					<div class="opt">
						<ul>
							<li class="e1"><a href="#">+Espectáculos</a></li><li class="e4"><a href="#"></a></li><li class="e3">Hace 10 min.</li>
						</ul>
					</div>
				</article>
			</section>
			<div class="paginate">
				<ul>
					<li class="active"><a href="#" >1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li>...</li><li><a href="#">>></a></li>
				</ul>
			</div>			
		</section>
		<section id="big_banner"></section>
		<section id="videos">
				<div class="left_video">
					<div class="video_title">
						Videos
					</div>
					<div class="video_animation"><img src="images/maq/video.png"></div>
					<div class="video_paginate"><img src="images/maq/paginate.jpg" alt=""></div>
				</div><div class="right_video">
					<div class="video_title">
						Cartelera
					</div>
					<div class="playing">
						<img src="images/maq/cartelera.png">
					</div>
					<div class="release_date">
						Estreno: 9 de Enero <a href="#">Ver trailer</a>
					</div>
				</div>
					
		</section>
		<section id="ads">
			<article class="item">
				<div class="add_title">Facebook Fail</div>
				<div class="add_content">
					<figure>
						<img src="images/maq/add1.jpg" alt="">
					</figure>
					<div class="link">
						<a href="#">ver<span>+</span></a>
					</div>
				</div>
			</article>
			<article class="item">
				<div class="add_title">Paranormal</div>
				<div class="add_content">
					<figure>
						<img src="images/maq/add2.jpg" alt="">
					</figure>
					<div class="link">
						<a href="#">ver<span>+</span></a>
					</div>
				</div>
			</article><article class="item">
				<div class="add_title">Juegos</div>
				<div class="add_content">
					<figure>
						<img src="images/maq/add3.jpg" alt="">
					</figure>
					<div class="link">
						<a href="#">ver<span>+</span></a>
					</div>
				</div>
			</article><article class="item">
				<div class="add_title">Blogs</div>
				<div class="add_content">
					<figure>
						<img src="images/maq/add4.jpg" alt="">
					</figure>
					<div class="link">
						<a href="#">ver<span>+</span></a>
					</div>
				</div>
			</article>
		</section>

		<footer>
			@include('frontend.includes.footer')	
		</footer>
	</div>

    <!-- Core Scripts - Include with every page -->
    {{ HTML::script('assets/js/jquery-1.10.2.js'); }}
    {{ HTML::script('assets/js/bootstrap.min.js'); }}
    @section('js')
    @show
</body>

</html>

