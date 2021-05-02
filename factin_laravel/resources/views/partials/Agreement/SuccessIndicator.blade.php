

@extends('modules.settingAgreement')

@section('info')
	<div class="w-100 d-flex flex-row-reverse">
		@php
			$yearnow = date('Y');
			$mountnow = date('m');
			$yearfutureOne = date('Y') + 1;
			$yearfutureTwo = date('Y') + 2;			
			$yearfutureThree = date('Y') + 3;
			$yearfutureFour = date('Y') + 4;
		@endphp
		<select name="yearSelected" class="w-15 text-monospace text-dark ml-5">
			<option value="{{ $yearnow }}" selected>{{ $yearnow }}</option>
			<option value="{{ $yearfutureOne }}">{{ $yearfutureOne }}</option>
			<option value="{{ $yearfutureTwo }}">{{ $yearfutureTwo }}</option>
            <option value="{{ $yearfutureThree }}">{{ $yearfutureThree }}</option>
            <option value="{{ $yearfutureFour }}">{{ $yearfutureFour }}</option>
		</select>
	</div>
	<div class="w-100 d-flex justify-content-center position-absolute">
		<div class="bossdot">
			<div class="dot1"></div>
			<div class="dot2"></div>
		</div>
	</div>
	<div class="border-info container-fluid" style="width: 700px !important; height: 670px !important">
		<canvas id="contractGrap" class="p-4 myCanvas" style="width: 400px !important; height: 300px !important"></canvas>
	</div>
@endsection

@section('ScriptZone')
	<script>
		let ContractChart;

		$('select[name=yearSelected]').change(function (e) { 
			e.preventDefault();
			$('.myCanvas').fadeOut();
            $('.bossdot').fadeIn();
			if (ContractChart) {
				ContractChart.destroy();
			}
			let year = $('select[name=yearSelected]').val();
			$.get("{{route('getContractIndicators')}}", {data: year},
				function (objectContractIndicator) {					
					let Mes = {'Enero': 0,'Febrero': 0,'Marzo': 0,'Abril': 0,'Mayo': 0,'Junio': 0,'Julio': 0,'Agosto': 0,'Septiembre': 0,'Octubre': 0,'Noviembre': 0,'Diciembre': 0};
					let CountContract = 0;
					let countArray = [],bgcolors = [], borderColors = [];
					for (const key in Mes) {					
						CountContract= 0;
						borderColors.push(getRandomColor());
						for (const iterator of objectContractIndicator) {
							let datayear = iterator['con_ini'];
							let years = datayear.split('-');
							let myYear = years[2], myMonth = years[1];
							if ( myYear == year && myMonth == key.toLowerCase() ) {
								CountContract +=1
							}
						}
						countArray.push(CountContract);
					}
					for (const iterator of borderColors) {
						bgcolors.push(iterator+"59");
					}
					function getRandomColor() {
						var letters = '0123456789ABCDEF';
						var color = '#';
						for (var i = 0; i < 6; i++) {
							color += letters[Math.floor(Math.random() * 16)];                    
						}
						return color;
					} 
					function graphicsContract(GraphContract) {
						let Month = [ 'Enero', 'Febrero', 'Marzo', 'Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
						ContractChart = new Chart(GraphContract,{
							type: 'polarArea',
							data: {
								labels: Month,
								datasets: [
									{
										data: countArray,
										borderColor: borderColors,
										backgroundColor: bgcolors,
									}
								]
							},
							options: {
								plugins: {
									title: {
										display: true,
										text: 'INDICADORES CONTRATACIONES AÑO '+year,
										padding: 15,
										color: '#007bff8a',
										font: {
											weight: 'bold',
											size: 30,
											family: 'system-ui',
										}
									},
									legend: {
										labels: {
											boxWidth: 30,
											color: 'black',
											padding: 20,
										}
									},
									tooltip: {
										padding: 8,
										bodyFont: {
											size: 15,
										},
										backgroundColor: '#6c757d',
									}
								}
							}
						})
					}
					function renderContract() {
						const GraphContract = document.getElementById('contractGrap').getContext('2d');
						graphicsContract(GraphContract);
					}
					renderContract()
				}
			);
			$('.myCanvas').fadeIn(2000);
            $('.bossdot').fadeOut(2000);
		});

		// grafica de inicio al carga la page
		let year = $('select[name=yearSelected]').val();
		$.get("{{route('getContractIndicators')}}", {data: year},
			function (objectContractIndicator) {				
				let Mes = {'Enero': 0,'Febrero': 0,'Marzo': 0,'Abril': 0,'Mayo': 0,'Junio': 0,'Julio': 0,'Agosto': 0,'Septiembre': 0,'Octubre': 0,'Noviembre': 0,'Diciembre': 0};
				let CountContract = 0;
				let countArray = [],bgcolors = [], borderColors = [];
				for (const key in Mes) {					
					CountContract= 0;
					borderColors.push(getRandomColor());
					for (const iterator of objectContractIndicator) {
						let datayear = iterator['con_ini'];
						let years = datayear.split('-');
						let myYear = years[2], myMonth = years[1];
						if ( myYear == year && myMonth == key.toLowerCase() ) {
							CountContract +=1
						}
					}
					countArray.push(CountContract);
				}
				for (const iterator of borderColors) {
					bgcolors.push(iterator+"59");
				}
				function getRandomColor() {
                    var letters = '0123456789ABCDEF';
                    var color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];                    
                    }
                    return color;
                } 				
				function graphicsContract(GraphContract) {
					let Month = [ 'Enero', 'Febrero', 'Marzo', 'Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
					ContractChart = new Chart(GraphContract,{
						type: 'polarArea',
						data: {
							labels: Month,
							datasets: [
								{
									data: countArray,
									borderColor: borderColors,
									backgroundColor: bgcolors,
								}
							]
						},
						options: {
							plugins: {
								title: {
									display: true,
									text: 'INDICADORES CONTRATACIONES AÑO '+year,
									padding: 15,
									color: '#007bff8a',
									font: {
										weight: 'bold',
										size: 30,
										family: 'system-ui',
									}
								},
								legend: {
									labels: {
										boxWidth: 30,
										color: 'black',
										padding: 20,
									}
								},
								tooltip: {
									padding: 8,
									bodyFont: {
										size: 15,
									},
									backgroundColor: '#6c757d',
								}
							}
						}
					})
				}
				function renderContract() {
					const GraphContract = document.getElementById('contractGrap').getContext('2d');
					graphicsContract(GraphContract);
				}
				renderContract()
			}
		);
		$('.myCanvas').fadeIn(2000);
        $('.bossdot').fadeOut(2000);
	</script>
@endsection
