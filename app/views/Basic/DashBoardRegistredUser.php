<div align="center"><strong>Gesti&oacute;n de Titulares 
</strong></div>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" align="center">
    <tr>
      <td  align="center">Bienvenido<br /> 
      [<strong><?php echo $_SESSION["userRow"]["nombre"] ?></strong>]</td>
      <td align="center">Usuario Registrado </td>
      <td align="center"><a href="/index/logout">Logout</a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><a href="/">Buscar titular </a></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>					<?php if (@$panel1) {
								require_once(@$panel1);
							}
							?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><?php if (@$panel2) require_once(@$panel2); ?></td>
      <td>&nbsp;</td>
    </tr>
  </table>
p
</form>
