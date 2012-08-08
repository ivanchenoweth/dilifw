<em>[VistaPlantillaFormaEditarProductos.php]</em>
<form action="/productos/<?php echo $form_action; ?>" method="post">		
		<?php echo $msg; ?>
	  <br>
	  ID:
		  <input type="text" name="id" readonly value="<?php echo @$row->id ?>" />
	    <br />
        Clave:
        <input name="cveprod" type="text"  value="<?php echo @$row->cveprod ?>"  />
        <br />
Descripcion:
<input name="descripcion" type="text"   value="<?php echo @$row->descripcion ?>"  />
<br />
Precio:
<input name="precio" type="text"  value="<?php echo @$row->precio ?>"  />
<br>
        <input name="Aceptar" type="submit" id="Aceptar" value="Aceptar" />
	    <input name="Cancelar" type="submit" id="Cancelar" value="Cancelar" />
</form>