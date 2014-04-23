<div id="popup_personaliza_pagina" >
	<div class="message">
		<span class="congrats msg-confirm" style="display: none">¡Felicidades!</span><br/>
		<span class="f1">Personaliza la página a tu estilo.</span><br/>
		<?php
			switch ($type_module) {
				case Helpers::TYPE_MODULE_ESTANDAR:
					$class_view_type = 'opt_1';
					break;
				case Helpers::TYPE_MODULE_MODULAR:
					$class_view_type = 'opt_2';
					break;
				case Helpers::TYPE_MODULE_LISTADO:
					$class_view_type = 'opt_3';
					break;
			}

		?>
		<span class="{{$class_view_type}}"></span><br/>
		<div class="view {{$type_module != Helpers::TYPE_MODULE_MODULAR ? 'view_3' : ''}}">
			<div class="media"><img src="{{asset('assets/images/maq/nota4.jpg')}}"></div>
			<div class="text">Arquero de Bayern Munich fue el mejor del 2013 según la IFFHS</div>
			<div class="opt">
				<ul>
					<li class="e1"><a href="#">+Deportes</a></li>
					<li class="e2"><a href="#"></a></li>
					<li class="e3">Hace 10 min.</li>
				</ul>
			</div>
		</div>

		@if($type_module == Helpers::TYPE_MODULE_ESTANDAR || $type_module == Helpers::TYPE_MODULE_LISTADO)
			<div class="view view_3">
				<div class="media"><img src="{{asset('assets/images/maq/nota4.jpg')}}"></div>
				<div class="text">Arquero de Bayern Munich fue el mejor del 2013 según la IFFHS</div>
				<div class="opt">
					<ul>
						<li class="e1"><a href="#">+Deportes</a></li>
						<li class="e2"><a href="#"></a></li>
						<li class="e3">Hace 10 min.</li>
					</ul>
				</div>
			</div>
		@endif
		<span class="f2"><span class="f3">Estilo {{Helpers::$type_module_status[$type_module]}}:</span> Si eliges esta opción, todas las notas se visualizarán a modo de cajas.</span>
		<span class="f4">Presiona Aceptar si deseas guardar los cambios</span>
		<span class="f5 msg-confirm" style="display:none">
			   @if(Auth::check())
				Todos tus cambios fueron guardados y podrás visualizarlos cada vez que inicies sesión con netjoven.
			   @else
				Todos tus cambios fueron guardados satisfactoriamente
			   @endif
		</span>
		<div class="save_cancel_opt">
			<a data-dismiss="modal" id="cancel_modal" class="cancel"><span></span>Cancelar</a>
			<a href="{{route('frontend.save.change_view', array($type_module))}}" id="save_type_module" class="save">Aceptar<span></span></a>
		</div>

		<div class="share msg-confirm" style="display:none">
			¡Gracias por personalizar tu interfaz de netjoven.pe!<br>
			<span data-dismiss="modal" class="f6"></span>
		</div>
	</div>
</div>