<div class="main-container login-bg-modern">

    <form class="box login login-box-modern" action="" method="POST" autocomplete="off">
    	<p class="has-text-centered login-icon-modern">
            <i class="fas fa-user-circle fa-5x"></i>
        </p>
		<h5 class="title is-5 has-text-centered is-uppercase" style="color: #302b63;">Inicia sesión</h5>

		<?php
			if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
				$insLogin->iniciarSesionControlador();
			}
		?>

		<div class="field">
			<label class="label" style="color: #302b63;"><i class="fas fa-user-alt"></i> &nbsp; Usuario</label>
			<div class="control">
			    <input class="input input-modern" type="text" name="login_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required placeholder="Ingresa tu usuario">
			</div>
		</div>

		<div class="field">
		  	<label class="label" style="color: #302b63;"><i class="fas fa-key"></i> &nbsp; Clave</label>
		  	<div class="control">
		    	<input class="input input-modern" type="password" name="login_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required placeholder="Ingresa tu contraseña">
		  	</div>
		</div>

		<p class="has-text-centered mb-4 mt-5">
			<button type="submit" class="button btn-modern">INICIAR SESIÓN</button>
		</p>

	</form>
</div>
