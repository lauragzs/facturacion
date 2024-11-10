@extends('base')
@section('name')
    Registro y Configuración de Logo
@endsection
@section('content')

<div class="container-fluid" style="max-width: 100%; padding-left: 20px;">
    <div class="row">
        <div class="col-md-6"> <!-- Ajuste para que no esté centrado -->

            <!-- Formulario para cargar el logo -->
            <div class="card" style="border: none; box-shadow: none;">
                <div class="card-header" style="background-color: #f2f2f2; border: none; padding-left: 0;">
                    <h4 class="card-title" style="color: #333;">Logo Institucional</h4>
                </div>
                <div class="card-body" style="padding-left: 0;">
                    <form action="{{ route('impresion.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="logo"><strong>Seleccionar Logo:</strong></label>
                            <input type="file" id="logo" name="logo" accept="image/png, image/jpeg" class="form-control" style="width: 70%;">
                        </div>

                        <div id="contenedorVistaPrevia" style="display: none;">
                            <img id="vistaPrevia" src="#" alt="Vista previa de la imagen" style="max-width: 200px; max-height: 200px;">
                        </div>
                </div>
            </div>

            <!-- Formulario para la configuración de impresión -->
            <div class="card mt-4" style="border: none; box-shadow: none;">
                <div class="card-header" style="background-color: #f2f2f2; border: none; padding-left: 0;">
                    <h4 class="card-title" style="color: #333;">Configuración de Impresión</h4>
                </div>
                <div class="card-body" style="padding-left: 0;">
                        <label><strong>Tipo de Impresión:</strong></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipoimp" id="rollo" value="rollo" checked>
                            <label class="form-check-label" for="rollo">Rollo</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipoimp" id="papel_carta" value="carta">
                            <label class="form-check-label" for="papel_carta">Carta</label>
                        </div>
                        <br><br>
                        <!-- Botón de guardar con estilo exacto e icono -->
                        <button type="submit" class="btn" style="background-color: #007bff; color: white; font-weight: bold; display: flex; align-items: center;">
                            <i class="bi bi-save" style="margin-right: 8px;"></i> Guardar
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Script para la vista previa del logo -->
<script>
    const inputLogo = document.getElementById('logo');
    const vistaPrevia = document.getElementById('vistaPrevia');
    const contenedorVistaPrevia = document.getElementById('contenedorVistaPrevia');

    inputLogo.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const lector = new FileReader();
            lector.onload = function(e) {
                vistaPrevia.src = e.target.result;
                contenedorVistaPrevia.style.display = 'block';
            }
            lector.readAsDataURL(this.files[0]);
        } else {
            vistaPrevia.src = '#';
            contenedorVistaPrevia.style.display = 'none';
        }
    });
</script>

@endsection
