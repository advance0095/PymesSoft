
<head>
<link  href="estilo.css" rel="stylesheet"/>

</head>


<?php
//date_default_timezone_set("America/Hermosillo");
$user = UserData::getById(Session::getUID());
?>



                <section class="content-header">
                       		<h1 class="tituloHome " id="cDark">Panel de Administración</h1>

                </section>

<div class="content">
<div class="row">
	<div class="col-md-12">


		<div class="clearfix"></div>

                    <div class="row">
<section class="col-lg-8">

<div class="" id="cDark">
                                <div class="panel-heading" id="pa1">
                                        Mesas
                                </div>
<table class="table table-bordered table-hover datatable" id="tab">
<thead >
    <th id="cBrown" width="1px">Número</th>
    <th id="cBrown"></th>
</thead>
<?php foreach(ItemData::getAll() as $career):?>
<tr id="textwhite">
    <td id="tbMon"><b><?php echo $career->name; ?></b></td>
    <td >
<?php
$sells = SellData::getAllUnAppliedByItemId($career->id);
?>
<?php if(count($sells)>0):?>
    <?php foreach($sells as $s):?>
        <a href="./?view=onesell&id=<?php echo $s->id;?>" id="mon" class="btn btn-xs btn-default">pedido #: <?php echo $s->id; ?></a>

    <?php endforeach; ?>
<?php endif; ?>

<?php endforeach; ?>

   </td>
</tr>
</table>
</div>


</section>
<section class="col-lg-4">
                            <!-- Map box -->
                            <div class="panel panel-default">
                                <div class="panel-heading" id="pa1">
                                        Meseros
                                </div>
                                <div class="">
                                    <div class="table-responsive ">
                                        <!-- .table - Uses sparkline charts-->
<?php
$meseros = UserData::getAllMeseros();
?>
<?php if(count($meseros)>0):
?>
<table class="table table-striped table-bordered datatable ">
                                            <thead>
                                            <th></th>
                                                <th>Nombre</th>
                                                <th>Total</th>
                                            </thead>
<?php foreach($meseros as $mesero):
$sells = SellData::getAllDayliByMesero($mesero->id);
$total = 0;
if(count($sells)>0){ foreach($sells as $sell){ $total += $sell->total;} }
?>
                                            <tr>
                                            <td><a href="index.php?view=reportbymesero&mesero_id=<?php echo $mesero->id; ?>" class="btn btn-default btn-xs" id="btnmesero"><i class="glyphicon glyphicon-chevron-right"></i></a> </td>
                                                <td><?php echo $mesero->name." ".$mesero->lastname; ?></td>
                                                <td>$ <?php echo number_format($total,2,".",","); ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                                        </table><!-- /.table -->
                                        <?php endif; ?>
                                        </div>
                                </div><!-- /.box-body-->
                            </div>
                            <!-- /.box -->
</section>

                    </div>
<br><br><br><br><br><br><br><br><br><br>
	</div>
</div>
</div>
