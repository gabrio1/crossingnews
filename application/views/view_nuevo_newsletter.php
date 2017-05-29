<?php
	  echo '<center>';
	  echo '<table border=0 class="ventanas" width="650" cellspacing="0" cellpadding="0">';
	  echo '<tr>';
	  echo "<td height='10' class='tabla_ventanas_login' height='10' colspan='3'><legend align='center'>.: Generar Newsletter :.</legend></td>";
	  echo '</tr>';
	  echo '<tr><td colspan=3>';
	  $attributes = array("class" => "form-horizontal", "id" => "form", "name" => "form", "action"=> "test");
	  echo form_open();
	  echo '<center>';
	  echo '<table border=0>';

		#dibujamos campos texto
		$Fecha = array(
			'name'        => 'fecha',
			'id'          => 'Fecha',
			'size'        => 250,
			'value'		  	=> set_value('Fecha',date("Ymd")),
			'placeholder' => 'Fecha',
			'type'        => 'text',
		);
		echo '<tr>';
		echo '<td>'.form_label("Fecha:",'Fecha').'</td>';
		echo '<td>';
		echo form_input($Fecha);
		echo '</td>';
		echo '<td><font color="red">'.form_error('Fecha').'</font></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td colspan=3>'.$this->session->flashdata('msg').'</td>';
		echo '</tr>';
		echo '<tr><td colspan=3><hr/></td></tr>';
		echo '<tr>';
		echo '<td colspan=3><center>';
		echo '<a class="btn btn-success" id="generonews">Generar</a>';
	  echo '</center></td></tr>';
	  echo '</table></center>';
	  echo form_close();
	  echo '</td></tr>';
	  echo '</table>';
	  echo '</center>';
?>
<script>
var base_url = '<?php echo base_url(); ?>';
jQuery('#generonews').on('click',function(){
	if(jQuery('input[name="fecha"]').val()){
		window.location.href = base_url+'index.php/newsletter/GenerarNewsletter?fecha='+jQuery('input[name="fecha"]').val();
	}
});
</script>
