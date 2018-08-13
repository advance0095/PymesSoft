<head><link  href="estilo.css" rel="stylesheet"/>

<style>

    body{}
</style>
</head>
<?php
if(isset($_GET["product_id"])):
$product = IngredientData::getById($_GET["product_id"]);
$operations = Operation2Data::getAllByProductId($product->id);
?>
<div class="row">
	<div class="col-md-12" id="cBrown">
	<!--
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="report/history-word.php?id=<?php echo $product->id;?>">Word 2007 (.docx)</a></li>
  </ul>
</div>
-->
<h1 id="onsellcontent"><?php echo $product->name;; ?> <small id="textwhite">- Historial</small></h1>
	</div>
	</div>

<div class="row">


	<div class="col-md-4">


	<?php
$itotal = Operation2Data::GetInputQYesF($product->id);

	?>
<div class="jumbotron" >
<center>
	
	<div id="textWhite"><h2 id="verde">Entradas</h2></div>
	<h1><?php echo $itotal; ?></h1>
</center>
</div>

<br>
<?php
?>

</div>

	<div class="col-md-4">
	<?php
$total = Operation2Data::GetQYesF($product->id);


	?>
<div class="jumbotron">
<center>
	<div id="textWhite"><h2 id="cOrange">Disponibles</h2></div></center>
	<h1><?php echo $total; ?></h1>
</center>
</div>
<div class="clearfix"></div>
<br>
<?php
?>

</div>

	<div class="col-md-4">


	<?php
$ototal = -1*Operation2Data::GetOutputQYesF($product->id);

	?>

<div class="jumbotron" >
<center>
	<div id="textWhite"><h2 id="cRed">Salidas</h2></div>
	<h1><?php echo $ototal; ?></h1>
</center>
</div>
        </section>


<div class="clearfix"></div>
<br>
<?php
?>

</div>






</div>
<div class="row">
	<div class="col-md-12" id="cDark">
		<?php if(count($operations)>0):?>
			<table class="table table-bordered table-hover" id="tbOnsell">
			<thead id="pa1">
			<th></th>
			<th>Cantidad</th>
			<th>Tipo</th>
			<th>Fecha</th>
			<th></th>
			</thead>
			<?php foreach($operations as $operation):?>
			<tr>
			<td></td>
			<td><?php echo $operation->q; ?></td>
			<td><?php echo $operation->getOperationType()->name; ?></td>
			<td><?php echo $operation->created_at; ?></td>
			<td id="tbmon" style="width:40px;"><a href="#" id="oper-<?php echo $operation->id; ?>" class="btn tip btn-xs btn-danger" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a> </td>
			<script>
			$("#oper-"+<?php echo $operation->id; ?>).click(function(){
				x = confirm("Estas seguro que quieres eliminar esto ??");
				if(x==true){
					window.location = "index.php?view=deleteoperation&ref=history&pid=<?php echo $operation->product_id;?>&opid=<?php echo $operation->id;?>";
				}
			});

			</script>
			</tr>
			<?php endforeach; ?>
			</table>
		<?php endif; ?>
	</div>
</div>

<?php endif; ?>