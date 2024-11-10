<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ContribuyenteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TipoDocumentoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ImpresionController;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\DocumentosFController;
use App\Http\Controllers\DocumentoSectorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AsignarController;
use Spatie\Permission\Models\Role;


Route::get('/asignar',[AsignarController::class,'index'])->name('asignar');
Route::get('/asignar_{id}_editar',[AsignarController::class,'edit'])->name('asignar.edit');
Route::put('/asignar_{id}',[AsignarController::class,'update'])->name('asignar.update');

Route::get('/factura/{id}/pdf', [FacturaController::class, 'generarFacturaPDF'])->name('factura.generarPDF');
// PAL ADMIN
Route::group(['middleware' => ['role:Administrador']],function () {

    Route::get('/sucursal', [SucursalController::class, 'index'])->name('sucursal');
    Route::post('/sucursal', [SucursalController::class, 'store'])->name('sucursal.store');
    Route::delete('/sucursal/{id}', [SucursalController::class, 'destroy'])->name('sucursal.destroy');
    Route::put('/sucursal/{id}', [SucursalController::class, 'update'])->name('sucursal.update');
    
    Route::get('/documentof', [DocumentosFController::class, 'index'])->name('documentosf');
    Route::post('/documentof', [DocumentosFController::class, 'store'])->name('documentosf.store');
    Route::delete('/documentof/{id}', [DocumentosFController::class, 'destroy'])->name('documentosf.destroy');
    Route::put('/documentof/{id}', [DocumentosFController::class, 'update'])->name('documentosf.update');
    
    
    Route::get('/documentos', [DocumentoSectorController::class, 'index'])->name('documentos');
    Route::post('/documentos', [DocumentoSectorController::class, 'store'])->name('documentos.store');
    Route::delete('/documentos/{id}', [DocumentoSectorController::class, 'destroy'])->name('documentos.destroy');
    Route::put('/documentos/{id}', [DocumentoSectorController::class, 'update'])->name('documentos.update');
    Route::get('/documentos/crear',[DocumentoSectorController::class,'create'])->name('documentos.create');
    
    Route::resource('actividad', ActividadController::class);
    
    
    Route::get('/unidad', [UnidadController::class, 'index'])->name('unidad');
    Route::post('/unidad', [UnidadController::class, 'store'])->name('unidad.store');
    Route::delete('/unidad/{id}', [UnidadController::class, 'destroy'])->name('unidad.destroy');
    Route::put('/unidad/{id}', [UnidadController::class, 'update'])->name('unidad.update');
    
    Route::get('/tipodoc', [TipoDocumentoController::class, 'index'])->name('tipodoc');
    Route::post('/tipodoc', [TipoDocumentoController::class, 'store'])->name('tipodoc.store');
    Route::delete('/tipodoc/{id}', [TipoDocumentoController::class, 'destroy'])->name('tipodoc.destroy');
    Route::get('/tipodoc/{id}/ver', [TipoDocumentoController::class, 'show'])->name('tipodoc.show');
    Route::put('/tipodoc/{id}', [TipoDocumentoController::class, 'update'])->name('tipodoc.update');
    
    
    Route::get('/dependencia', [DependenciaController::class, 'index'])->name('dependencia');
    Route::post('/dependencia', [DependenciaController::class, 'store'])->name('dependencia.store');
    Route::delete('/dependencia/{id}', [DependenciaController::class, 'destroy'])->name('dependencia.destroy');
    Route::put('/dependencia/{id}', [DependenciaController::class, 'update'])->name('dependencia.update');
    
});


// PA LOS AUTENTICAUS
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    //ROL SPATIE
    Route::get('/rol',[RoleController::class,'index'])->name('rol');
    /*ruta show  */
    Route::get('/rol/{id}/ver', [RoleController::class, 'show'])->name('rol.show');
    /*RUTA DE ELIMINAR */
    Route::delete('/rol/{id}', [RoleController::class, 'destroy'])->name('rol.destroy');
    /*ruta PARA CREAR */
    Route::get('/rol/crear',[RoleController::class,'create'])->name('rol.create');
    /*RUTA PARA GUARDAD LOS NUEVOS DATOS */
    Route::post('/rol',[RoleController::class,'store'])->name('rol.store');
    /*RUTA EDITAR PARA MOSTRAR EL FORMULARIO PARA EDITAR */
    Route::get('/rol/{id}/editar',[RoleController::class,'edit'])->name('rol.edit');
    /*RUTA UPTADE PARA ACTUALIZAR LO EDITADO */
    Route::put('/rol/{id}',[RoleController::class,'update'])->name('rol.update');

    
    Route::get('/dashboard', function () {
        return view('home');
    })->middleware('auth', 'verified')->name('home');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/grafico', [HomeController::class, 'grafico'])->name('chart');
    Route::get('/grafico-roles', [RolController::class, 'grafico'])->name('chart.roles');

});

// PA CONTRIBUYENTE Y ADMIN
Route::middleware(['auth', 'role:Contribuyente|Administrador'])->group(function () {

    Route::get('/factura', [FacturaController::class, 'index'])->name('factura');
    Route::get('/factura/crear',[FacturaController::class,'create'])->name('factura.create');
    Route::post('/factura', [FacturaController::class, 'store'])->name('factura.store');
    
Route::get('/clientes/buscarPorNit', [ClienteController::class, 'buscarPorNit'])->name('cliente.buscarPorNit');
Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente');
Route::get('/cliente/crear', [ClienteController::class, 'create'])->name('cliente.create');
Route::post('/cliente', [ClienteController::class, 'store'])->name('cliente.store');
Route::get('/cliente/{id}/ver', [ClienteController::class, 'show'])->name('cliente.show');
Route::get('/cliente/{id}/editar', [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/cliente/{id}', [ClienteController::class, 'update'])->name('cliente.update');

Route::get('/impresion', [ImpresionController::class, 'index'])->name('impresion');
Route::get('/impresion/crear', [ImpresionController::class, 'create'])->name('impresion.create');
Route::post('/impresion', [ImpresionController::class, 'store'])->name('impresion.store');
Route::delete('/impresion/{id}', [ImpresionController::class, 'destroy'])->name('impresion.destroy');
Route::get('/producto', [ProductoController::class, 'index'])->name('producto.index');
Route::post('/producto', [ProductoController::class, 'store'])->name('producto.store');
Route::delete('/producto/{id}', [ProductoController::class, 'destroy'])->name('producto.destroy');
Route::put('/producto/{id}', [ProductoController::class, 'update'])->name('producto.update');
Route::get('/actividades/load', [ProductoController::class, 'loadActivities'])->name('actividades.load');

});


require __DIR__.'/auth.php';





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/pdf', function(){
    $pdf = PDF::loadView('actividad');
    return $pdf->stream();
})->name('pdf');



