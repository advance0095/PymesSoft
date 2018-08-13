<head><link  href="estilo.css" rel="stylesheet"/></head>
<?php
$user = UserData::getById(Session::getUID());
?>
<section class="content">
<div class="row">

	<div class="col-md-12" >
  <div id="textWhite">
		<h2 id="cDark"><i class='glyphicon glyphicon-plus-sign'></i> Agregar Categoria</h2>
    </div>
<br>
<div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>

                                </div>
                                <div class="box-body table-responsive">
<form class="form-horizontal" method="post" action="index.php?view=addcategory" role="form">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-3 control-label">Nombre</label>
    <div class="col-lg-8">
      <input type="text" class="form-control" name="name" id="name" placeholder="Nombre de la categoria">
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-offset-3 col-lg-9">
      <button type="submit" class="btn btn-success"><i class='glyphicon glyphicon-plus-sign'></i> Agregar Categoria</button>
    </div>
  </div>
</form>
</div>
</div>
	</div>
</div>
</section>