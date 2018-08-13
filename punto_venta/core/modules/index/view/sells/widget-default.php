<head>
    <link  href="estilo.css" rel="stylesheet"/>

</head>

<section class="content-header" id="cBrown">
			<h1 id="onsellContent"><i class='fa fa-shopping-cart' ></i> Ventas</h1>
</section>
<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="clearfix"></div>
<br>
<div class="btn-group">

<a class="btn pull-right btn-warning" href="index.php?view=sells&t=0"> <?php if(isset($_GET["t"]) && $_GET["t"]=="0" ):?><i class="glyphicon glyphicon-ok-sign"></i> <?php endif; ?> Pendientes</a>
<a class="btn pull-right btn-success" href="index.php?view=sells&t=1"> <?php if(isset($_GET["t"]) && $_GET["t"]=="1" ):?><i class="glyphicon glyphicon-ok-sign"></i> <?php endif; ?> Finalizados</a>
<!-- <a class="btn btn-default" href="index.php?view=sells&t=3"> <?php if(isset($_GET["t"]) && $_GET["t"]=="3" ):?><i class="glyphicon glyphicon-ok-sign"></i> <?php endif; ?> fecha</a>-->

<a class="btn pull-right btn-info" href="index.php?view=sells"> <?php if(!isset($_GET["t"])):?><i class="glyphicon glyphicon-ok-sign"></i> <?php endif; ?>Todos</a>
</div>

<div class="print">
<a href="index.php?view=printReport" class="btn pull-right btn-success"><i class="glyphicon glyphicon"></i> Imprimir ticket</a>

</div>
<?php 

$ses=Session::getUID();

$u = UserData::getById($ses);
  $user = $u->name." ".$u->lastname;
  $adminu = $u->is_admin;
  $cajerou =  $u->is_cajero;
  $meserou =  $u->is_mesero;



 ?>

<?php
$page = 1;
if(isset($_GET["page"])){
	$page=$_GET["page"];
}
$limit=10;
if(isset($_GET["limit"]) && $_GET["limit"]!="" && $_GET["limit"]!=$limit){
	$limit=$_GET["limit"];
}
$products=null;

    $date = '2018-03-10 20:21:51';
    if(!isset($_GET["t"])){
$products = SellData::getAll();
}else  if(isset($_GET["t"]) && $_GET["t"]=="0" ){
$products = SellData::getAllUnApplied();
}
else  if(isset($_GET["t"]) && $_GET["t"]=="1" ){
$products = SellData::getAllApplied();
}




//if(!isset($_GET["t"]=="" && $ses==1)){
//$products = SellData::getAll();


if(count($products)>0){


	?>

<div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div>
                                <div class="box-body table-responsive" id="cDark">
<table id="tbOnsell" class="table table-bordered table-hover datatable">
	<thead id="pa1">
		<th></th>
		<th>Id</th>
		<th>Mesa</th>
		<th>Mesero</th>
		<th>Productos</th>
		<th>Total</th>
		<th>Status</th>
		<th>Fecha</th>
	</thead>
	<?php foreach($products as $sell):?>

	<tr>
		<td style="width:30px;"><a href="index.php?view=onesell&id=<?php echo $sell->id; ?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i></a></td>
	<td style="width:60px;">#<?php echo $sell->id;?></td>
	<td style="width:60px;"><?php echo $sell->item_id;?></td>
		<td>

<?php
$mesero = UserData::getById($sell->mesero_id);
echo $mesero->name." ".$mesero->lastname;
?>
</td>
		<td>

<?php
$operations = OperationData::getAllProductsBySellId($sell->id);
	$rx = 0;
	foreach($operations as $operation){
		$rx += $operation->q;
	}
echo $rx;
?></td>
		<td>

<?php
$total=0;
	foreach($operations as $operation){
		$product  = $operation->getProduct();
		$total= $operation->q*$product->price_out;
	
		

	}

		echo "<b>$ ".number_format($total)."</b>";
	    
		

?>			

		</td>
		<td style="width:100px;"><center><?php  
		if($sell->is_applied) { echo "<p class='label label-primary'><i class='glyphicon glyphicon-ok'></i> Finalizado</p>"; }
		else { echo "<p class='label label-warning'><i class='glyphicon glyphicon-time'></i> Pendiente</p>"; }
		 ?>
		 </center></td>
		<td style="width:180px;"><?php echo $sell->created_at; ?></td>
	</tr>

<?php endforeach; ?>

</table>
</div>
</div>
<div class="btn-group pull-right">
</div>

<div class="clearfix"></div>

	<?php
}else{
	?>
	<div class="jumbotron">
		<h2>No hay ventas</h2>
		<p>No se han agregado ventas.</p>
	</div>
	<?php
}

?>
<br><br><br><br><br><br><br><br><br><br>
	</div>
</div>
</section>