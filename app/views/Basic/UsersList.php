<html>
<em>[UserList.php]</em>
<?php echo @$msg; ?><br>
</a>
<form action="" method="post">		
<table border="1">
  <tr>
    <td>Buscar por Nombre:</td>
    <td><input name="nombrebuscar" type="text" value="<?php echo @$_REQUEST[nombrebuscar] ?>"></td>
    <td><input name="Buscar" type="submit"  value="Buscar"></td>
  </tr>
</table>
</form>
<table border="1">
    <tr>
      <td><strong>
      Id
      </strong></td>
      <td><strong>
      Usuario
      </strong></td>
      <td><strong>Password      </strong></td>
      <td><strong>Nombre</strong></td>
      <td><strong>Rol</strong></td>
      <td><strong>Email </strong></td>
      <td><strong>TimeLog</strong></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
    </tr>
    <?php
    if (@$datos)
    foreach ($datos as $key => $row) //Associative array $key = table, $row = row of $key
    {
    ?>
    <tr>
      <td align="left">
        <?php echo @$row->id ?>      </td>
      <td align="left">
        <?php echo @$row->username ?>      </td>
      <td align="left">
        <?php echo @$row->password	 ?>      </td>
      <td align="left"><?php echo @$row->nombre ?></td>
      <td align="left"><?php echo @$row->rol ?> </td>
      <td align="left"><?php echo @$row->email ?> </td>
      <td align="left"><?php echo $row->timelog->format('Y-m-d h:i:s');  ?> </td>
      <td align="left"> <a href="/users/borrar/<?php echo @$row->id ?>">Borrar</a></td>
      <td align="left">	<a href="/users/editar/<?php echo @$row->id ?>">Editar</a> </td>
    </tr>
    <?php } //end foreach loop
	?>
</table>
 <p><a href="/users/nuevo">Nuevo Registro</a></p>
 <p><a href="/">Dashboard Administrador</a></p>
</html>

