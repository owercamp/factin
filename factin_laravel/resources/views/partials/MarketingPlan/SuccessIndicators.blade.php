
@extends('modules.settingMarketing')

@section('info')
	<div class="w-100">		
		@php
            $yearnow = date('Y');
			$mountnow = date('m');
			$yearfutureOne = date('Y') + 1;
			$yearfutureTwo = date('Y') + 2;			
			$yearfutureThree = date('Y') + 3;
			$yearfutureFour = date('Y') + 4;
        @endphp
        <select name="yearSelected" class="w-15 text-monospace text-dark ml-xl-5">            
            <option value="{{ $yearnow }}" selected>{{ $yearnow }}</option>
			<option value="{{ $yearfutureOne }}">{{ $yearfutureOne }}</option>
			<option value="{{ $yearfutureTwo }}">{{ $yearfutureTwo }}</option>
            <option value="{{ $yearfutureThree }}">{{ $yearfutureThree }}</option>
            <option value="{{ $yearfutureFour }}">{{ $yearfutureFour }}</option>
        </select>
	</div>
	<div class="w-100 d-flex justify-content-center position-absolute">
		<div class="spinners">
			<div class="rect1"></div>
			<div class="rect2"></div>
			<div class="rect3"></div>
			<div class="rect4"></div>
			<div class="rect5"></div>
			<div class="rect6"></div>
			<div class="rect7"></div>
		</div>
	</div>
	<div class="border-info container-fluid" style="width: 900px !important; height: 500px !important">
		<canvas id="Indicators" class="p-4 myCanvas"></canvas>
	</div>
@endsection

@section('ScriptZone')
	<script>
		let statusChart;

		$('select[name=yearSelected]').change(function (e) { 
			e.preventDefault();
			$('.spinners').fadeIn();
            $('.myCanvas').fadeOut();
			if (statusChart) {
				statusChart.destroy();
			}
			let year = $('select[name=yearSelected]').val();
			$.get("{{route('getBusinessGraph')}}",
				function (objectBusinessGraphs) {
					let Mes = {'Enero': 0,'Febrero': 0,'Marzo': 0,'Abril': 0,'Mayo': 0,'Junio': 0,'Julio': 0,'Agosto': 0,'Septiembre': 0,'Octubre': 0,'Noviembre': 0,'Diciembre': 0};
					let Approved = [], NonApproved = [], countApproved = 0, countNonApproved = 0;
					for (const key in Mes) {					
						countApproved = 0, countNonApproved = 0;
						for (const iterator of objectBusinessGraphs) {
							let datayear = iterator['bt_date'];
							let status = iterator['bt_status'];
							let years = datayear.split("-");
							let myYear = years[2], myMonth = years[1];
							if (myYear == year && myMonth == key.toLowerCase() && status == "APROBADO") {
								countApproved += 1;
							}else if (myYear == year && myMonth == key.toLowerCase() && status == "NO APROBADO") {
								countNonApproved += 1;
							}
						}
						Approved.push(countApproved);
						NonApproved.push(countNonApproved);
					}
					
					function graphicsStatus(statusGraph) {
						let Month = [ 'Enero', 'Febrero', 'Marzo', 'Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
						statusChart = new Chart(statusGraph,{
							type: 'line',
							data: {
								labels: Month,
								datasets: [
									{
										label: 'RECHAZADO',
										data: NonApproved,
										borderColor: '#dc3545',
										backgroundColor: '#dc354530',						
									},
									{
										label: 'APROBADO',
										data: Approved,
										borderColor: '#28a745',
										backgroundColor: '#28a74530',						
									}
								]
							},
							options: {
								plugins: {
									title: {
										display: true,
										text: 'INDICADORES DEL AÑO '+year,
										padding: 20,
										color: '#007bff8a',
										font: {
											weight: 'bold',
											size: 30,
											family: 'system-ui',
										}
									},
									legend: {
										position: 'bottom',
										labels: {
											boxWidth: 30,
											color: '#000000',
											padding: 20,
										}
									},
									tooltip: {
										mode: 'x',
										padding: 8,
										titleFont: {
											color: '#FFFFFF',
											size: 15,
										},
										backgroundColor: '#6c757d',
										titleSpacing: 3,
										bodyFont: {
											size: 13,
										}
									}
								},
								elements: {
									point: {
										pointStyle: 'star',
										radius: 4,
										color: '#FFF',									
										borderWidth: 2,
										hoverRadius: 8,
										hoverBorderWidth: 2,
									},
									line: {
										fill: true,
									}
								}
							}
						})
					}

					function RenderStatus() {
						const statusGraph = document.getElementById('Indicators').getContext('2d');
						graphicsStatus(statusGraph);
					}
					RenderStatus()
				}
			);
			$('.myCanvas').fadeIn(2000);
			$('.spinners').fadeOut(2000);
		});

		let year = $('select[name=yearSelected]').val();
		$.get("{{route('getBusinessGraph')}}", 
			function (objectBusinessGraph) {				
				let Mes = {'Enero': 0,'Febrero': 0,'Marzo': 0,'Abril': 0,'Mayo': 0,'Junio': 0,'Julio': 0,'Agosto': 0,'Septiembre': 0,'Octubre': 0,'Noviembre': 0,'Diciembre': 0};
				let Approved = [], NonApproved = [], countApproved = 0, countNonApproved = 0;
				for (const key in Mes) {					
					countApproved = 0, countNonApproved = 0;
					for (const iterator of objectBusinessGraph) {
						let datayear = iterator['bt_date'];
						let status = iterator['bt_status'];
						let years = datayear.split("-");
						let myYear = years[2], myMonth = years[1];
						if (myYear == year && myMonth == key.toLowerCase() && status == "APROBADO") {
							countApproved += 1;
						}else if (myYear == year && myMonth == key.toLowerCase() && status == "NO APROBADO") {
							countNonApproved += 1;
						}
					}
					Approved.push(countApproved);
					NonApproved.push(countNonApproved);
				}
				
				function graphicsStatus(statusGraph) {
					let Month = [ 'Enero', 'Febrero', 'Marzo', 'Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
					statusChart = new Chart(statusGraph,{
						type: 'line',
						data: {
							labels: Month,
							datasets: [
								{
									label: 'RECHAZADO',
									data: NonApproved,
									borderColor: '#dc3545',
									backgroundColor: '#dc354530',
									fill: true,
								},
								{
									label: 'APROBADO',
									data: Approved,
									borderColor: '#28a745',
									backgroundColor: '#28a74530',
									fill: true,
								}
							]
						},
						options: {
							plugins: {
								title: {
									display: true,
									text: 'INDICADORES DEL AÑO '+year,
									padding: 20,
									color: '#007bff8a',
									font: {
										weight: 'bold',
										size: 30,
										family: 'system-ui',
									}
								},
								legend: {
									position: 'bottom',
									labels: {
										boxWidth: 30,
										color: '#000000',
										padding: 20,
									}
								},
								tooltip: {
									mode: 'x',
									padding: 8,
									titleFont: {
										color: '#FFFFFF',
										size: 15,
									},
									backgroundColor: '#6c757d',
									titleSpacing: 3,
									bodyFont: {
										size: 13,
									}
								}
							},
							elements: {
								point: {
									pointStyle: 'star',
									radius: 4,
									color: '#FFF',									
									borderWidth: 2,
									hoverRadius: 8,
									hoverBorderWidth: 2,
								},
								line: {
									fill: true,
								}
							}
						}
					})
				}

				function RenderStatus() {
					const statusGraph = document.getElementById('Indicators').getContext('2d');
					graphicsStatus(statusGraph);
				}
				RenderStatus()
			}
		);
		$('.myCanvas').fadeIn(2000);
        $('.spinners').fadeOut(2000);
	</script>
@endsection