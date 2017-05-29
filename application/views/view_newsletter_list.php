<?php
	$cabezal = '<center><img src="'.base_url().'imagenes/Logo1.jpg"/></center>';
	$aux = '';
	foreach ($datanewsletter as $key => $value) {
		$nottit = $value['nottit'];
		$notenc = $value['notenc'];
		$link = $value['notcod'];
		$aux.= "
			<table width=\"100%\" border=\"0\">
				<tr>
					<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong><u>$nottit</u></strong></font></td>
				</tr>
				<tr>
					<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\">$notenc</font></td>
				</tr>
				<tr>
					<td><font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"$link\">+ ampliar</a></font></td>
				</tr>
			</table><br>
		";
	}
	echo $cabezal.$aux;
