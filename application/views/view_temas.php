<script type="text/javascript">
    $(document).ready(function() {
        $('#noticias').dataTable({
            "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
          });
      });
</script>

<div id="container">
  <h2 align="center">Temas</h2>
  <?php
    if(isset($_GET['save'])){
      echo '<div class="alert alert-success text-center">La Información  se Almaceno Correctamente</div>';
    }
    if(isset($_GET['delete'])){
      echo '<div class="alert alert-warning text-center">La Información  se ha Eliminado Correctamente</div>';
    }
    if(isset($_GET['update'])){
      echo '<div class="alert alert-success text-center">La Información  se Actualizo Correctamente</div>';
    }
  ?>
  <center>
    <table id="noticias" border="0" cellpadding="0" cellspacing="0" class="pretty">
      <thead>
        <tr>
        <th>ACCION</th>
        <th>CODIGO</th>
        <th>NOMBRE</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $contador = 0;
          if(!empty($temas)){
            foreach($temas as $tema){
              echo '<tr>';
              echo '<td>'
        ?>
              <a href="<?php echo base_url();?>index.php/temas/editar/<?php echo $tema->temcod;?>/" class="btn btn-success">Editar</a>
              <a href="<?php echo base_url();?>index.php/temas/eliminar/<?php echo $tema->temcod ?>" class="btn btn-danger">Eliminar</a>
              <?php
              echo '</td>';
              echo '<td>'.$tema->temcod.'</td>';
              echo '<td>'.$tema->temnom.'</td>';
              echo '</tr>';
         	  }
         }
        ?>
      </tbody>
    </table>
  </center>
</div>
