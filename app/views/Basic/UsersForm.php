<em>[UsersForm.php]</em>
<form action="/users/<?php echo $form_action; ?>" method="post">
<?php echo $msg; ?><br>
	  ID:
		  <input type="text" name="id" readonly value="<?php echo @$row->id ?>" />
	    <br />
        Username:
        <input name="username" type="text" id="username" value="<?php echo @$row->username ?>"  />
        <br />
Password:
<input name="password" type="text" id="password"  value="<?php echo @$row->password ?>"  />
<br />
Nombre:
<input name="nombre" type="text" id="nombre" value="<?php echo @$row->nombre ?>"  />
<br />
Rol:
<input name="rol" type="text" id="rol" value="<?php echo @$row->rol ?>"  />
<br />
Email:
<input name="email" type="text" value="<?php echo @$row->email ?>"  />
<br />
<table width="200" border="1">
  <tr>
    <td align="center"><strong>list_id</strong></td>
    <td><strong>Lista</strong></td>
    <td><strong>ID_Campa&ntilde;a</strong></td>
    <td>&nbsp;</td>
   </tr>
   <?php 
   if (@$detail)
    foreach ($detail as $keyd => $rowd) //Associative array $key = table, $row = row of $key
    {
	?>
  <tr>
    <td align="left"><?php echo $rowd->list_id ?></td>
    <td align="left"><?php echo $rowd->list_name ?></td>
    <td align="center"><?php echo $rowd->campaign_id ?></td>
    <td align="center"><a href="/users/editar/<?php echo @$row->id ?>/lista/borrar/<?php echo $rowd->id ?>">Borrar</a></td>
    </tr>
	<?php
	}
	?>
	
  <tr>
    <td>&nbsp;</td>
    <td align="center">
		<input name="details" id="details" readonly="readonly">
		<input type="button" name="choice" onClick="window.open('t2.php','popuppage','width=850,toolbar=1,resizable=1,scrollbars=yes,height=700,top=100,left=100');" value="Buscar Lista">
	</td>
    <td align="center">&nbsp;</td>
    <td align="center">
      <input type="submit" name="Agregar" value="Agregar" />
    </a></td>
  </tr>
</table>
        <input name="Aceptar" type="submit" id="Aceptar" value="Aceptar" />
	    <input name="Cancelar" type="submit" id="Cancelar" value="Cancelar" />
</form>
