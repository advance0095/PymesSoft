<head><link  href="estilo.css" rel="stylesheet"/>
</head>
<?php
$user = UserData::getById(Session::getUID());
$grades = CategoryData::getAllActive();
?>
<section class="content-header">
    </br>  </br>  </br>
<a href='index.php?view=newcategory' class='btn btn-default pull-right btn-success'><i class='glyphicon glyphicon-plus-sign'></i> Agregar Categoria</a>
    <div id="textWhite">
      <h1 id="cDark" >Categorias</h1>
      </div>
</section>
<section class="content">
<div class="row">

  <div class="col-md-12">
  <?php if(isset($_COOKIE["gradeupdated"])):?>
      <p class="alert alert-success"><i class='glyphicon glyphicon-ok-sign'></i> La categoria <b><?php echo $_COOKIE["gradeupdated"]; ?></b> ha sido actualizada exitosamente.</p>
    <?php 
    setcookie("gradeupdated","",time()-18600);
    endif; ?>

  <?php if(isset($_COOKIE[""])):?>
      <p class="alert alert-danger"><i class='glyphicon glyphicon-minus-sign'></i> La categoria <b><?php  ?></b> ha sido eliminada exitosamente.</p>
    <?php 

    endif; ?>
    <?php if(isset($_COOKIE["gradeadded"])):?>
      <p class="alert alert-info"><i class='glyphicon glyphicon-ok-sign'></i> La categoria <b><?php echo $_COOKIE["gradeadded"]; ?></b> ha sido agregada exitosamente.</p>
    <?php 
    setcookie("gradeadded","",time()-18600);
    endif; ?>
<?php if(count($grades)>0):?>

<div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div>
                                <div class="box-body table-responsive" id="cDark">
<table class="table table-bordered table-hover datatable" id="tbOnsell">
<thead id="pa1">
  <th>Nombre</th>
  <th></th>
</thead>
<?php foreach($grades as $career):?>
<tr>
  <td><b><?php echo $career->name; ?></b></td>
  <td style="width:90px;" id="tbMon">
    <a href="#" id="del-<?php echo $career->id; ?>" class="btn btn-sm btn-danger"><i class='glyphicon glyphicon-trash'></i></a>
<!--    <a href="index.php?view=hidecategory&id=<?php echo $career->id; ?>" class="btn btn-sm btn-default tip" title="Desactivar Categoria"><i class='glyphicon glyphicon-eye-close'></i></a> -->
<script>
  $("#del-<?php echo $career->id?>").click(function(){
    c = confirm("Seguro quieres eliminar ??");
    if(c==true){
      window.location = "index.php?view=delcategory&id=<?php echo $career->id; ?>";
    }
  });
</script>
  </td>
</tr>
<?php endforeach; ?>
</table>
</div>
</div>
<?php else: // no careers ?>
<div class="jumbotron">
  <h2><i class="glyphicon glyphicon-minus-sign"></i> No hay categorias </h2>
</div>
<?php endif; ?>
  </div>
</div>
</section>