<head><link  href="estilo.css" rel="stylesheet"/></head>
<div class="row" >
	<div class="col-md-12"  >
        <section id="cOrange">
	<h1 id="onsellContent">Reabastecer Inventario</h1>
        </section>
        <section >
	<p class="alert alert-info"><b>Buscar producto por nombre o por código:</b></p>

            <form>
		<div class="row">
			<div class="col-md-6">
				<input type="hidden" name="view" value="re">
				<input type="text" name="product" class="form-control">
			</div>
			<div class="col-md-3">
			<button type="submit" class="btn btn-primary" id="btnconf"><i class="glyphicon glyphicon-search"></i> Buscar</button>
			</div>
		</div>
		</form>

	</div>
    </section>

<?php if(isset($_GET["product"])):?>
	<?php
$products = IngredientData::getLike($_GET["product"]);
if(count($products)>0){
	?>

    <section id="cBrown">
<h3 id="tbOnsell">Resultados de la Búsqueda</h3>
    </section>
    <section id="cDark">
<table class="table table-bordered table-hover" id="tbOnsell">
	<thead id="pa1">
		<th>Código</th>
		<th>Nombre</th>
		<th>Unidad</th>
		<th>Precio unitario</th>
		<th>En inventario</th>
		<th>Cantidad</th>
		<th style="width:100px;"></th>
	</thead>
    </section>
	<?php
$products_in_cero=0;
	 foreach($products as $product):
$q= Operation2Data::getQYesF($product->id);
	?>
		<form method="post" action="index.php?view=addtore">
	<tr class="<?php if($q<=$product->inventary_min){ echo "danger"; }?>">
		<td style="width:80px;"><?php echo $product->id; ?></td>
		<td><?php echo $product->name; ?></td>
		<td><?php echo $product->unit; ?></td>
		<td><b>$<?php echo $product->price_out; ?></b></td>
		<td>
			<?php echo $q; ?>
		</td>
		<td>
		<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
		<input type="" class="form-control" required name="q" placeholder="Cantidad de producto ..."></td>
		<td style="width:100px;">
		<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-refresh"></i> Agregar</button>
		</td>
	</tr>
	</form>
	<?php endforeach;?>
</table>

	<?php
}
?>
<br><hr>
<hr><br>
<?php else:
?>

<?php endif; ?>

<?php if(isset($_SESSION["errors"])):?>
<h2>Errores</h2>
<p></p>
<table class="table table-bordered table-hover">
<tr class="danger">
	<th>Código</th>
	<th>Producto</th>
	<th>Mensaje</th>
</tr>
<?php foreach ($_SESSION["errors"]  as $error):
$product = IngredientData::getById($error["product_id"]);
?>
<tr class="danger">
	<td><?php echo $product->id; ?></td>
	<td><?php echo $product->name; ?></td>
	<td><b><?php echo $error["message"]; ?></b></td>
</tr>

<?php endforeach; ?>
</table>
<?php
unset($_SESSION["errors"]);
 endif; ?>


<!--- Carrito de compras :) -->
<?php if(isset($_SESSION["reabastecer"])):
$total = 0;
?>
        <section id="cOrange">
<h2 id="tbOnsell">Lista de Reabastecimiento</h2>
        </section>
        <section id="cDark">
<table class="table table-bordered table-hover" id="tbOnsell">
<thead id="pa1">
	<th style="width:30px;">Codigo</th>
	<th style="width:30px;">Cantidad</th>
	<th style="width:30px;">Unidad</th>
	<th>Producto</th>
	<th style="width:30px;">Precio Unitario</th>
	<th style="width:30px;">Precio Total</th>
	<th ></th>
</thead>

<?php foreach($_SESSION["reabastecer"] as $p):
$product = IngredientData::getById($p["product_id"]);
?>
<tr>
	<td><?php echo $product->id; ?></td>
	<td ><?php echo $p["q"]; ?></td>
	<td><?php echo $product->unit; ?></td>
	<td><?php echo $product->name; ?></td>
    <td><b>$ <?php echo $product->price_out ?></b></td>
    <td><b>$ <?php  $pt = $product->price_out*$p["q"]; $total +=$pt; echo $pt ?></b></td>

	<td style="width:30px;"><a href="index.php?view=clearre&product_id=<?php echo $product->id; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a></td>
</tr>

<?php endforeach; ?>
</table>
        </section>
        <section id="cDark">
<form method="post" class="form-horizontal" id="processsell" action="index.php?view=processre">
<h2 id="cBrown">Resumen</h2>


  <div class="row">
<div class="col-md-6 col-md-offset-6">
<table class="table table-bordered">
<tr>
	<td id="pa1"><p>Subtotal</p></td>
	<td id="tbOnsell"><p><b>$ <?php echo $total*.84; ?></b></p></td>
</tr>
<tr>
	<td id="cBrown"><p>IVA</p></td>
	<td id="tbOnsell"><p><b>$ <?php echo $total*.16; ?></b></p></td>
</tr>
<tr>
	<td id="tbMon"><p>Total</p></td>
	<td id="tbOnsell"><p><b>$ <?php echo $total; ?></b></p></td>
</tr>

</table>
        </section>
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <div class="checkbox">
        <label>
          <input name="is_oficial" type="hidden" value="1">
        </label>
      </div>
    </div>
  </div>
<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <div class="checkbox">
        <label>
		<a href="index.php?view=clearre" class="btn btn-lg btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
        <button class="btn btn-lg btn-primary"><i class="fa fa-refresh"></i> Procesar Reabastecimiento</button>
        </label>
      </div>
    </div>
  </div>
</form>

</div>
</div>

<br><br><br><br><br>
<?php endif; ?>

</div>