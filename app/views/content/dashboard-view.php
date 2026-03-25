<div class="container is-fluid dashboard-container pt-5">
	
	<div class="welcome-section columns is-vcentered">
		<div class="column is-narrow">
			<figure class="image is-96x96">
	    		<?php
	    			if(is_file("./app/views/fotos/".$_SESSION['foto'])){
	    				echo '<img class="is-rounded" style="border: 3px solid rgba(255,255,255,0.3);" src="'.APP_URL.'app/views/fotos/'.$_SESSION['foto'].'">';
	    			}else{
	    				echo '<img class="is-rounded" style="border: 3px solid rgba(255,255,255,0.3);" src="'.APP_URL.'app/views/fotos/default.png">';
	    			}
	    		?>
			</figure>
		</div>
		<div class="column">
			<h1 class="title welcome-title is-size-2">¡Hola, <?php echo $_SESSION['nombre']; ?>!</h1>
			<h2 class="subtitle welcome-subtitle">Bienvenido a tu panel de control</h2>
		</div>
	</div>

	<?php
		$total_cajas=$insLogin->seleccionarDatos("Normal","caja","caja_id",0);

		$total_usuarios=$insLogin->seleccionarDatos("Normal","usuario WHERE usuario_id!='1' AND usuario_id!='".$_SESSION['id']."'","usuario_id",0);

		$total_clientes=$insLogin->seleccionarDatos("Normal","cliente WHERE cliente_id!='1'","cliente_id",0);

		$total_categorias=$insLogin->seleccionarDatos("Normal","categoria","categoria_id",0);

		$total_productos=$insLogin->seleccionarDatos("Normal","producto","producto_id",0);

		$total_ventas=$insLogin->seleccionarDatos("Normal","venta","venta_id",0);
	?>

	<div class="columns is-multiline">
		
		<div class="column is-4-desktop is-6-tablet">
		    <a href="<?php echo APP_URL; ?>cashierList/" class="dashboard-card">
		      	<p class="dashboard-icon"><i class="fas fa-cash-register fa-fw"></i></p>
		      	<p class="dashboard-heading">Cajas Registradas</p>
		      	<p class="dashboard-title"><?php echo $total_cajas->rowCount(); ?></p>
		    </a>
		</div>

		<div class="column is-4-desktop is-6-tablet">
	    	<a href="<?php echo APP_URL; ?>userList/" class="dashboard-card">
	      		<p class="dashboard-icon"><i class="fas fa-users fa-fw"></i></p>
	      		<p class="dashboard-heading">Usuarios</p>
	      		<p class="dashboard-title"><?php echo $total_usuarios->rowCount(); ?></p>
	    	</a>
		</div>

		<div class="column is-4-desktop is-6-tablet">
		    <a href="<?php echo APP_URL; ?>clientList/" class="dashboard-card">
		      	<p class="dashboard-icon"><i class="fas fa-address-book fa-fw"></i></p>
		      	<p class="dashboard-heading">Clientes</p>
		      	<p class="dashboard-title"><?php echo $total_clientes->rowCount(); ?></p>
		    </a>
		</div>

		<div class="column is-4-desktop is-6-tablet">
		    <a href="<?php echo APP_URL; ?>categoryList/" class="dashboard-card">
		      <p class="dashboard-icon"><i class="fas fa-tags fa-fw"></i></p>
		      <p class="dashboard-heading">Categorías</p>
		      <p class="dashboard-title"><?php echo $total_categorias->rowCount(); ?></p>
		    </a>
		</div>

		<div class="column is-4-desktop is-6-tablet">
		    <a href="<?php echo APP_URL; ?>productList/" class="dashboard-card">
		      	<p class="dashboard-icon"><i class="fas fa-cubes fa-fw"></i></p>
		      	<p class="dashboard-heading">Productos</p>
		      	<p class="dashboard-title"><?php echo $total_productos->rowCount(); ?></p>
		    </a>
		</div>

		<div class="column is-4-desktop is-6-tablet">
	    	<a href="<?php echo APP_URL; ?>saleList/" class="dashboard-card">
	      		<p class="dashboard-icon"><i class="fas fa-shopping-cart fa-fw"></i></p>
	      		<p class="dashboard-heading">Ventas Realizadas</p>
	      		<p class="dashboard-title"><?php echo $total_ventas->rowCount(); ?></p>
	    	</a>
		</div>

	</div>
</div>
