<!--=====================================
FOOTER
======================================-->

<footer class="container-fluid">

	<div class="container">

		<div class="row">

		 	<!--=====================================
			CATEGORÍAS Y SUBCATEGORÍAS FOOTER
			======================================-->

			<div class="col-lg-5 col-md-6 col-xs-12 footerCategorias">

			<?php

				$url = Ruta::ctrRuta();

				$item = null;
				$valor = null;

				$categorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

				foreach ($categorias as $key => $value) {

					if($value["estado"] != 0){

						echo '<div class="col-lg-4 col-md-3 col-sm-4 col-xs-12">

							<h4><a href="'.$url.$value["ruta"].'" class="pixelCategorias" titulo="'.$value["categoria"].'">'.$value["categoria"].'</a></h4>

							<hr>

							<ul>';

							$item = "id_categoria";

							$valor = $value["id"];

							$subcategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);
							
							foreach ($subcategorias as $key => $value) {

								if($value["estado"] != 0){
							
									echo '<li><a href="'.$url.$value["ruta"].'" class="pixelSubCategorias" titulo="'.$value["subcategoria"].'">'.$value["subcategoria"].'</a></li>';

								}

							}

							echo '</ul>

						</div>';

					}

				}

			?>

			</div>

			<!--=====================================
			DATOS CONTACTO
			======================================-->

			<div class="col-md-3 col-sm-6 col-xs-12 text-left infoContacto">
				
				<h5>Dudas e inquietudes, contáctenos en:</h5>

				<br>
				
				<h5>
					
					<i class="fa fa-phone-square" aria-hidden="true"></i> 771 107 1638

					<br><br>

					<i class="fa fa-envelope" aria-hidden="true"></i> lavillitamueblerias@yahoo.com.mx

					<br><br>

					<i class="fa fa-map-marker" aria-hidden="true"></i> Av Benito Juárez 802, Centro, 42000 Pachuca de Soto, Hgo.

					<br><br>
					Pachuca | Hidalgo | México

				</h5>


				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14985.388780190748!2d-98.7419864!3d20.1195579!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc23fb55c36240731!2sLa+Villita+Muebler%C3%ADas!5e0!3m2!1ses-419!2smx!4v1535406155922" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>

			</div>

			<!--=====================================
			FORMULARIO CONTÁCTENOS
			======================================-->

			<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12 formContacto">
				
				<h4>RESUELVA SU INQUIETUD</h4>

				<form role="form" method="post" onsubmit="return validarContactenos()">

			  		<input type="text" id="nombreContactenos" name="nombreContactenos" class="form-control" placeholder="Escriba su nombre" required> 

			   		<br>
	    	      
   					<input type="email" id="emailContactenos" name="emailContactenos" class="	form-control" placeholder="Escriba su correo electrónico" required>  

   					<br>
	    		     	          
	       			<textarea id="mensajeContactenos" name="mensajeContactenos" class="form-control" placeholder="Escriba su mensaje" rows="5" required></textarea>

	       			<br>
	    	
	       			<input type="submit" value="Enviar" class="btn btn-default backColor pull-right" id="enviar">         

				</form>

				<?php 

					$contactenos = new ControladorUsuarios();
					$contactenos -> ctrFormularioContactenos();

				?>

			</div>
			
		</div>

	</div>

</footer>


<!--=====================================
FINAL
======================================-->

<div class="container-fluid final">
	
	<div class="container">
	
		<div class="row">
			
			<div class="col-sm-6 col-xs-12 text-left text-muted">
				
				<h5>&copy; 2018 Todos los derechos reservados. Sitio elaborado por la Compañía</h5>

			</div>

			<div class="col-sm-6 col-xs-12 text-right social">
				
			<ul>

			<?php
				
			$social = ControladorPlantilla::ctrEstiloPlantilla();

				$jsonRedesSociales = json_decode($social["redesSociales"],true);		

				foreach ($jsonRedesSociales as $key => $value) {

					echo '<li>
							<a href="'.$value["url"].'" target="_blank">
								<i class="fa '.$value["red"].' redSocial '.$value["estilo"].'" aria-hidden="true"></i>
							</a>
						</li>';
				}

			?>

			</ul>

			</div>

		</div>

	</div>

</div>