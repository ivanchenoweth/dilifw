<?php
$link = mysql_connect('localhost',  'root', '123456', 'asterisk');
// $link = mysql_connect('192.168.1.2',  'penatho', 'netcom.mayo1', 'asterisk');
if  (!$link) {
    die('No pudo conectarse: ' . mysql_error());
}
echo 'Conectado  satisfactoriamente';

$user_group = '102';
##### BEGIN get campaigns listing for checkboxes #####
		echo $stmt="SELECT allowed_campaigns,qc_allowed_campaigns,qc_allowed_inbound_groups from vicidial_user_groups where user_group='$user_group';";
		var_dump($link);
		$rslt=mysql_query($stmt, $link);
		var_dump($rslt);
		$row=@mysql_fetch_row($rslt);
		var_dump($row);
		exit();
		$allowed_campaigns =			$row[0];
		$qc_allowed_campaigns =			$row[1];
		$qc_allowed_inbound_groups =	$row[2];
		$allowed_campaigns = preg_replace("/ -$/","",$allowed_campaigns);
		$campaigns = explode(" ", $allowed_campaigns);
		$qc_allowed_campaigns = preg_replace("/ -$/","",$qc_allowed_campaigns);
		$qc_campaigns = explode(" ", $qc_allowed_campaigns);
		$qc_allowed_inbound_groups = preg_replace("/ -$/","",$qc_allowed_inbound_groups);
		$qc_groups = explode(" ", $qc_allowed_inbound_groups);

	$campaigns_value='';
	$campaigns_list='<B><input type="checkbox" name="campaigns[]" value="-ALL-CAMPAIGNS-"';
	$qc_campaigns_value='';
	$qc_campaigns_list='<B><input type="checkbox" name="qc_campaigns[]" value="-ALL-CAMPAIGNS-"';
	$qc_groups_value='';
	$qc_groups_list='<B><input type="checkbox" name="qc_groups[]" value="-ALL-GROUPS-"';
	$p=0;
	// while ($p<2000)
		// {
		// if (eregi('ALL-CAMPAIGNS',$campaigns[$p])) 
			// {
			// $campaigns_list.=" CHECKED";
			// $campaigns_value .= " -ALL-CAMPAIGNS-";
			// }
		// if (eregi('ALL-CAMPAIGNS',$qc_campaigns[$p])) 
			// {
			// $qc_campaigns_list.=" CHECKED";
			// $qc_campaigns_value .= " -ALL-CAMPAIGNS-";
			// }
		// if (eregi('ALL-GROUPS',$qc_groups[$p])) 
			// {
			// $qc_groups_list.=" CHECKED";
			// $qc_groups_value .= " -ALL-GROUPS-";
			// }
		// $p++;
		// }
	$campaigns_list.="> ALL-CAMPAIGNS - USERS CAN VIEW ANY CAMPAIGN</B><BR>\n";
	$qc_campaigns_list.="> ALL-CAMPAIGNS - USERS CAN QC ANY CAMPAIGN</B><BR>\n";
	$qc_groups_list.="> ALL-GROUPS - USERS CAN QC ANY INBOUND GROUP</B><BR>\n";

	$stmt="SELECT campaign_id,campaign_name from vicidial_campaigns order by campaign_id";
	var_dump($stmt);
	$rslt=mysql_query($stmt, $link);
	$campaigns_to_print = @mysql_num_rows($rslt);
	var_dump($campaigns_to_print);
	exit();
	$o=0;
	while ($campaigns_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		
		$campaign_id_value = $rowx[0];
		$campaign_name_value = $rowx[1];
		$campaigns_list .= "<input type=\"checkbox\" name=\"campaigns[]\" value=\"$campaign_id_value\"";
		$qc_campaigns_list .= "<input type=\"checkbox\" name=\"qc_campaigns[]\" value=\"$campaign_id_value\"";
		$p=0;
		while ($p<1000)
			{
			if ( ($campaign_id_value == $campaigns[$p]) and (strlen($campaign_id_value) > 1) )
				{
				echo "<!--  X $p|$campaign_id_value|$campaigns[$p]| -->";
				$campaigns_list .= " CHECKED";
				$campaigns_value .= " $campaign_id_value";
				}
			if ($campaign_id_value == $qc_campaigns[$p]) 
				{
				$qc_campaigns_list .= " CHECKED";
				$qc_campaigns_value .= " $campaign_id_value";
				}
		#	echo "<!--  O $p|$campaign_id_value|$campaigns[$p]| -->";
			$p++;
			}
		$campaigns_list .= "> $campaign_id_value - $campaign_name_value<BR>\n";
		$qc_campaigns_list .= "> $campaign_id_value - $campaign_name_value<BR>\n";
		$o++;
		}

	$stmt="SELECT group_id,group_name from vicidial_inbound_groups where group_id NOT IN('AGENTDIRECT') order by group_id";
	$rslt=@mysql_query($stmt, $link);
	$groups_to_print = @mysql_num_rows($rslt);

	$o=0;
	while ($groups_to_print > $o)
		{
		$rowx=mysql_fetch_row($rslt);
		$group_id_value = $rowx[0];
		$group_name_value = $rowx[1];
		$qc_groups_list .= "<input type=\"checkbox\" name=\"qc_groups[]\" value=\"$group_id_value\"";
		$p=0;
		while ($p<2000)
			{
			if ( ($group_id_value == $qc_groups[$p]) and (strlen($group_id_value) > 1) )
				{
				$qc_groups_list .= " CHECKED";
				$qc_groups_value .= " $group_id_value";
				}
			$p++;
			}
		$qc_groups_list .= "> $group_id_value - $group_name_value<BR>\n";
		$o++;
		}
	var_dump($campaigns_list);
	##### END get campaigns listing for checkboxes #####
	mysql_close($link);
?>