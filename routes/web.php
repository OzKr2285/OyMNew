<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    // Route::get('/login', 'Auth\LoginController@login');
});

Route::group(['middleware'=>['auth']],function(){
    
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware' => ['Almacenero']], function () {
        Route::get('/categoria', 'CategoriaController@index');
        Route::post('/categoria/registrar', 'CategoriaController@store');
        Route::put('/categoria/actualizar', 'CategoriaController@update');
        Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
        Route::put('/categoria/activar', 'CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');

        Route::get('/articulo', 'ArticuloController@index');
        Route::post('/articulo/registrar', 'ArticuloController@store');
        Route::put('/articulo/actualizar', 'ArticuloController@update');
        Route::put('/articulo/desactivar', 'ArticuloController@desactivar');
        Route::put('/articulo/activar', 'ArticuloController@activar');
        Route::get('/articulo/buscarArticulo', 'ArticuloController@buscarArticulo');
        Route::get('/articulo/listarArticulo', 'ArticuloController@listarArticulo');

        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');
        Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');

        Route::get('/ingreso', 'IngresoController@index');
        Route::post('/ingreso/registrar', 'IngresoController@store');
        Route::put('/ingreso/desactivar', 'IngresoController@desactivar');
        Route::get('/ingreso/obtenerCabecera', 'IngresoController@obtenerCabecera');
        Route::get('/ingreso/obtenerDetalles', 'IngresoController@obtenerDetalles');

    });

    Route::group(['middleware' => ['Vendedor']], function () {
        Route::get('/cliente', 'ClienteController@index');
        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::post('/cliente/registrar2', 'ClienteController@store2');
        Route::put('/cliente/actualizar', 'ClienteController@update');        
        Route::put('/cliente/actualizar2', 'ClienteController@update2');        
        Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');

        Route::get('/articulo/buscarArticuloVenta', 'ArticuloController@buscarArticuloVenta');
        Route::get('/articulo/listarArticuloVenta', 'ArticuloController@listarArticuloVenta'); 

        Route::get('/venta', 'VentaController@index');
        Route::post('/venta/registrar', 'ventaController@store');
        Route::put('/venta/desactivar', 'ventaController@desactivar');
        Route::get('/venta/obtenerCabecera', 'ventaController@obtenerCabecera');
        Route::get('/venta/obtenerDetalles', 'ventaController@obtenerDetalles');
    });

    Route::group(['middleware' => ['Administrador']], function () {
        
        Route::get('/actividad', 'ActividadController@index');
        Route::get('/actividad/selectact', 'ActividadController@selectAct');
        Route::get('/actividad/selectactred', 'ActividadController@selectActRed');
        Route::post('/actividad/registrar', 'ActividadController@store');
        Route::put('/actividad/actualizar', 'ActividadController@update');
        Route::post('/actividad/eliminar', 'ActividadController@destroy');

        Route::get('/actividadVeh', 'ActividadVehController@index');
        Route::post('/actividadVeh/registrar', 'ActividadVehController@store');
        Route::put('/actividadVeh/actualizar', 'ActividadVehController@update');
        Route::post('/actividadVeh/eliminar', 'ActividadVehController@destroy');

        Route::get('/actividade', 'ActividadEController@index');

        Route::get('/actserv', 'ActServPqrsController@detAct');

        Route::get('/accesorio', 'AccesorioController@index');
        Route::post('/accesorio/registrar', 'AccesorioController@store');
        Route::put('/accesorio/actualizar', 'AccesorioController@update');
        Route::post('/accesorio/eliminar', 'AccesorioController@destroy');

        Route::get('/area', 'AreaController@index');
        Route::post('/area/registrar', 'AreaController@store');
        Route::put('/area/actualizar', 'AreaController@update');
        Route::post('/area/eliminar', 'AreaController@destroy');
        Route::get('/area/selectArea', 'AreaController@selectArea');        

        Route::get('/articulo', 'ArticuloController@index');
        Route::post('/articulo/registrar', 'ArticuloController@store');
        Route::put('/articulo/actualizar', 'ArticuloController@update');
        Route::put('/articulo/desactivar', 'ArticuloController@desactivar');
        Route::put('/articulo/activar', 'ArticuloController@activar');
        Route::get('/articulo/buscarArticulo', 'ArticuloController@buscarArticulo');
        Route::get('/articulo/listarArticulo', 'ArticuloController@listarArticulo');
        Route::get('/articulo/buscarArticuloVenta', 'ArticuloController@buscarArticuloVenta');
        Route::get('/articulo/listarArticuloVenta', 'ArticuloController@listarArticuloVenta');

        Route::get('/cargo', 'CargoController@index');
        Route::post('/cargo/registrar', 'CargoController@store');
        Route::put('/cargo/actualizar', 'CargoController@update');
        Route::post('/cargo/eliminar', 'CargoController@destroy');
        Route::get('/cargo/selectCargo', 'CargoController@selectCargo');

        Route::get('/categoria', 'CategoriaController@index');
        Route::post('/categoria/registrar', 'CategoriaController@store');
        Route::put('/categoria/actualizar', 'CategoriaController@update');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
       
        Route::get('/catserv', 'CatServiciosController@index');
        Route::post('/catserv/registrar', 'CatServiciosController@store');
        Route::put('/catserv/actualizar', 'CatServiciosController@update');
        Route::get('/catserv/selectCategoria', 'CatServiciosController@selectCategoria');

        Route::post('/cierrepqrs/registrar', 'CierrePqrsServController@store');

        Route::get('/cliente', 'ClienteController@index');
        Route::get('/tecnico', 'ClienteController@index2');
        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::post('/cliente/registrarT', 'ClienteController@storeT');
        Route::put('/cliente/actualizar', 'ClienteController@update');
        Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');

        
        Route::post('/demo/registrar', 'demoController@store');

        Route::get('/detactequipo', 'DetActEquipoController@index');
        Route::post('/detactequipo/registrar', 'DetActEquipoController@store');
        Route::put('/detactequipo/actualizar', 'DetActEquipoController@update');
        Route::post('/detactequipo/eliminar', 'DetActEquipoController@destroy');
        Route::get('/detactequipo/detact', 'DetActEquipoController@detAct');
        Route::get('/detactequipo/actE', 'DetActEquipoController@actE');  
                
        Route::get('/detequipo', 'DetEquipoController@index');        
        Route::post('/detequipo/eliminar', 'DetEquipoController@destroy');        
        
        Route::get('/deteqequipo', 'DetInsEquipoController@index');

        Route::get('/detinsumo', 'DetInsEquipoController@index');
        Route::post('/detinsumo/registrar', 'DetInsEquipoController@store');
        Route::put('/detinsumo/actualizar', 'DetInsEquipoController@update');
        Route::get('/detinsumo/detIns', 'DetInsEquipoController@detIns');
        Route::get('/detinsumo/insumose', 'DetInsEquipoController@InsumosE');
        
        Route::get('/detactmto', 'DetActMtoEsController@index');
        Route::get('/detactmto/excel', 'DetActMtoEsController@indexExcel');
        Route::post('/detactmto/registrar', 'DetActMtoEsController@store');

        Route::post('/deteqhtamto/registrar', 'DetEqHtaMtoEsController@store');
        Route::post('/deteinsmto/registrar', 'DetInsMtoEsController@store');
        
        Route::get('/deteqhtamto', 'DetEqHtaMtoEsController@index');

        Route::get('/detactok', 'DetActOkController@index');

        Route::get('/detactmtoet', 'DetActMtoETController@index');
        Route::post('/detactmtoet/registrar', 'DetActMtoETController@store');
        Route::post('/detactmtoet/eliminar', 'DetActMtoETController@destroy');

        Route::get('/deteinsmto', 'DetInsMtoEsController@index');

        Route::get('/detmercado', 'DetMercadoController@index');
        Route::get('/detmercado/detalle', 'DetMercadoController@detMercado');
        Route::post('/detmercado/registrar', 'DetMercadoController@store');
        Route::put('/detmercado/actualizar', 'DetMercadoController@update');
        Route::post('/detmercado/eliminar', 'DetMercadoController@destroy');

        Route::get('/detmtoes', 'DetMtoEsController@equiposMto');   
        Route::get('/detmtoes/excel', 'DetMtoEsController@indexExcel');

        Route::get('/detmtoet', 'DetMtoETController@index');   
        Route::get('/detmtoet2', 'DetMtoETController@index2');   
        Route::put('/detmtoet/actualizar', 'DetMtoETController@update');
        
        // Route::get('/detmtoes/get', 'DetMtoEsController@equiposMto');

        Route::post('/detpasoe/registrar', 'DetPasoEController@store');
        Route::put('/detpasoe/actualizar', 'DetPasoEController@update');
        Route::get('/detpasoe/detalle', 'DetPasoEController@detalle');
        Route::post('/detpasoe/eliminar', 'DetPasoEController@destroy');

        Route::post('/detred/registrar', 'DetRedController@store');
        Route::put('/detred/actualizar', 'DetRedController@update');
        Route::get('/detred/detalle', 'DetRedController@detalle');
        Route::post('/detred/eliminar', 'DetRedController@destroy');
        
        Route::get('/detTpMaterial', 'DetTpMaterialController@detTpMaterial');

        Route::get('/conte', 'DetEquipoEstacionController@contE');
        Route::get('/detequipoestacion/estacion', 'DetEquipoEstacionController@indexEstacion');        
        Route::get('/detequipoestacion/ppal', 'DetEquipoEstacionController@indexExEstacion0');
        Route::get('/detequipoestacion/bypass', 'DetEquipoEstacionController@indexExEstacion1');
        Route::get('/detequipoestacion/etapas', 'DetEquipoEstacionController@indexEtapasEs');
        Route::post('/detequipoestacion/registrar', 'DetEquipoEstacionController@store');
        
        Route::get('/dettpt/selectDetCausal', 'DetCausalController@selectDetCausal');

        Route::get('/diametro/selectDiametro', 'DiametroController@selectDiametro');
        
        Route::get('/dpto/selectDpto', 'DptoController@selectDpto');
        Route::get('/dpto/selectDptoCbx', 'DptoController@selectDptoCbx');
                
        Route::get('/detcausal', 'DetCausalController@index');
        Route::post('/detcausal/registrar', 'DetCausalController@store');
        Route::put('/detcausal/actualizar', 'DetCausalController@update');
        Route::post('/detcausal/eliminar', 'DetCausalController@destroy');
        Route::get('/detcausal/DetCausal', 'DetCausalController@selectDetCausal');            

        Route::get('/detoficinae', 'DetOficinaEController@index');
        Route::post('/detoficinae/registrar', 'DetOficinaEController@store');
        Route::put('/detoficinae/actualizar', 'DetOficinaEController@update');
        Route::post('/detoficinae/eliminar', 'DetOficinaEController@destroy');

        Route::get('/detmtoec', 'DetMtoECController@index');

        Route::get('/detmtoveh', 'DetMtoVehController@index');
        Route::post('/detmtoveh/registrar', 'DetMtoVehController@store');
        Route::post('/detmtoveh/eliminar', 'DetMtoVehController@destroy');

        Route::get('/diametro', 'DiametroController@index');
        Route::post('/diametro/registrar', 'DiametroController@store');
        Route::put('/diametro/actualizar', 'DiametroController@update');
        Route::post('/diametro/eliminar', 'DiametroController@destroy');
        Route::get('/diametro/selectDiametro', 'DiametroController@selectDiametro');

        Route::get('/etapa', 'EtapaController@index');
        Route::post('/etapa/registrar', 'EtapaController@store');
        Route::put('/etapa/actualizar', 'EtapaController@update');
        Route::post('/etapa/eliminar', 'EtapaController@destroy');
        Route::get('/etapa/selectEtapa', 'EtapaController@selectEtapa');            
             
        Route::get('/estacion', 'EstacionController@index');       
        Route::post('/estacion/registrar', 'EstacionController@store');
        Route::put('/estacion/actualizar', 'EstacionController@update');
        Route::post('/estacion/eliminar', 'EstacionController@destroy');
        Route::get('/estacion/selectEstacion', 'EstacionController@selectEstacion');
        Route::get('/estacion/selectNomEstacion', 'EstacionController@selectNomEstacion');        
                
        Route::get('/eqtrabahta', 'EqTrabHtaController@index');

        Route::get('/eqtrabajoe', 'EqTrabajoEController@index');
        Route::get('/eqtrabajoe/eqtrabajo', 'DetEqTrabajoEController@index');
        Route::post('/eqtrabajoe/registrar', 'DetEqTrabajoEController@store');

        Route::get('/equipo', 'EquiposController@index');
        Route::get('/equipo/computo', 'EquiposController@index2');        
        Route::get('/equipo/trabajo', 'EquiposController@index3');        
        Route::get('/equipo/emat', 'EquiposController@index4');        
        Route::get('/equipo/equipos', 'EquiposController@indexEquipos');        
        Route::get('/equipo/computoOficina', 'EquiposController@indexEquipoOfc');        
        Route::get('/equipo/exetapa', 'EquiposController@indexExEtapa');
        Route::post('/equipo/registrar', 'EquiposController@store');
        Route::post('/equipo/registrarcomp', 'EquiposController@storeComp');
        Route::put('/equipo/actualizar', 'EquiposController@update');
        Route::post('/equipo/eliminar', 'EquiposController@destroy');

        // Route::get('/ecomputo/exetapa', 'EquipoComputoController@indexExEtapa');
        // Route::post('/ecomputo/registrar', 'EquipoComputoController@store');
        // Route::put('/ecomputo/actualizar', 'EquipoComputoController@update');
        // Route::post('/ecomputo/eliminar', 'EquipoComputoController@destroy');

        Route::get('/fichared', 'FichaRedController@index');
        Route::post('/fichared/registrar', 'FichaRedController@store');
        Route::put('/fichared/actualizar', 'FichaRedController@update');
        Route::post('/fichared/eliminar', 'FichaRedController@destroy');
        Route::get('/fichared/selectRed', 'FichaRedController@selectRed');

        Route::get('/fichapasoe', 'FichaPasoEController@index');
        Route::post('/fichapasoe/registrar', 'FichaPasoEController@store');
        Route::put('/fichapasoe/actualizar', 'FichaPasoEController@update');
        Route::post('/fichapasoe/eliminar', 'FichaPasoEController@destroy');
        Route::get('/fichapasoe/selectPasoE', 'FichaPasoEController@selectPaso');
        
        Route::get('/fichaveh', 'FichaVehController@index');
        Route::post('/fichaveh/registrar', 'FichaVehController@store');
        Route::put('/fichaveh/actualizar', 'FichaVehController@update');
        Route::post('/fichaveh/eliminar', 'FichaVehController@destroy');
        Route::get('/fichaveh/selectVeh', 'FichaVehController@selectVeh');
        
        Route::get('/horario', 'HorarioController@index');
        Route::post('/horario/registrar', 'HorarioController@store');
        Route::put('/horario/actualizar', 'HorarioController@update');
        Route::post('/horario/eliminar', 'HorarioController@destroy');
        Route::get('/horario/selectHorario', 'HorarioController@selectHorario');

        Route::get('/ingreso', 'IngresoController@index');
        Route::post('/ingreso/registrar', 'IngresoController@store');
        Route::put('/ingreso/desactivar', 'IngresoController@desactivar');
        Route::get('/ingreso/obtenerCabecera', 'IngresoController@obtenerCabecera');
        Route::get('/ingreso/obtenerDetalles', 'IngresoController@obtenerDetalles');

        Route::get('/insumo', 'InsumoController@index');
        Route::post('/insumo/registrar', 'InsumoController@store');
        Route::put('/insumo/actualizar', 'InsumoController@update');
        Route::post('/insumo/eliminar', 'InsumoController@destroy');

        Route::get('/insumoe', 'InsumoEController@index');
        
        Route::get('/linea', 'LineaController@index');
        Route::post('/linea/registrar', 'LineaController@store');
        Route::put('/linea/actualizar', 'LineaController@update');
        Route::post('/linea/eliminar', 'LineaController@destroy');
        Route::get('/linea/selectLinea', 'LineaController@selectLinea');                        
      
        Route::get('/marca', 'MarcaController@index');
        Route::post('/marca/registrar', 'MarcaController@store');
        Route::put('/marca/actualizar', 'MarcaController@update');
        Route::post('/marca/eliminar', 'MarcaController@destroy');
        Route::get('/marca/selectMarca', 'MarcaController@selectMarca');
        
        Route::get('/marcaVeh', 'MarcaVehController@index');
        Route::post('/marcaVeh/registrar', 'MarcaVehController@store');
        Route::put('/marcaVeh/actualizar', 'MarcaVehController@update');
        Route::post('/marcaVeh/eliminar', 'MarcaVehController@destroy');
        Route::get('/marcaveh/selectMarca', 'MarcaVehController@selectMarca');
        
        Route::get('/mercado', 'MercadoController@index');
        Route::post('/mercado/registrar', 'MercadoController@store');
        Route::put('/mercado/actualizar', 'MercadoController@update');
        Route::post('/mercado/eliminar', 'MercadoController@destroy');
        Route::get('/mercado/selectMercado', 'MercadoController@selectTpMercado');

        Route::get('/modelo', 'ModeloController@index');
        Route::post('/modelo/registrar', 'ModeloController@store');
        Route::put('/modelo/actualizar', 'ModeloController@update');
        Route::post('/modelo/eliminar', 'ModeloController@destroy');
        Route::get('/modelo/selectModelo', 'ModeloController@selectModelo');
        
        Route::get('/mpio/selectMpio', 'MpioController@selectMpio');
        Route::get('/mpio/getMpios', 'MpioController@getMpios');

        Route::get('/mto', 'MtoEsController@index');
        Route::get('/mto/fecha', 'MtoEsController@indexFecha');
        
        Route::post('/mto/registrar', 'MtoEsController@store');
        Route::post('/mto/registrar2', 'MtoEsController@store2');
        Route::put('/mto/actualizar', 'MtoEsController@update');
        Route::post('/mto/eliminar', 'MtoEsController@destroy');

        Route::get('/mtoec', 'MtoECController@index');
        Route::post('/mtoec/registrar', 'MtoECController@store');
        Route::put('/mtoec/actualizar', 'MtoECController@update');

        Route::get('/mtoet', 'MtoETController@index');
        Route::post('/mtoet/registrar', 'MtoETController@store');
        Route::post('/mtoet/eliminar', 'MtoETController@destroy');
      
        Route::get('/mtored', 'MtoRedController@index');
        Route::post('/mtored/registrar', 'MtoRedController@store');

        Route::get('/mtoveh', 'MtoVehController@index');
        Route::post('/mtoveh/registrar', 'MtoVehController@store');
        Route::put('/mtoveh/actualizar', 'MtoVehController@update');

        Route::get('/noveh', 'NoVehController@index');
        Route::post('/noveh/registrar', 'NoVehController@store');

        Route::get('/novedad', 'NovedadController@index');
        Route::post('/novedad/registrar', 'NovedadController@store');
        Route::put('/novedad/actualizar', 'NovedadController@update');
        Route::post('/novedad/eliminar', 'NovedadController@destroy');
        Route::get('/novedad/selectNovedad', 'NovedadController@selectNovedad');

        Route::get('/objpqrs', 'ObjPQRSController@index');
        Route::post('/objpqrs/registrar', 'ObjPQRSController@store');
        Route::put('/objpqrs/actualizar', 'ObjPQRSController@update');
        Route::post('/objpqrs/eliminar', 'ObjPQRSController@destroy');
        Route::get('/objpqrs/selectCat', 'ObjPQRSController@selectObjeto');

        Route::get('/oficina', 'OficinaController@index');
        Route::post('/oficina/registrar', 'OficinaController@store');
        Route::put('/oficina/actualizar', 'OficinaController@update');
        Route::post('/oficina/eliminar', 'OficinaController@destroy');
        Route::get('/oficina/selectOficina', 'OficinaController@selectOficina');
        
        Route::post('/persona/registrar', 'UserController@store');
        Route::put('/persona/actualizar', 'UserController@update');
        Route::get('/persona/selectPersona', 'PersonaController@selectPersona');
        Route::get('/persona/selectLider', 'PersonaController@selectLider');
        Route::get('/persona/selectTecnico', 'PersonaController@selectTecnico');
        Route::get('/persona/getusuario', 'PersonaController@getUsuario');        

        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');
        Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');
        Route::get('/proveedor/getProveedor', 'ProveedorController@getProveedor');
                 
        Route::get('/refequipo', 'RefEquipoController@index');
        Route::post('/refequipo/registrar', 'RefEquipoController@store');
        Route::put('/refequipo/actualizar', 'RefEquipoController@update');
        Route::post('/refequipo/eliminar', 'RefEquipoController@destroy');
        Route::get('/refequipo/selectRefEquipo', 'RefEquipoController@selectRefEquipo');
        Route::get('/refequipo/selectRefEquipoComp', 'RefEquipoController@selectRefEquipoComp');

        Route::get('/refmaterial', 'RefMaterialController@index');
        Route::post('/refmaterial/registrar', 'RefMaterialController@store');
        Route::put('/refmaterial/actualizar', 'RefMaterialController@update');
        Route::post('/refmaterial/eliminar', 'RefMaterialController@destroy');
        Route::get('/refmaterial/getRefM', 'RefMaterialController@getRefM');
        Route::get('/refmaterial/getRefInsumo', 'RefMaterialController@getRefInsumo');
        
        Route::get('/detreqinsumo', 'DetReqInsumoController@index');
        Route::put('/detreqinsumo/actualizar', 'DetReqInsumoController@update');

        Route::get('/reqinsumo', 'ReqInsumoController@index');
        Route::post('/reqinsumo/registrar', 'ReqInsumoController@store');

        Route::get('/red', 'RedController@index');
        Route::post('/red/registrar', 'RedController@store');
        Route::put('/red/actualizar', 'RedController@update');
        Route::post('/red/eliminar', 'RedController@destroy');
        Route::get('/red/selectRed', 'RedController@selectRed');
        
        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectRol', 'RolController@selectRol');
        
        Route::get('/servicio', 'ServicioController@index');
        Route::post('/servicio/registrar', 'ServicioController@store');
        Route::put('/servicio/actualizar', 'ServicioController@update');
        Route::post('/servicio/eliminar', 'ServicioController@destroy');
        Route::get('/servicio/getservicio', 'ServicioController@getServicio');
        
        Route::put('/SolServPqrs/registrar', 'SolServPqrsController@store');
        Route::get('/SolServPqrs/getsol', 'SolServPqrsController@getSol');

        Route::get('/tecserv', 'TecServPqrsController@index');
        Route::get('/tecserv/detTecnicos', 'TecServPqrsController@detTecnicos');

        Route::get('/ticketserv', 'TicketServController@index');
        Route::get('/ticketserv/fecha', 'TicketServController@indexFecha');
        Route::get('/ticketserv/estado', 'TicketServController@indexEstado');
        Route::get('/ticketserv/getDispo', 'TicketServController@getDispo');
        Route::get('/ticketserv/getDispoA', 'TicketServController@getDispoA');
        Route::get('/ticketserv/getDispoI', 'TicketServController@getDispoI');
        Route::post('/ticketserv/registrar', 'TicketServController@store');
        Route::put('/ticketserv/actualizar', 'TicketServController@update');

        Route::get('/tpestacion', 'TpEstacionController@index');
        Route::post('/tpestacion/registrar', 'TpEstacionController@store');
        Route::put('/tpestacion/actualizar', 'TpEstacionController@update');
        Route::post('/tpestacion/eliminar', 'TpEstacionController@destroy');
        Route::get('/tpestacion/selectTpEstacion', 'TpEstacionController@selectTpEstacion');
        Route::get('/tpestacion/selectCategoria', 'CategoriaController@selectCategoria');
        
        Route::get('/tpequipo', 'TpEquipoController@index');
        Route::post('/tpequipo/registrar', 'TpEquipoController@store');
        Route::put('/tpequipo/actualizar', 'TpEquipoController@update');
        Route::post('/tpequipo/eliminar', 'TpEquipoController@destroy');
        Route::get('/tpequipo/selectTpEquipo', 'TpEquipoController@selectTpEquipo');
        
        Route::get('/tpmaterial', 'TpMaterialController@index');
        Route::post('/tpmaterial/registrar', 'TpMaterialController@store');
        Route::put('/tpmaterial/actualizar', 'TpMaterialController@update');
        Route::post('/tpmaterial/eliminar', 'TpMaterialController@destroy');
        Route::get('/tpmaterial/selectTpMaterial', 'TpMaterialController@selectTpMaterial');

        Route::get('/tppasoe', 'TpPasoEController@index');
        Route::post('/tppasoe/registrar', 'TpPasoEController@store');
        Route::put('/tppasoe/actualizar', 'TpPasoEController@update');
        Route::post('/tppasoe/eliminar', 'TpPasoEController@destroy');
        Route::get('/tppasoe/selectTpMaterial', 'TpPasoEController@selectTpMaterial');
        
        Route::get('/tpmaterialred/selectTpMaterial', 'TpMaterialRedController@selectTpMaterial');
        
        Route::get('/tptramite', 'TpTramiteController@index');
        Route::post('/tptramite/registrar', 'TpTramiteController@store');
        Route::put('/tptramite/actualizar', 'TpTramiteController@update');
        Route::post('/tptramite/eliminar', 'TpTramiteController@destroy');
        Route::get('/tptramite/selectTpTramite', 'TpTramiteController@selectTpTramite');

        Route::get('/trenetapa/selectTrenEtapa', 'TrenEtapaController@selectTrenEtapa');
  
        Route::get('/user', 'UserController@index');
        Route::get('/user/getImg', 'UserController@getImg');
        Route::get('user/export/', 'UserController@export');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::post('/user/imagen', 'UserController@storeImg');
        Route::put('/user/actualizarPw', 'UserController@updatePw');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');

        Route::get('/venta', 'VentaController@index');
        Route::post('/venta/registrar', 'ventaController@store');
        Route::put('/venta/desactivar', 'ventaController@desactivar');
        Route::get('/venta/obtenerCabecera', 'ventaController@obtenerCabecera');
        Route::get('/venta/obtenerDetalles', 'ventaController@obtenerDetalles');


    });

});

//Route::get('/home', 'HomeController@index')->name('home');
