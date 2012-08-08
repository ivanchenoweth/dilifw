<!-- panel2 -->

        <table class="art-article" border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
            <tbody>
                <tr>
                    <td><strong>ID</strong></td>
                    <td><strong>Gestionar</strong></td>
                    <td><strong>Nombre del Titular</strong></td>
                    <td><strong>Referencia 1</strong></td>
                    <td><strong>Referencia 2</strong></td>
                    <td><strong>Cartera</strong></td>
                </tr> 
				    <?php
					if (@$datos)
						$creg=0;
						foreach ($datos as $key => $row) //Associative array $key = table, $row = row of $key
						{
						//var_dump($row->cartera);
						if ($creg == $tot_row) 
					?>  
                <tr>
                    <td><?php echo @$row->lead_id ?>  </a></td>
        
                    <td><a href="/gestionar/<?php echo @$row->lead_id ?>"><?php echo @$row->nombre ?>  </a></td>        
                    <td class="art-postfootericons"><?php echo @$row->nombre ?></td>        
                    <td style="text-align: center;"><?php echo @$row->ref1_nom ?>  </td>        
                    <td style="text-align: center;"><?php echo @$row->ref2_nom ?></td>        
                    <td style="text-align: right;"><?php echo @$row->cartera ?></td>
                </tr>
        		<?php } ?>
                <tr>
                    <td><br /></td>
        
                    <td><br /></td>
        
                    <td><br /></td>
        
                    <td><br /></td>
        
                    <td><br /></td>
        
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>

<!-- fin de tabla -->
