@extends('base')

@section('name')
    Gráficos
@endsection

@section('content')
    <div style="display: flex; justify-content: space-around;">
        <div style="width: 30%;">
            <canvas id="barChart"></canvas>
        </div>
        <div style="width: 30%;">
            <canvas id="pieChart"></canvas>
        </div>
        <div style="width: 30%;">
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
    <script>
        
    </script>
@endsection



