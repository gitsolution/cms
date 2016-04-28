@extends('layouts.app')
@section('content')
<?php 
	if(isset($document) && isset($hitsdocument)) 
	{
	}
?>

 			@can('graficas')
 				<div class="row">
					<div class="col-lg-12">
                    	<h1 class="page-header">Graficas</h1>
                	</div>
            	</div>
            @endcan

            <div class="row">

            @can('nuevos-comentarios')
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">                   
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $totalComentarios;?></div>
                                    <div>¡Nuevos comentarios!</div>
                                </div>
                            </div>
                        </div>
                   
                        <a href="#">                        
                            <div class="panel-footer">
	                            <span class="pull-left">
	                            {!!link_to('admin/comments', 'Ver detalles',array('class'=>'')) !!}
	                            </span>
                            	<span class="pull-right">
                            	{!!link_to('admin/comments', '',array('class'=>'fa fa-arrow-circle-right')) !!}
                            	</span> 
                            </div>
                         </a>

                    </div>
                </div>
            @endcan

            @can('nuevos-usuario')
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $totalUsuario;?></div>
                                    <div>Usuarios Nuevos</div>
                                </div>
                            </div>
                        </div>

                        <a href="#">                        
                            <div class="panel-footer">
	                            <span class="pull-left">
	                            	{!!link_to('/usuario', 'Ver detalles',array('class'=>'')) !!}  
	                            </span>
                            	<span class="pull-right">
                            		{!!link_to('/usuario', '',array('class'=>'fa fa-arrow-circle-right')) !!} 
                            	</span> 
                            </div>
                         </a>
                    </div>
                </div>
            @endcan

            @can('total-albums')
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-picture-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $totalAlbums;?></div>
                                    <div>Total de albums</div>
                                </div>
                            </div>
                        </div>

                        <a href="#">                        
                            <div class="panel-footer">
	                            <span class="pull-left">
	                            	 {!!link_to('admin/media', 'Ver detalles',array('class'=>'')) !!}
	                            </span>
                            	<span class="pull-right">
                            	 {!!link_to('admin/media', '',array('class'=>'fa fa-arrow-circle-right')) !!}
                            	</span> 
                            </div>
                         </a>
                    </div>
                </div>
            @endcan
            </div>


	<script src="../graficas/Chart.js"></script>
<br>
@can('graficas')
<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart-o fa-fw"></i>Visitas en documentos
				</div>
				 		<canvas id="canvas"></canvas>	
			</div>
		</div>
	 
		<div class="col-md-6"> 
			<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i>Visitas en seccciones
			</div>
			 	<canvas id="canvas2"></canvas>				
			</div>
		</div>

		<div class="col-md-6"> 
			<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i>Visitas en categorias
			</div>
				<canvas id="canvas3"></canvas>
			</div>
		</div>

		<div class="col-md-6"> 
			<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i>Visitas en Galerias
			</div>
				<canvas id="canvas4"></canvas>
			</div>
		</div>

		<div class="col-md-6"> 
			<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i>Visitas en Imagenes
			</div>
				<canvas id="canvas5" height="100px"></canvas>
			</div>
		</div>

		<div class="col-md-6"> 
			<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i>Visitas en Directorios
			</div>
				<canvas id="canvas6"></canvas>
			</div>
		</div>

		<div class="col-md-6"> 
			<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i>Visitas en Archivos
			</div>
				<canvas id="canvas7"></canvas>
			</div>
		</div>

</div>
@endcan

	<script>
		var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
		var lineChartData = {
			labels : [
			<?php echo $document;
			?>],
			datasets : [
				{
					label: "Hits",
					fillColor : "rgba(37, 119, 181,0.2)",
					strokeColor : "none",
					pointColor : "rgba(215, 40, 40, 0.9)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [

					]
				},
				{
					label: "Hits",
					fillColor : "rgba(37, 119, 181,0.6)",
					strokeColor : "none",
					pointColor : "#2e8ece",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [
					<?php
						echo $hitsdocument;
					?>]
				}
			]

		}

		var lineChartData2 = {
			labels : [
			<?php echo $section;
			?>],
			datasets : [
				{
					label: "Hits",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [

					]
				},
				{
					label: "Hits",
					fillColor : "#27ae60",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [
					<?php
						echo $hitssection;
					?>]
				}
			]

		}

		var lineChartData3 = {
			labels : [
			<?php echo $categori;
			?>],
			datasets : [
				{
					label: "Hits",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [

					]
				},
				{
					label: "Hits",
					fillColor : "rgba(189,197,199,0.7)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [
					<?php
						echo $hitscategories;
					?>]
				}
			]

		}

		var lineChartData4 = {
			labels : [
			<?php echo $album;
			?>],
			datasets : [
				{
					label: "Hits",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [

					]
				},
				{
					label: "Hits",
					fillColor : "rgba(230,142,34,0.9)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [
					<?php
						echo $hitsalbum;
					?>]
				}
			]

		}

		var lineChartData5 = {
			labels : [
			<?php echo $picture;
			?>],
			datasets : [
				{
					label: "Hits",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [

					]
				},
				{
					label: "Hits",
					fillColor : "rgba(44,59,80,0.9)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [
					<?php
						echo $hitspicture;
					?>]
				}
			]

		}

		var lineChartData6 = {
			labels : [
			<?php echo $directory;
			?>],
			datasets : [
				{
					label: "Hits",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [

					]
				},
				{
					label: "Hits",
					fillColor : "rgba(44,59,80,0.9)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [
					<?php
						echo $hitsdirectory;
					?>]
				}
			]

		}

		var lineChartData7 = {
			labels : [
			<?php echo $file;
			?>],
			datasets : [
				{
					label: "Hits",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [

					]
				},
				{
					label: "Hits",
					fillColor : "rgba(44,59,80,0.9)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [
					<?php
						echo $hitsFile;
					?>]
				}
			]

		}
		
		window.onload = function()
		{
			var ctx = document.getElementById("canvas").getContext("2d");
			var ctx2 = document.getElementById("canvas2").getContext("2d");
			var ctx3 = document.getElementById("canvas3").getContext("2d");
			var ctx4 = document.getElementById("canvas4").getContext("2d");
			var ctx5 = document.getElementById("canvas5").getContext("2d");
			var ctx5 = document.getElementById("canvas5").getContext("2d");
			var ctx5 = document.getElementById("canvas5").getContext("2d");

			window.myLine = new Chart(ctx).Line(lineChartData, {
				responsive: true
			});

			window.myLine = new Chart(ctx2).Line(lineChartData2, {
				responsive: true
			});

			window.myLine = new Chart(ctx3).Line(lineChartData3, {
				responsive: true
			});

			window.myLine = new Chart(ctx4).Line(lineChartData4, {
				responsive: true
			});

			window.myLine = new Chart(ctx5).Line(lineChartData5, {
				responsive: true
			});

			window.myLine = new Chart(ctx6).Line(lineChartData6, {
				responsive: true
			});	
			window.myLine = new Chart(ctx7).Line(lineChartData7, {
				responsive: true
			});

		}

	</script>

@stop
