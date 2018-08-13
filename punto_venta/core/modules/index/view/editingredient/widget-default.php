<head><link  href="estilo.css" rel="stylesheet"/></head>
<?php
$IngredientData = IngredientData::getById($_GET["id"]);
if($IngredientData!=null):
?>
<section class="content-header">
    <h1><?php echo $IngredientData->name ?> <small>Editar Ingrediente</small></h1>
</section>
<section class="content">
<div class="row">
	<div class="col-md-12">
  <?php if(isset($_COOKIE["prdupd"])):?>
    <p class="alert alert-info">La informacion del producto se ha actualizado exitosamente.</p>
  <?php setcookie("prdupd","",time()-18600); endif; ?>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updateIngredientData" role="form">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Codigo*</label>
    <div class="col-md-6">
      <input type="text" name="code" class="form-control" id="name" value="<?php echo $IngredientData->code; ?>" placeholder="Codigo del Producto">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" class="form-control" id="name" value="<?php echo $IngredientData->name; ?>" placeholder="Nombre del Producto">
    </div>
  </div>

 
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Precio*</label>
    <div class="col-md-6">
      <input type="text" name="price_out" class="form-control" id="price_out" value="<?php echo $IngredientData->price_out; ?>" placeholder="Precio">
    </div>
  </div>
 
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Unidad*</label>
    <div class="col-md-6">
      <input type="text" name="unit" class="form-control" id="unit" value="<?php echo $IngredientData->unit; ?>" placeholder="Unidad del Producto">
    </div>
  </div>
 
  
<p class="alert alert-info">* Campor obligatorios: Nombre, Precio de Salida, Unidad</p>

  <div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">

    <input type="hidden" name="id" value="<?php echo $IngredientData->id; ?>">
      <button type="submit" class="btn  btn-success">Actualizar Producto</button>
    </div>
  </div>
</form>
<script>
  $("#addproduct").submit(function(e){
    if($("#name").val()!="" &&  $("#price_out").val()!="" && $("#unit").val()!="" ){

    }else{
    e.preventDefault();
    alert("No debes dejar campos vacios.");
  }

  });
</script>

<br><br><br><br><br><br><br><br><br>
	</div>
</div>
<?php endif; ?>
</section>