@extends('base')

@section('content')
<div class="container">
    <h2>Gráficos de Información</h2>

    <div>
        <h3>Cantidad de Productos por Unidad</h3>
        <canvas id="productosPorUnidadChart"></canvas>
    </div>

    <div>
        <h3>Precio Promedio por Unidad</h3>
        <canvas id="precioPromedioPorUnidadChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de Productos por Unidad
    const productosPorUnidadData = @json($productosPorUnidad);
    const productosPorUnidadChart = new Chart(document.getElementById('productosPorUnidadChart'), {
        type: 'bar',
        data: {
            labels: productosPorUnidadData.map(item => item.unidad),
            datasets: [{
                label: 'Cantidad de Productos',
                data: productosPorUnidadData.map(item => item.total),
                backgroundColor: 'rgba(54, 162, 235, 0.6)', // Azul claro
                borderColor: 'rgba(54, 162, 235, 1)', // Azul oscuro
                borderWidth: 3,
                barThickness: 40,
                hoverBackgroundColor: 'rgba(54, 162, 235, 0.8)',
                hoverBorderColor: 'rgba(54, 162, 235, 1)',
                // Agregar efectos de sombra para simular 3D
                shadowOffsetX: 4,
                shadowOffsetY: 4,
                shadowBlur: 10,
                shadowColor: 'rgba(0, 0, 0, 0.3)',
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        display: false,
                    },
                    ticks: {
                        font: {
                            size: 14,
                            weight: 'bold',
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [5, 5],
                    },
                    ticks: {
                        font: {
                            size: 14,
                            weight: 'bold',
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 16,
                            weight: 'bold',
                        },
                        padding: 20
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    bodyFont: {
                        weight: 'bold',
                    }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuad',
            }
        }
    });

    // Gráfico de Precio Promedio por Unidad
    const precioPromedioPorUnidadData = @json($precioPromedioPorUnidad);
    const precioPromedioPorUnidadChart = new Chart(document.getElementById('precioPromedioPorUnidadChart'), {
        type: 'bar',
        data: {
            labels: precioPromedioPorUnidadData.map(item => item.unidad),
            datasets: [{
                label: 'Precio Promedio',
                data: precioPromedioPorUnidadData.map(item => item.promedio),
                backgroundColor: 'rgba(255, 159, 64, 0.6)', // Naranja
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 3,
                barThickness: 40,
                hoverBackgroundColor: 'rgba(255, 159, 64, 0.8)',
                hoverBorderColor: 'rgba(255, 159, 64, 1)',
                // Sombra para dar efecto 3D
                shadowOffsetX: 4,
                shadowOffsetY: 4,
                shadowBlur: 10,
                shadowColor: 'rgba(0, 0, 0, 0.3)',
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        display: false,
                    },
                    ticks: {
                        font: {
                            size: 14,
                            weight: 'bold',
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [5, 5],
                    },
                    ticks: {
                        font: {
                            size: 14,
                            weight: 'bold',
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 16,
                            weight: 'bold',
                        },
                        padding: 20
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    bodyFont: {
                        weight: 'bold',
                    }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuad',
            }
        }
    });
</script>
@endsection
