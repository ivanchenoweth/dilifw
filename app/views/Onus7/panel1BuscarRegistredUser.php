<!-- panel1  -->
	<div class="art-postcontent">
		<div class="art-content-layout">
			<div class="art-content-layout-row">
				<div class="art-layout-cell" style="width: 25%;">
				</div>
			<form id="form1" name="form1" method="post" action="">
			<div class="art-layout-cell" style="width: 50%;">
				
				<p align="left">Nombre:
				  <input name="nombre" type="text" id="nombre" value="<?php echo @$_REQUEST["nombre"] ?>" size="40" />
				</p>        
				<p align="left">Tel&eacute;fono:
				  <input value="<?php echo @$_REQUEST["tel"] ?>" type="text" name="tel" id="tel" /></p>
				<p align="center"><input name="Buscar" type="submit" class="art-button" value="Buscar" /><span style="text-align: right;"><?php echo @$row->id ?></span></p>															
			</div>									
			<div class="art-layout-cell" style="width: 25%;">
			  <p align="right"><strong>Usuario: [<?php echo htmlentities(@$_SESSION["userRow"]["full_name"]) ?>]</strong></p>
			  <p align="right">
			  Total de registros :<?php echo @$tot_row; 	// echo "paginas:".@$tot_pages 				?> 
				<?php if (Registry::get("recordperpage") < @$tot_row)  { ?>
			    
	            <select name="repag" onchange="this.form.submit()">
					<?php for($i = 1 ; $i <= $tot_pages ; $i++) { ?>
	                  <option value="<?php echo $i; ?>"
					  <?php if ($i==@$_REQUEST["repag"]) echo "selected"; ?>><?php echo $i ?></option>
					 <?php 
					 	}  
					 ?>
                  </select>
  				<?php } ?>
	            <br />
				Listas asignadas: <?php echo  @$_SESSION["userRow"]["displaylistas"] ?>
				<br />
		      </p>
			</div>	
			</form>		
		</div>	
	</div>
	
<!-- panel1 -->	
