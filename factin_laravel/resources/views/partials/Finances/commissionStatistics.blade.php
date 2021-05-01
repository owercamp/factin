
@extends('modules.settingFinance')

@section('info')
    <div class="w-100 d-flex justify-content-around">
        @php
            $yearnow = date('Y');
			$mountnow = date('m');
			$yearfutureOne = date('Y') + 1;
			$yearfutureTwo = date('Y') + 2;			
			$yearfutureThree = date('Y') + 3;
			$yearfutureFour = date('Y') + 4;
        @endphp
    <select name="yearSelected" class="w-15 text-monospace text-dark">
        <option value="{{$yearnow}}" selected>{{$yearnow}}</option>
        <option value="{{ $yearfutureOne }}">{{ $yearfutureOne }}</option>
        <option value="{{ $yearfutureTwo }}">{{ $yearfutureTwo }}</option>
        <option value="{{ $yearfutureThree }}">{{ $yearfutureThree }}</option>
        <option value="{{ $yearfutureFour }}">{{ $yearfutureFour }}</option>
    </select>
    <select name="monthSelected" class="w-15 text-monospace text-dark">
        <option value="Enero">Enero</option>
        <option value="Febrero">Febrero</option>
        <option value="Marzo">Marzo</option>
        <option value="Abril">Abril</option>
        <option value="Mayo">Mayo</option>
        <option value="Junio">Junio</option>
        <option value="Julio">Julio</option>
        <option value="Agosto">Agosto</option>
        <option value="Septiembre">Septiembre</option>
        <option value="Octubre">Octubre</option>
        <option value="Noviembre">Noviembre</option>
        <option value="Diciembre">Diciembre</option>
    </select>
    </div>
    <div class="w-100 d-flex justify-content-center position-absolute">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <div  class="border-info container-fluid" style="width: 900px !important; height: 500px !important">
        <canvas id="CommissionStatic" class="p-4 "></canvas>
    </div>
@endsection

@section('ScriptZone')
    <script>
        let GraphChart;

        // graficas al cambiar el año
        $('select[name=yearSelected]').change(function (e) { 
            e.preventDefault();
            $('.myCanvas').fadeOut();
            $('.spinner').fadeIn();
            if (GraphChart) {
                GraphChart.destroy();
            }
            let year = $('select[name=yearSelected]').val();
            let month = $('select[name=monthSelected]').val();
            $.get("{{route('getCommissionsCollaborator')}}", {year: year, month: month},
                function (objectCommissionCollaborator) {                    
                    const names = objectCommissionCollaborator.map(item => item.col_name);
                    const datas = objectCommissionCollaborator.map(item => item.co_comi);
                    const uniqueNames = new Set(names);
                    const lbl =[], data = [], bgcolors =[], colors = [];
                    for (const iterator of uniqueNames) {
                        lbl.push(iterator);
                    }
                    for (const iterator of datas) {
                        bgcolors.push(getRandomColor());                    
                        data.push(iterator);
                    }
                    for (const iterator of bgcolors) {
                        colors.push(iterator+"59");
                        
                    }
                    function getRandomColor() {
                        var letters = '0123456789ABCDEF';
                        var color = '#';
                        for (var i = 0; i < 6; i++) {
                            color += letters[Math.floor(Math.random() * 16)];                    
                        }
                        return color;
                    }  
                    function Graphics(Graph){
                        GraphChart = new Chart(Graph,{
                            type: 'bar',
                            data: {
                                labels: lbl,
                                datasets:[{
                                    data: data,
                                    borderColor: bgcolors,
                                    borderWidth: 2,
                                    borderRadius: 8,
                                    backgroundColor: colors,
                                    hoverBorderColor: '#FFFFFF',
                                    minBarLength: 1,
                                }],
                            },
                            options:{
                                plugins: {
                                    legend: {
                                        display: false,
                                    },
                                    title: {
                                        display: true,
                                        text: 'COMISIONES DE '+month.toUpperCase()+' DE '+year,
                                        font: {
                                            weight: 'bold',
                                            size: 20,
                                        },
                                        color: '#9aad30',
                                    },
                                    tooltip: {
                                        backgroundColor:'#6c757d',
                                        padding: 8,                                    
                                        titleFont: {
                                            weight: 'bold',
                                            color: '#FFFFFF',
                                            size: 15,
                                        },
                                        titleSpacing: 3,
                                        bodyFont: {
                                            color: '#FFFFFF',
                                            size: 13,
                                        }
                                    }
                                }
                            }
                        })
                    }
                    function RendersGraph(){
                        const Graph = document.getElementById('CommissionStatic').getContext('2d');
                        Graphics(Graph);
                    }
                    RendersGraph()
                }
            );
            $('.myCanvas').fadeIn(2000);
            $('.spinner').fadeOut(2000);
        });
        
        // grafica al cambiar el mes
        $('select[name=monthSelected]').change(function (e) { 
            e.preventDefault();
            $('.spinner').fadeIn();
            $('.myCanvas').fadeOut();
            if (GraphChart) {
                GraphChart.destroy();
            }
            let year = $('select[name=yearSelected]').val();
            let month = $('select[name=monthSelected]').val();
            $.get("{{route('getCommissionsCollaborator')}}", {year: year, month: month},
                function (objectCommissionCollaborator) {                    
                    const names = objectCommissionCollaborator.map(item => item.col_name);
                    const datas = objectCommissionCollaborator.map(item => item.co_comi);
                    const uniqueNames = new Set(names);
                    const lbl =[], data = [], bgcolors =[], colors = [];
                    for (const iterator of uniqueNames) {
                        lbl.push(iterator);
                    }
                    for (const iterator of datas) {
                        bgcolors.push(getRandomColor());                    
                        data.push(iterator);
                    }
                    for (const iterator of bgcolors) {
                        colors.push(iterator+"59");
                        
                    }
                    function getRandomColor() {
                        var letters = '0123456789ABCDEF';
                        var color = '#';
                        for (var i = 0; i < 6; i++) {
                            color += letters[Math.floor(Math.random() * 16)];                    
                        }
                        return color;
                    }  
                    function Graphics(Graph){
                        GraphChart = new Chart(Graph,{
                            type: 'bar',
                            data: {
                                labels: lbl,
                                datasets:[{
                                    data: data,
                                    borderColor: bgcolors,
                                    borderWidth: 2,
                                    borderRadius: 8,
                                    backgroundColor: colors,
                                    hoverBorderColor: '#FFFFFF',
                                    minBarLength: 1,
                                }],
                            },
                            options:{
                                plugins: {
                                    legend: {
                                        display: false,
                                    },
                                    title: {
                                        display: true,
                                        text: 'COMISIONES DE '+month.toUpperCase()+' DE '+year,
                                        font: {
                                            weight: 'bold',
                                            size: 20,
                                        },
                                        color: '#9aad30',
                                    },
                                    tooltip: {
                                        backgroundColor:'#6c757d',
                                        padding: 8,                                    
                                        titleFont: {
                                            weight: 'bold',
                                            color: '#FFFFFF',
                                            size: 15,
                                        },
                                        titleSpacing: 3,
                                        bodyFont: {
                                            color: '#FFFFFF',
                                            size: 13,
                                        }
                                    }
                                }
                            }
                        })
                    }
                    function RendersGraph(){
                        const Graph = document.getElementById('CommissionStatic').getContext('2d');
                        Graphics(Graph);
                    }
                    RendersGraph()
                }
            );
            $('.myCanvas').fadeIn(2000);
            $('.spinner').fadeOut(2000);
        });


        // grafica al cargar la pages
        let date = new Date(), mon = date.getMonth();
        switch (mon) {
            case 0: monSelected = 'Enero'; break;
            case 1: monSelected = 'Febrero'; break;
            case 2: monSelected = 'Marzo'; break;
            case 3: monSelected = 'Abril'; break;
            case 4: monSelected = 'Mayo'; break;
            case 5: monSelected = 'Junio'; break;
            case 6: monSelected = 'Julio'; break;
            case 7: monSelected = 'Agosto'; break;
            case 8: monSelected = 'Septiembre'; break;
            case 9: monSelected = 'Octubre'; break;
            case 10: monSelected = 'Noviembre'; break;
            case 11: monSelected = 'Diciembre'; break;
        }
        let year = $('select[name=yearSelected]').val();
        $('select[name=monthSelected]').val(monSelected);
        let month = $('select[name=monthSelected]').val();
        $.get("{{route('getCommissionsCollaborator')}}", {year: year, month: month},
            function (objectCommissionCollaborator) {                
                const names = objectCommissionCollaborator.map(item => item.col_name);
                const datas = objectCommissionCollaborator.map(item => item.co_comi);
                const namesunique = new Set(names);
                const lbl =[], data = [], bgcolors =[], colors = [];
                for (const iterator of namesunique) {
                    lbl.push(iterator);
                }
                for (const iterator of datas) {
                    bgcolors.push(getRandomColor());                    
                    data.push(iterator);
                }
                for (const iterator of bgcolors) {
                    colors.push(iterator+"59");
                    
                }
                function getRandomColor() {
                    var letters = '0123456789ABCDEF';
                    var color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];                    
                    }
                    return color;
                }               
                function CommissionGraphics(GraphCommission){                     
                    GraphChart = new Chart(GraphCommission,{
                        type: 'bar',
                        data:{
                            labels: lbl,
                            datasets: [{                                
                                data: data,
                                borderColor: bgcolors,
                                borderWidth: 2,
                                borderRadius: 8,
                                backgroundColor: colors,
                                hoverBorderColor: '#FFFFFF',
                                minBarLength: 1,
                            }] 
                        },
                        options:{
                            plugins: {
                                legend: {
                                    display: false,
                                },
                                title: {
                                    display: true,
                                    text: 'COMISIONES DE '+month.toUpperCase()+' DE '+year,
                                    font: {
                                        weight: 'bold',
                                        size: 20,
                                    },
                                    color: '#9aad30',
                                },
                                tooltip: {
                                    backgroundColor:'#6c757d',
                                    padding: 8,                                    
                                    titleFont: {
                                        weight: 'bold',
                                        color: '#FFFFFF',
                                        size: 15,
                                    },
                                    titleSpacing: 3,
                                    bodyFont: {
                                        color: '#FFFFFF',
                                        size: 13,
                                    }
                                }
                            }
                        }
                    })
                }
                function RenderGraph(){
                    const GraphCommission = document.getElementById('CommissionStatic').getContext('2d');
                    CommissionGraphics(GraphCommission);
                }
                RenderGraph();
            }
        );
        $('.myCanvas').fadeIn(2000);
        $('.spinner').fadeOut(2000);
    </script>    
@endsection
