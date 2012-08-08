<!-- panel2 -->
<!-- inicio del encabezado -->
	<div class="art-postcontent">
		<div class="art-content-layout">
			<div class="art-content-layout-row">
				<div class="art-layout-cell" style="width: 25%;">
				</div>
			<div class="art-layout-cell" style="width: 50%;">
			</div>									
			<div class="art-layout-cell" style="width: 25%;">	
				<p align="right">Usuario: <br /><strong>[<?php echo htmlentities(@$_SESSION["userRow"]["full_name"]) ?>]</strong><br /></p>
			</div>									
		</div>
	</div>
<!-- Fin del encabezado -->

<fieldset>
<legend> C a r t e r a </legend>
    <?
	if ($miTitular->data["perfil"]->cartera=="Telmex") {
	?>
			<table border="1" >
			  <tr>
				<td  align="center" bgcolor="#FFFF99"><strong>CARTERA TELCEL</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Tel&eacute;fono adeudado (celular): </strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Cuenta: </strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Status del tel&eacute;fono </strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Status de cobranza </strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Ciclio</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Forma de pago</strong></td>
				<td  align="right" bgcolor="#FFFF99"><strong>Adeudo (saldo)</strong></td>
			  </tr>
			  <?php 
	  foreach($miTitular->data["data_cartera"] as $key => $telcel_row1) {
	  $telcel_row = $telcel_row1->attributes();		
	  ?>
			  <tr>
				<td  align="center"><?php echo $telcel_row["lead_id"]; ?></td>
				<td  align="center"><?php echo $telcel_row["CELULAR"]; ?></td>
				<td  align="center"><?php echo $telcel_row["CUENTA"]; ?></td>
				<td  align="center"><?php echo $telcel_row["STATUS DEL TELEFONO"]; ?></td>
				<td  align="center"><?php echo $telcel_row["STATUS DE COBRANZA"]; ?></td>
				<td  align="center"><?php echo $telcel_row["CICLO"]; ?></td>
				<td  align="center"><?php echo $telcel_row["FORMA DE PAGO"]; ?></td>
				<td  align="right"><?php echo $telcel_row["SALDO"]; ?></td>
			  </tr>
			  <?php 
	  }
	  ?>
	</table>
			<?php 
	}
	if ($miTitular->data["perfil"]->cartera=="Fonacot") {
	?>
			<table border="1" >
			  <tr>
				<td  align="left" bgcolor="#FFFF99"><strong>CARTERA FONACOT </strong></td>
				<td  align="left" bgcolor="#FFFF99"><strong>NO. CREDITO </strong></td>
				<td  align="left" bgcolor="#FFFF99"><strong>SALDO ADEUDO ACTUAL</strong></td>
				<td  align="left" bgcolor="#FFFF99"><strong>SALDO P/LIQUIDAR</strong></td>
				<td  align="right" bgcolor="#FFFF99"><strong>SALDO C/ DESC. (70/30)</strong></td>
			  </tr>
			  <?php 
		$ade_tot = 0;
		$liq_tot = 0; 
		$tot_70_30 = 0;
		foreach($miTitular->data["data_cartera"] as $key => $fona_row) {	
		$fona_row = $fona_row->attributes();	 
		 //var_dump($fona_row); 
			$ade_tot += @$fona_row["ade_tot"];
			$liq_tot += @$fona_row["liq"]; 
			$tot_70_30 += @$fona_row["70/30"];
			//number_format($etotal, 2, ".",",");
	?>
			  <tr>
				<td align="center">No. TRAB: <?php echo @$fona_row["num_trabajador"]; ?></td>
				<td align="center"><?php echo @$fona_row["num_credito"]; ?></td>
				<td align="right"><?php echo "$".number_format(@$fona_row["ade_tot"],  2, ".",","); ?></td>
				<td align="right"><?php echo "$".number_format(@$fona_row["liq"],  2, ".",","); ?></td>
				<td align="right"><?php echo "$".number_format(@$fona_row["70/30"],  2, ".",","); ?></td>
			  </tr>
			  <?php } ?>
			  <tr>
				<td align="left">&nbsp;</td>
				<td align="right">TOTALES:</td>
				<td align="right"><?php echo "$".number_format($ade_tot,  2, ".",","); ?></td>
				<td align="right"><?php echo "$".number_format( $liq_tot,  2, ".",","); ?></td>
				<td align="right"><?php echo "$".number_format( $tot_70_30,  2, ".",","); ?></td>
			  </tr>
			</table>
			<?php 
	}
	
	if ($miTitular->data["perfil"]->cartera == "Convenios") {
	
	?>
			<table border="1" >
			  <tr>
				<td  align="center" bgcolor="#FFFF99"><strong>CARTERA CONVENIOS </strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Folio</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Ref.Anterior</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Ultimo Pago </strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Pagado en el mes </strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Mensualidad</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Pago Esperado</strong></td>
			  </tr>
			  <?php 	
		if (@$miTitular->data["data_cartera"])
		foreach(@$miTitular->data["data_cartera"] as $key => $convenios_row1) {	
			$convenios_row = $convenios_row1->attributes();	 
	  ?>
			  <tr>
				<td  align="center"><?php echo @$convenios_row["lead_id"]; ?></td>
				<td  align="center"><?php echo @$convenios_row["Folio"]; ?></td>
				<td  align="center"><?php echo @$convenios_row["RefAnterior"]; ?></td>
				<td  align="center"><?php echo @$convenios_row["ultimo_pago"]; ?></td>
				<td  align="right"><?php echo @$convenios_row["pagado_en_el_mes"]; ?></td>
				<td  align="right"><?php echo @$convenios_row["mensualidad"]; ?></td>
				<td  align="right"><?php echo @$convenios_row["Total"]; ?></td>
			  </tr>
			  <?php 
		}
	  ?>
			</table>
			<?php 
	}
	
	if ($miTitular->data["perfil"]->cartera == "SLRC") {
		
	?>
			<table border="1" align="center" >
			  <tr>
				<td  align="center" bgcolor="#FFFF99"><strong>CARTERA SLRC </strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Clave_Catastrl</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Padron_del_Predio</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Ubicacion_del_Predio</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Direccion_de_Notificacion</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Tipo_de_Predio</a></strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Estado_Actual_del_Predio</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Uso_Primario_del_Predio</strong></td>
			  </tr>
			  <?php 
		foreach($miTitular->data["data_cartera"] as $key => $convenios_slrc_row1) {	
		$convenios_slrc_row = $convenios_slrc_row1->attributes();	 
	  ?>
			  <tr>
				<td  align="center"><?php echo $convenios_slrc_row["lead_id"]; ?></td>
				<td  align="center"><?php echo $convenios_slrc_row["Clave_Catastrl"]; ?></td>
				<td  align="center"><?php echo $convenios_slrc_row["Padron_del_Predio"]; ?></td>
				<td  align="center"><?php echo $convenios_slrc_row["Ubicacion_del_Predio"]; ?></td>
				<td  align="center"><?php echo $convenios_slrc_row["Direccion_de_Notificacion"]; ?></td>
				<td  align="center"><?php echo $convenios_slrc_row["Tipo_de_Predio"]; ?></td>
				<td  align="center"><?php echo $convenios_slrc_row["Estado_Actual_del_Predio"]; ?></td>
				<td  align="center"><?php echo $convenios_slrc_row["Uso_Primario_del_Predio"]; ?></td>
			  </tr>
			  <?php 
			}	
	  ?>
			  <tr>
				<td  align="center">&nbsp;</td>
				<td  align="center"><strong>Predial</strong></td>
				<td  align="center"><strong>Recargos_Predial</strong></td>
				<td  align="center"><strong>Honorarios</strong></td>
				<td  align="center"><strong>Otros_Adeudos</strong></td>
				<td  align="center"><strong>Otros_Recargos</strong></td>
				<td  align="center"><strong>TOTAL</strong></td>
				<td  align="center">&nbsp;</td>
			  </tr>
			  <tr>
				<td  align="center">&nbsp;</td>
				<td  align="center"><?php echo $convenios_slrc_row["Predial"]; ?></td>
				<td  align="center"><?php echo $convenios_slrc_row["Recargos_Predial "]; ?></td>
				<td  align="center"><?php echo $convenios_slrc_row["Honorarios"]; ?></td>
				<td  align="center"><?php echo $convenios_slrc_row["Otros_Adeudos"]; ?></td>
				<td  align="center"><?php echo $convenios_slrc_row["Otros_Recargos"]; ?></td>
				<td  align="center"><?php echo $convenios_slrc_row["TOTAL"]; ?></td>
				<td  align="center">&nbsp;</td>
			  </tr>
			</table>
			<p>
			  <?php
					} // if convenios							
	if ($miTitular->data["perfil"]->cartera == "Mexicali") {	
	?>
	</p>
			<table border="1" align="center" >
			  <tr>
				<td  align="center" bgcolor="#FFFF99"><strong>Nombre del Propietario<br />
				  (Mexicali)
</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Clave</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Tasa_(%)</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Sup</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Ultimo Bimestre</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>RegCatastro</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Rezago</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>A&Ntilde;O_2012</strong></td>
			  </tr>
			  <?php 
		foreach($miTitular->data["data_cartera"] as $key => $convenios_mex_row1) {	
		$convenios_mex_row = $convenios_mex_row1->attributes();	 
	  ?>
			  <tr>
				<td  align="center"><?php echo $convenios_mex_row["propietario"]; ?></td>
				<td  align="center"><?php echo $convenios_mex_row["clave"]; ?></td>
				<td  align="center"><?php echo $convenios_mex_row["tasa_(%)"]; ?></td>
				<td  align="center"><?php echo $convenios_mex_row["sup."]; ?></td>
				<td  align="center"><?php echo $convenios_mex_row["ultimobimestre"]; ?></td>
				<td  align="center"><?php echo $convenios_mex_row["regcatastro"]; ?></td>
				<td  align="center"><?php echo $convenios_mex_row["rezago"]; ?></td>
				<td  align="center"><?php echo $convenios_mex_row["año_2012"]; ?></td>
			  </tr>
			  <?php 
			}	
	  ?>
			  <tr>
				<td  align="center" bgcolor="#FFFF99"><strong>Total</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Fomento</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Recargos</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Descuento</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Gastos_Ej</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Multas</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Cruz_Roja</strong></td>
				<td  align="center" bgcolor="#FFFF99"><strong>Sub_Total</strong></td>
			  </tr>
			  <tr>
				<td  align="center"><?php echo $convenios_mex_row["total"]; ?></td>
				<td  align="center"><?php echo $convenios_mex_row["fomento"]; ?></td>
				<td  align="center"><?php echo $convenios_mex_row["recargos"]; ?></td>
				<td  align="center"><?php echo $convenios_mex_row["descuento"]; ?></td>
				<td  align="center"><?php echo $convenios_mex_row["gastos_ej"]; ?></td>
				<td  align="center"><?php echo $convenios_mex_row["multas"]; ?></td>
				<td  align="center"><?php echo $convenios_mex_row["cruz_roja"]; ?></td>
				<td  align="center"><?php echo $convenios_mex_row["sub_total"]; ?></td>
			  </tr>
			</table>
			<p>
			  <?php
					} // if convenios							
				?>
			</p>
			<p><!-- fin de tabla -->
	</p>
</fieldset>
<!--
	<fieldset><legend> P e r f i l </legend>
        <table class="art-article" border="0" cellspacing="0" cellpadding="0"">
            <tbody>
			    <?php
					if (@$datos)
						foreach ($datos as $key => $row) //Associative array $key = table, $row = row of $key
						{
					?>  
                <tr>
                    <td ><strong>Nombre del Titular: </strong></td>
                    <td ><span class="art-postfootericons"><?php echo htmlentities(@$row->nombre) ?></span></td>
                    <td >&nbsp;</td>
                    <td >&nbsp;</td>
                </tr> 
                    <tr>
                      <td><strong>Calle:</strong></td>
                      <td class="art-postfootericons"><?php echo htmlentities(@$row->calle) ?></td>
                      <td class="art-postfootericons"><strong>Num:<?php echo @$row->num ?><strong> Int:<strong><?php echo @$row->inter ?></strong></strong></strong></td>
                      <td class="art-postfootericons"><strong>C.P.<strong><?php echo @$row->codigopostal ?></strong></strong></td>
                    </tr>
                    <tr>
                      <td><span class="art-postfootericons"><strong><strong>Cartera:</strong><?php echo Registry::getCartera(@$row->cartera) ?></strong></span></td>
                      <td class="art-postfootericons"><strong><strong><strong>Email:<?php echo @$row->email ?></strong></strong></strong></td>
                      <td class="art-postfootericons"><strong><strong>Estado Actual:</strong></strong></td>
                      <td class="art-postfootericons"><strong><?php echo @$row->estadoactual ?></strong></td>
                    </tr>
        <?php } ?>
            </tbody>
</table>

<table align="center" cellpadding="3" cellspacing="3">
  <tr>
    <td align="center" bgcolor="#CCCCCC"><strong>Referencias</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>Nombre</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>Tel</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>Direcci&oacute;n</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>Email</strong></td>
  </tr>
  <tr>
    <td align="center"><strong>1ra </strong></td>
    <td align="center"><?php echo @$row->ref1_nom ?></td>
    <td align="center"><?php echo @$row->ref1_tel ?></td>
    <td align="center"><?php echo @$row->ref1_dir ?></td>
    <td align="center"><?php echo @$row->ref1_email ?></td>
  </tr>
  <tr>
    <td align="center"><strong>2da </strong></td>
    <td align="center"><?php echo @$row->ref2_nom ?></td>
    <td align="center"><?php echo @$row->ref2_tel ?></td>
    <td align="center"><?php echo @$row->ref2_dir ?></td>
    <td align="center"><?php echo @$row->ref1_email ?></td>
  </tr>
</table>
  <table align="center" cellpadding="3" cellspacing="3">
          <tr>
            <td bgcolor="#00CCFF"><strong>Tel&eacute;fonos  </strong></td>
            <td bgcolor="#00CCFF"><strong>Pertenece</strong></td>
            <td bgcolor="#00CCFF"><strong>Direcci&oacute;n</strong></td>
            <td bgcolor="#00CCFF"><strong>Tipo</strong></td>
            <td bgcolor="#00CCFF"><strong>Resultado &uacute;ltimo </strong></td>
          </tr>	
		  <?php foreach ($miTitular->data["phones"] as $key => $phone_row) { 
		  ?>	  
          <tr>
            <td><?php echo $phone_row->phone ?></td>
            <td><?php echo $phone_row->pertenece ?></td>
            <td><?php echo $phone_row->dirección?></td>
            <td><?php echo $phone_row->tipo ?></td>
            <td><?php echo $phone_row->resultado ?></td>
          </tr>
		    <?php } ?>	  
</table>
</fieldset>
<hr />
-->
<fieldset>
<legend> G e s t i &oacute; n </legend>
<form action="">
<table align="center" cellpadding="3" cellspacing="3">
  <tr>
    <td colspan="2" align="center" bgcolor="#FF6600"><strong>Captura de la Gesti&oacute;n</strong><strong> de la Visita </strong></td>
  </tr>
  <tr>
    <td align="center"><strong>Acci&oacute;n - Tipo </strong></td>
    <td align="center">
	<select name="resultado">
        <option value="Todos" selected>Selecciona..</option>
        <?php 	// All the result

			foreach ($resultado as $key => $res_row1) { 
			  $res_row = @$res_row1->attributes();	
				$selected="";
				 if ($res_row["resultado"] == @$_REQUEST["resultado"])
					$selected=" selected ";
			?>
        <option value="<?php echo $res_row["resultado"] ?>" <?php echo $selected; ?>><?php echo $res_row["resultado"] ?></option>
        <?php } ?>
      </select>    </td>
  </tr>
  <tr>
    <td align="center"><strong>Acci&oacute;n - Resultado </strong></td>
    <td align="center">
		<select name="resultado2">
        <option value="Todos" selected>Selecciona...</option>
        <?php 	// All the result
			foreach ($resultado2 as $key => $res_row2) { 
			  $res_row2 = @$res_row2->attributes();	
				$selected="";
				 if ($res_row2["resultado"] == @$_REQUEST["resultado2"])
					$selected=" selected ";
			?>
        <option value="<?php echo $res_row2["resultado"] ?>" <?php echo $selected; ?>><?php echo $res_row2["resultado"] ?></option>
        <?php } ?>
      </select>	  </td>
  </tr>
  <tr>
    <td align="center"><strong>Siguiente -Tarea </strong></td>
    <td align="center">
		<select name="resultado3">
        <option value="Todos" selected>Selecciona...</option>
      <?php 	
			foreach ($resultado3 as $key => $res_row3) { 
			  $res_row3 = @$res_row3->attributes();	
				$selected="";
				 if ($res_row3["resultado"] == @$_REQUEST["resultado3"])
					$selected=" selected ";
			?>
      <option value="<?php echo $res_row3["resultado"] ?>" <?php echo $selected; ?>><?php echo $res_row3["resultado"] ?></option>
      <?php } ?>
    </select>
		 Fecha-Hora: 
		 <input name="fechahorasigtarea" id="demo1" value="<?php echo @$_REQUEST["fechahorasigtarea"]; ?>" readonly />
        <a href="javascript:NewCal('demo1','yyyyMMDD',true,24)"><img src="/images/cal.gif" align="absmiddle" /></a> </td>
  </tr>
  <tr>
    <td align="center"><strong>Persona contactada </strong></td>
    <td align="center"><select name="tipopersonacontactada">
      <option value="0">Selecciona...</option>
      <option value="Titular" <?php if(@$_REQUEST["tipopersonacontactada"]==1) echo "selected" ?> >Titular </option>
      <option value="Empleado" <?php if(@$_REQUEST["tipopersonacontactada"]==2) echo "selected" ?> >Empleado</option>	  
      <option value="Familiar" <?php if(@$_REQUEST["tipopersonacontactada"]==3) echo "selected" ?> >Familiar</option>
      <option value="Representante legal" <?php if(@$_REQUEST["tipopersonacontactada"]==4) echo "selected" ?> >Representante legal</option>
      <option value="Vecino" <?php if(@$_REQUEST["tipopersonacontactada"]==5) echo "selected" ?> >Vecino</option>	  	  
      <option value="Conocido" <?php if(@$_REQUEST["tipopersonacontactada"]==6) echo "selected" ?> >Conocido</option>	  	  	  
    </select>
      Nombre:
        <input name="nombrepersonacontactada" type="text" size="40" maxlength="40" />
        <br />
      
        Tel:
        <input name="telefonopersonacontactada" value="<?php echo @$_REQUEST["telefonopersonacontactada"] ?>" />
    (10 D&iacute;gitos) </td>
  </tr>
  <tr>
    <td align="center"><strong>Observaciones/Resumen</strong></td>
       <td align="center"><textarea name="observaciones" cols="100" rows="3"><?php echo @$_REQUEST["observaciones"] ?></textarea>
         :      </td>
  </tr>
</table>
  <input name="Aceptar" type="submit" id="Aceptar" value="Aceptar" />
</form>
</fieldset>
<hr />
<fieldset>
<legend> H i s t o r i a l e s </legend>		
        <table border="1">
				  <?php foreach ($miTitular->data["titular_log"] as $key => $ges_row1) { 
		  $ges_row = @$ges_row1->attributes();	
		  ?>
          <tr>
            <td width="17" bgcolor="#999999"><strong>Id</strong></td>
            <td width="120"><strong>Fecha de Gesti&oacute;n </strong></td>
            <td width="46"><strong>Accion-Tipo</strong></td>
            <td width="134"><strong>Acci&oacute;n - Resultado</strong></td>
            <td width="134"><strong>Siguiente Tarea </strong></td>
            <td width="134"><strong>Fecha-Hora<br />
Siguiente Tarea</strong></td>
          </tr>

          <tr>
            <td><?php echo @$ges_row["id"] ?></td>
            <td><?php echo @$ges_row["fechalog"] ?></td>
            <td><?php echo @$ges_row["estadoactual"] ?></td>
            <td><?php echo @$ges_row["resultado2"] ?></td>
            <td><?php echo @$ges_row["resultado3"] ?></td>
            <td><?php echo @$ges_row["fechahorasigtarea"] ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><strong>Tipo de  Persona contactada </strong></td>
            <td><strong>Nombre de la Persona contactada </strong></td>
            <td><strong>Tel&eacute;fono</strong></td>
            <td colspan="2"><strong>Resumen/Obervaciones</strong></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><?php echo @$ges_row["tipopersonacontactada"] ?></td>
            <td><?php echo @$ges_row["nombrepersonacontactada"] ?></td>
            <td><?php echo @$ges_row["telefonopersonacontactada"] ?></td>
            <td colspan="2"><?php echo htmlentities(@$ges_row["resumen"]) ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
		   <?php } ?>	 
		</table>
        <table border="1">
          <tr>
            <td bgcolor="#33CC00"><strong>Tel&eacute;fono marcado  </strong></td>
            <td bgcolor="#33CC00"><strong>Id</strong></td>
            <td bgcolor="#33CC00"><strong>Fecha</strong></td>
            <td bgcolor="#33CC00"><strong>Resumen </strong></td>
            <td bgcolor="#33CC00"><strong>Observaciones</strong></td>
          </tr>
		    <?php foreach ($miTitular->data["phones_log"] as $key => $phonelog_row1) { 
			 $phonelog_row = $phonelog_row1->attributes();
		  ?>
          <tr>
            <td><?php echo  $phonelog_row["phone"] ?></td>
            <td><?php echo $phonelog_row["onus_titular_log_id"] ?></td>
            <td><?php echo $phonelog_row["fechaactual"] ?></td>
            <td><?php echo $phonelog_row["resultado"] ?></td>
            <td><?php echo $phonelog_row["observaciones"] ?></td>
          </tr>
		  <?php } ?>
        </table>
</fieldset>
<hr />
