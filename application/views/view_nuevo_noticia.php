<?php
	  echo '<center>';
	  echo '<table border=0 class="ventanas" width="650" cellspacing="0" cellpadding="0">';
	  echo '<tr>';
	  echo "<td height='10' class='tabla_ventanas_login' height='10' colspan='3'><legend align='center'>.: Nueva Noticia :.</legend></td>";
	  echo '</tr>';
	  echo '<tr><td colspan=3>';
	  $attributes = array("class" => "form-horizontal", "id" => "form", "name" => "form");
	  echo form_open();
	  echo '<center>';
	  echo '<table border=0>';

		#dibujamos campos texto
		$Titulo	= array(
			'name'        => 'nottit',
			'id'          => 'Titulo',
			'size'        => 250,
			'value'		  	=> set_value('Titulo',@$datos_noticias[0]->nottit),
			'placeholder' => 'Titulo',
			'type'        => 'text',
		);
		echo '<tr>';
		echo '<td>'.form_label("Titulo:",'Titulo').'</td>';
		echo '<td>';
		echo form_input($Titulo);
		echo '</td>';
		echo '<td><font color="red">'.form_error('Titulo').'</font></td>';
		echo '</tr>';

		$Encabezado = array(
			'name'        => 'notenc',
			'id'          => 'Encabezado',
			'size'        => 50,
			'value'		  	=> set_value('Encabezado',@$datos_noticias[0]->notenc),
			'placeholder' => 'Encabezado',
			'type'        => 'text',
		);
		echo '<tr>';
		echo '<td>'.form_label("Encabezado:",'Encabezado').'</td>';
		echo '<td>';
		echo form_textarea($Encabezado);
		echo '</td>';
		echo '<td><font color="red">'.form_error('Encabezado').'</font></td>';
		echo '</tr>';

		$Cuerpo 		  = array(
			'name'        => 'notbod',
			'id'          => 'Cuerpo',
			'size'        => 50,
			'value'		  	=> set_value('EMAIL',@$datos_noticias[0]->notbod),
			'placeholder' => 'Cuerpo',
			'type'        => 'text',
		);
		echo '<tr>';
		echo '<td>'.form_label("Cuerpo:",'Cuerpo').'</td>';
		echo '<td>';
		echo form_textarea($Cuerpo);
		echo '</td>';
		echo '<td><font color="red">'.form_error('Cuerpo').'</font></td>';
		echo '</tr>';

		$Fecha 		  = array(
			'name'        => 'notfec',
			'id'          => 'Fecha',
			'size'        => 50,
			'value'		  	=> set_value('Fecha',isset($datos_noticias[0]->notfec) ? @$datos_noticias[0]->notfec : date("Ymd")),
			'placeholder' => date("Ymd"),
			'type'        => 'text',
		);
		echo '<tr>';
		echo '<td>'.form_label("Fecha:",'Fecha').'</td>';
		echo '<td>';
		echo form_input($Fecha);
		echo '</td>';
		echo '<td><font color="red">'.form_error('Fecha').'</font></td>';
		echo '</tr>';
		if(!empty($datos_temas)){
			foreach($datos_temas as $tema){
				echo '</td>';
				echo '<td><input type="checkbox" value='.$tema['temcod'].' checked>'.$tema['temnom'].'</input></td>';
				echo '</tr>';
			}
		}
		if(!empty($datos_listatemas)){
			foreach($datos_listatemas as $listatema){
				echo '</td>';
				echo '<td><input type="checkbox" value='.$listatema['temcod'].'>'.$listatema['temnom'].'</input></td>';
				echo '</tr>';
			}
		}
		echo '<input type="hidden" name="temas"></input>';
		echo '<tr>';
		echo '<td colspan=3>'.$this->session->flashdata('msg').'</td>';
		echo '</tr>';
		echo '<tr><td colspan=3><hr/></td></tr>';
		echo '<tr>';
		echo '<td colspan=3><center>';
		echo '<input type="submit" class="btn btn-success" value="Guardar">';
	  echo '</center></td></tr>';
	  echo '</table></center>';
	  echo form_close();
	  echo '</td></tr>';
	  echo '</table>';
	  echo '</center>';
?>
<script>
	jQuery( "form" ).submit(function(e) {
		//e.preventDefault();
		var listaDias = [];
		jQuery("input[type=checkbox]").each(function (index) {
			if($(this).is(':checked')){
				listaDias.push($(this).val());
		 	}
		});
		jQuery("input[name='temas']").val(listaDias);
	});
</script>
