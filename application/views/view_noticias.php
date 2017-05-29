<script type="text/javascript">
    $(document).ready(function() {
        $('#noticias').dataTable({
            "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
          });
      });
</script>

<div id="container">
  <h2 align="center">Noticias</h2>
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
        <th>TITULO</th>
        <th>ENCABEZADO</th>
        <th>CUERPO</th>
        <th>FECHA</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(!empty($noticias)){
            foreach($noticias as $noticia){
              echo '<tr>';
              echo '<td>'
        ?>
              <a href="<?php echo base_url();?>index.php/noticias/editar/<?php echo $noticia->notcod;?>/" class="btn btn-success">Editar</a>
              <a href="<?php echo base_url();?>index.php/noticias/eliminar/<?php echo $noticia->notcod ?>" class="btn btn-danger">Eliminar</a>
              <?php
              $noticia->notbod = substr($noticia->notbod, 0, 100)."...";
              echo '</td>';
              echo '<td>'.$noticia->nottit.'</td>';
              echo '<td>'.$noticia->notenc.'</td>';
              echo '<td>'.$noticia->notbod.'</td>';
              echo '<td>'.$noticia->notfec.'</td>';
              echo '</tr>';
         	  }
         }
        ?>
      </tbody>
    </table>
  </center>
</div>
