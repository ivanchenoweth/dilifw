<!-- panel1  -->
	<div class="art-postcontent">
		<div class="art-content-layout">
			<div class="art-content-layout-row">
				<div class="art-layout-cell" style="width: 25%;">
				</div>
			<div class="art-layout-cell" style="width: 50%;">
				<form id="form1" name="form1" method="post" action="">
				<p align="left">Nombre: 
				  <input name="nombre" type="text" id="nombre" value="<?php echo @$_REQUEST["nombre"] ?>" size="40" />
				</p>        
				<p align="left">Teléfono: <input value="<?php echo @$_REQUEST["tel"] ?>" type="text" name="tel" id="tel" /></p>
				<p align="center"><input name="Buscar" type="submit" class="art-button" value="Buscar" />	 <span style="text-align: right;"><?php echo @$row->id ?></span></p>											
				</form>
			</div>									
			<div class="art-layout-cell" style="width: 25%;">
				<p align="right"><strong>Usuario: [<?php echo @$_SESSION["userRow"]["nombre"] ?>]</strong><br /></p>
			</div>									
		</div>
	</div>
<!-- panel1 -->	
