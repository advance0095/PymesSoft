<head>  <link  href="estilo.css" rel="stylesheet"/></head>
<br class="content-header">
    </br></br></br>
	<a href="index.php?view=newingredient" class="btn pull-right btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Agregar Ingrediente</a>
<section id="cOrange">
<h1 id="onsellContent">Ingredientes</h1>
</section>
<section class="content">
<div class="row">


	<div class="col-md-12">
		<div class="clearfix"></div>


<?php

$products = IngredientData::getAllActive();
if(count($products)>0){

	?>

<div class="clearfix"></div>
<div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div>
                                <div class="box-body table-responsive" id="cDark">
                                <table class="table table-bordered table-hover datatable" id="tbOnsell">
	<thead id="pa1">
		<th>Id</th>
		<th>Codigo</th>
		<th>Nombre</th>
		<th>Precio (pz / g / kg)</th>
		<th></th>
	</thead>
	<?php foreach($products as $product):?>
	<tr>
		<td><?php echo $product->id; ?></td>
		<td><?php echo $product->code; ?></td>
		<td><?php echo $product->name; ?></td>
		<td>$ <?php echo number_format($product->price_out,2,".",","); ?></td>
		<td style="width:90px;">
<!--		<a href="index.php?view=hideproduct&id=<?php echo $product->id; ?>" title="Desactivar Producto" class="btn tip btn-sm btn-default"><i class="glyphicon glyphicon-eye-close"></i></a>-->
		<a href="index.php?view=editingredient&id=<?php echo $product->id; ?>" title="Editar Producto" class="btn tip btn-sm btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
		</td>
	</tr>
	<?php endforeach;?>
</table>
</div>
</div>
<div class="clearfix"></div>

	<?php
}else{
	?>
	<div class="jumbotron">
		<h2>No hay Ingredientes</h2>
	</div>
	<?php
}

?> <p class="alert alert-info">Los precios se redondean de acuerdo  a centésimos de pesos. </p>  
<br><br><br><br><br><br><br><br><br><br>
	</div>
</div>
</section>