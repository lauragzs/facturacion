@extends('base')
@section('name')
    Logos y configuración
@endsection
@section('content')
<hr>
<a href="{{ route('impresion.create') }}" class="btn btn-primary" role="button">Añadir <i class="bi bi-plus-square"></i></a>
</div>
<div class="card-body">
<table id="tab" class="table">
<tr>
<th>Impresion</th>
<th>Logo</th>
<th>Acciones</th>
</tr>
@foreach ($impresion as $impresion)
<tr>
<td>{{ $impresion->tipoimp }}</td>
<td><img src="{{ $impresion->logo }}" width="100"></td>
<td>
<form action="{{ route('impresion.destroy', $impresion->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este logo?');">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Eliminar <i class="bi bi-trash"></i></button>
</form>
</td>
</tr>
@endforeach
</table>
</div>
</div>


</div>
</div>
</div>
</main>
</div>
</div>
@endsection
            