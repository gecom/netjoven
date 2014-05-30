<section class="fullbanner">
	<?php $bs = BannerHelper::getBanner(1); ?>
	<?php 
		if (strpos($bs,'bannerpush')){
			$bs = addslashes($bs);
			$bs = str_replace('$bannersuperior = \"','$bannersuperior = "',$bs);
			$bs = str_replace('$bannerpush = \"','$bannerpush = "',$bs);
			$bs = str_replace('\";','";',$bs);
			
			try {
				eval($bs);
				$bannersuperior =  	stripslashes($bannersuperior);
				$bannerpush =  	stripslashes($bannerpush);
				$bannerpush .= '<script type="text/javascript">
				function Ocultar(){ $("#Layer1M").css("height","90px"); }
				function Abrir(){$("#Layer1M").css("height","400px");}
				</script>';				
			} catch (Exception $e) {
				$bannersuperior = null;
				$bannerpush = null;
			}

		}else{
			$bannersuperior = $bs;
		}

		$bannersuperior = trim($bannersuperior);

	?>

	@if (!empty($bannersuperior))
		<div class="banner-top">{{ $bannersuperior}}</div>
	@endif	

</section>

<section class="fullbanner">
	@if (isset ($bannerpush) && !empty($bannerpush))
			<div id="Layer1M" style="clear:both;">{{$bannerpush}}</div>
	@endif
</section>




