
@extends('modules.settingFinance')

@section('info')
    <div class="w-100">
        @php
            $yearnow = date('Y');
			$mountnow = date('m');
			$yearbeforeTwo = date('Y') - 2;
			$yearbeforeOne = date('Y') - 1;
			$yearfutureOne = date('Y') + 1;
			$yearfutureTwo = date('Y') + 2;			
        @endphp
        <select name="yearSelected" class="w-25 text-monospace text-dark">
            <option value="{{ $yearbeforeTwo }}">{{ $yearbeforeTwo }}</option>
            <option value="{{ $yearbeforeOne }}">{{ $yearbeforeOne }}</option>
            <option value="{{ $yearnow }}" selected>{{ $yearnow }}</option>
			<option value="{{ $yearfutureOne }}">{{ $yearfutureOne }}</option>
			<option value="{{ $yearfutureTwo }}">{{ $yearfutureTwo }}</option>
        </select>
    </div>
    <div class="border-info container-fluid" style="width: 900px !important; height: 500px !important">
        <canvas id="MyStatistics" class="border-secondary border p-4"></canvas>
    </div>
@endsection

@section('ScriptZone')    
    <script>        
        let year = $('select[name=yearSelected]').val();
        let Arr = [];
        $.getJSON("{{route('getChartSales')}}", {data: year},
        function (objectDataMonth) {
            let Mes = {'Enero': 0,'Febrero': 0,'Marzo': 0,'Abril': 0,'Mayo': 0,'Junio': 0,'Julio': 0,'Agosto': 0,'Septiembre': 0,'Octubre': 0,'Noviembre': 0,'Diciembre': 0};
            for (const key in Mes) {
                for (const iterator of objectDataMonth) {
                    let month = iterator['bo_month'];
                    let value = iterator['bo_sale_month'];
                    if(key == month)
                    {
                        Mes[key] = value;
                    }
                }
            } 
            for (const key in Mes) {
                Arr.push(Mes[key]);
            }           
            function sales(ctx){            
            let Month = [ 'Enero', 'Febrero', 'Marzo', 'Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
                const chart = new Chart(ctx,{
                    type:'line',
                    data: {
                        labels: Month,
                        datasets: [
                            {
                                label:'Ventas',
                                data: Arr,
                                borderColor: '#007bff',
                                backgroundColor: '#007bff8a',
                                tension: 0.3,
                            }
                        ]
                    },
                    options:{
                        title:{
                            display: true,
                            text: 'VENTAS DEL AÑO',
                            fontSize: 20,
                            padding: 20,
                            fontColor: '#6c757d',
                        }
                    },
                    legend:{
                        position: 'bottom',
                    }
                });
            }
            function render() {
                const ctx = document.querySelector('#MyStatistics').getContext("2d");
                sales(ctx);
            }
            render();
            } 
        );
    </script>
@endsection