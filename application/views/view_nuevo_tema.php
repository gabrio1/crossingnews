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



		$Nombre = array(
			'name'        => 'temnom',
			'id'          => 'Nombre',
			'size'        => 50,
			'value'		  	=> set_value('Nombre',@$datos_temas[0]->temnom),
			'placeholder' => 'Nombre',
			'type'        => 'text',
		);
		echo '<tr>';
		echo '<td>'.form_label("Nombre:",'Nombre').'</td>';
		echo '<td>';
		echo form_textarea($Nombre);
		echo '</td>';
		echo '<td><font color="red">'.form_error('Nombre').'</font></td>';
		echo '</tr>';

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
