<?php
//provando
//use Illuminate\Routing\Route;



Route::get('/api/{any}', function () {
    return view('welcome');
})->where('any', '.*');;



Route::get('/','seguridad\LoginController@index')->name('login');
Route::post('/','seguridad\LoginController@login')->name('login_post');
Route::get('/logout','seguridad\LoginController@logout')->name('logout');
//Route::get('/registrar','AdminController@registrar')->name('registrar');
Route::get('/graficos', 'ChartControllers\PulseChartController@index')->name('chart');
Route::post('/graficos', 'ChartControllers\PulseChartController@cargarC3')->name('cargarChart');

//reset passwords

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');



//Rutas autenticadas de sala
Route::prefix('Sala')->namespace('sala')->middleware('auth')->group(function(){
    Route::get('/Cambiodeprecios','SalaController@index')->name('cambiodeprecios');
    Route::post('/Cambiodeprecios','SalaController@filtrarcambioprecios')->name('filtrarcambioprecios');
    Route::get('/GiftCard','SalaController@indexGiftCard')->name('GiftCardVenta');
    Route::get('/GiftCardVoucher','SalaController@generarVoucher')->name('GiftCardVoucherIndex');
    Route::post('/GiftCardVoucher','SalaController@generarVoucher')->name('GiftCardVoucher');

    Route::get('/GiftCardCaja','SalaController@CargaTarjetasCaja')->name('CargaTarjetasCaja');
    Route::post('/GiftCardCaja','SalaController@CargarTarjetasCodigos')->name('postCargarCaja');
    Route::post('/VentasGiftcards','SalaController@VenderGiftcardSala')->name('venderGiftCardSala');

    Route::get('/OrdenesDeDiseño','SalaController@OrdenesDeDiseño')->name('OrdenesDeDiseño');
    Route::post('/GuardarOrdenesDeDiseño','SalaController@GuardarOrdenesDeDiseño')->name('GuardarOrdenesDeDiseño');




});


//rutas globales autenticadas
Route::prefix('api')->middleware('auth')->group(function(){

    Route::get('/', 'ApiController@LoadReact')->name('apiReact');
});



Route::prefix('publicos')->middleware('auth')->group(function(){

    Route::get('/','InicioController@index')->name('Publico');
    Route::post('/mensaje','InicioController@store')->name('mensaje');
    Route::post('/ProductosNegativos','publico\PublicoController@filtarProductosNegativos')->name('filtrar');
    Route::get('/ProductosNegativos','publico\PublicoController@filtarProductosNegativos')->name('ProductosNegativos');
    Route::get('/ProductosNegativos2','publico\PublicoController@listarFiltrados')->name('filtro2');
    Route::get('/Informacion','publico\PublicoController@informacion')->name('informacion');
    Route::post('/updatemensaje', 'publico\PublicoController@updatemensaje')->name('updatemensaje');
    Route::get('/ConsultaSaldoenvio','publico\PublicoController@ConsultaSaldo')->name('ConsultaSaldo');
    Route::post('/ConsultaSaldoenvio', 'publico\PublicoController@ConsultaSaldoenvio')->name('ConsultaSaldoenvio');
//------------------------EXPORTACIONES------------------------------------//


Route::post('/excel','Admin\exports\ExportsController@exportExcelproductosnegativos')->name('excelProductosNegativos');
Route::post('/Excelcambioprecio','Admin\exports\ExportsController@exportexcelcambioprecios')->name('excelcambioprecios');
});

//rutas de registro
Route::prefix('auth')->middleware('auth','SuperAdmin')->group(function(){
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

});


//rutas de administrador
Route::prefix('admin')->namespace('Admin')->middleware('auth','SuperAdmin')->group(function(){


    //----------------------------------LISTADO DE DATOS------------------//
    Route::get('/','AdminController@index')->name('inicioAdmin');
    Route::get('/ListaUsuarios','EditarUserController@index')->name('ListarUser');
    Route::post('/update', 'EditarUserController@update')->name('update');
    Route::get('/CuadroMando', 'AdminController@CuadroDeMando')->name('cuadroMando');
    Route::get('/ProductosPorMarca','AdminController@ProductosPorMarca')->name('ProductosPorMarca');
    Route::post('/ProductosPorMarca/fetch','AdminController@fetch')->name('ProductosPorMarca.fetch');
    Route::post('/ProductosPorMarcafiltrar','AdminController@ProductosPorMarcafiltrar')->name('ProductosPorMarcafiltrar');
    Route::get('/Ordenesdecompra','AdminController@ordenesdecompra')->name('ordenesdecompra');
    Route::get('/Desviacion','AdminController@porcentajeDesviacion')->name('porcentaje');
    Route::get('/comprassegunprov','AdminController@comprassegunprov')->name('comprassegunprov');
    Route::get('/Productos','AdminController@Productos')->name('productos');
    Route::get('VentasProdutos','AdminController@IndexVentaProductos')->name('ventaProd');
    Route::get('/VentasPorHora','AdminController@DocumentosPorHoraIndex')->name('ComprasPorHoraIndex');
    Route::get('compraProdutos','AdminController@IndexCompraProductos')->name('compraProd');
    Route::get('/ComprasPorHora','AdminController@DocumentosPorHoraIndex')->name('ComprasPorHoraIndex');
    Route::get('/Proyeccion','AdminController@ProyeccionIndex')->name('proyeccion');
    Route::get('/areaproveedor','AdminController@areaproveedor')->name('areaproveedor');
    Route::get('/areaproveedorfamilia','AdminController@areaproveedorfamilia')->name('areaproveedorfamilia');
    // Route::get('/movimientoinventario','AdminController@movimientoinventario')->name('movimientoinventario');
    // Route::post('/movimientoinventario','AdminController@filtrarmovimientoinventario')->name('filtrarmovimientoinventario');
    // Route::post('/ajustemovimientoinventario','AdminController@ajustemovimientoinventario')->name('ajustemovimientoinventario');
    Route::get('/consultafacturaboleta','AdminController@consultafacturaboleta')->name('consultafacturaboleta');
    Route::post('/filtrarconsultafacturaboleta','AdminController@filtrarconsultafacturaboleta')->name('filtrarconsultafacturaboleta');
    Route::get('controlipmac','AdminController@controlipmac')->name('controlipmac');
    Route::post('/actualizaripmac', 'AdminController@actualizaripmac')->name('actualizaripmac');
    Route::get('agregaripmac','AdminController@agregaripmac')->name('agregaripmac');
    Route::post('/agregaripmac','AdminController@insertaripmac')->name('agregaripmac');
    Route::get('cuponesescolares','AdminController@cuponesescolares')->name('cuponesescolares');
    Route::post('/actualizarcupon', 'AdminController@actualizarcupon')->name('actualizarcupon');
    Route::get('/costos','AdminController@costos')->name('costos');
    Route::post('/costosfiltro','AdminController@costosfiltro')->name('costosfiltro');
    Route::get('/stocktiemporeal','AdminController@stocktiemporeal')->name('stocktiemporeal');
    Route::get('/ListarOrdenesDiseño','AdminController@ListarOrdenesDiseño')->name('ListarOrdenesDiseño');
    Route::get('/ListarOrdenesDisenoDetalle/{idOrdenesDiseno}','AdminController@ListarOrdenesDisenoDetalle')->name('ListarOrdenesDisenoDetalle');
    Route::post('/ListarOrdenesDisenoDetalleedit', 'AdminController@ListarOrdenesDisenoDetalleedit')->name('ListarOrdenesDisenoDetalleedit');
    Route::post('/ListarOrdenesDisenoDetalleedittermino', 'AdminController@ListarOrdenesDisenoDetalleedittermino')->name('ListarOrdenesDisenoDetalleedittermino');
    Route::get('/descargaordendiseno/{id}', 'AdminController@descargaordendiseno')->name('descargaordendiseno');

    Route::get('/MantencionClientes','AdminController@MantencionClientes')->name('MantencionClientes');
    Route::post('/MantencionClientesFiltro','AdminController@MantencionClientesFiltro')->name('MantencionClientesFiltro');




    //------------------------------FILTROS Y OTRAS COSAS XD-----------------------------------------------//
    Route::post('/Desviacion','AdminController@filtrarDesviacion')->name('filtrarDesv');
    Route::post('/Productospormarca','AdminController@filtarProductospormarca')->name('filtrarpormarca');
    Route::post('/Productos','AdminController@FiltrarProductos')->name('filtrarProductos');
    Route::post('VentasProdutos','AdminController@VentaProductosPorFechas')->name('ventaProdFiltro');
    Route::post('/VentasPorHora','AdminController@DocumentosPorHora')->name('ComprasPorHora');
    Route::post('ComprasProdutos','AdminController@CompraProductosPorFechas')->name('compraProdFiltro');
    Route::post('/ComprasPorHora','AdminController@DocumentosPorHora')->name('ComprasPorHora');
    Route::post('/Proyeccion','AdminController@ProyeccionDeCompras')->name('proyeccionFiltro');




    //---------------------Exportaciones----------------------------------------------//

    Route::get('/pdf/{NroOrden}','exports\ExportsController@exportpdf')->name('pdf.orden');
    Route::get('/ExcelOC/{NroOrden}','exports\ExportsController@exportExelOrdenDeCompra')->name('ordenExcel');
    Route::get('/pdfprov/{NroOrden}','exports\ExportsController@exportpdfprov')->name('pdf.ordenprov');
    Route::post('/excelproductospormarca','exports\ExportsController@exportExcelproductospormarca')->name('excelproductopormarca');
    Route::post('/ExcelDesv','exports\ExportsController@exportExcelDesviacion')->name('excelDesviacion');

    //---------------------Exportaciones ----------------------//

    Route::get('/export', 'exports\MyController@export')->name('export');
    Route::get('/importarordendecompra', 'exports\MyController@importExportView')->name('cargaroc');
    Route::post('/import', 'exports\MyController@import')->name('import');
    Route::post('/importdetalle', 'exports\MyController@importdetalle')->name('importdetalle');
    Route::get('/descargadetalle', 'exports\MyController@descargadetalle')->name('descargadetalle');
    Route::get('/descargaencabezado', 'exports\MyController@descargaEncabezado')->name('descargaencabezado');


    //----------------------- Rutas de Roles y permisos ----------------------------//


    Route::get('/Roles','LaravelPermission\RolesController@index')->name('Roles');
    Route::get('/ShowRoles','LaravelPermission\RolesController@ShowRoles')->name('ShowRoles');
    Route::post('/AddRol','LaravelPermission\RolesController@AddRol')->name('AddRol');
    Route::get('/ShowPermisos/{id}','LaravelPermission\RolesController@ShowPermisos')->name('ShowPermisos');
    Route::post('/AddPermisoRol','LaravelPermission\RolesController@AddPermisoRol')->name('AddPermisoRol');
    Route::get('/ShowUsers','LaravelPermission\RolesController@ShowUsers')->name('ShowUsers');
    Route::get('/ShowRolesUser/{id}','LaravelPermission\RolesController@ShowRolesUser')->name('ShowRolesUser');
    Route::post('/AddRolPermiso','LaravelPermission\RolesController@AddRolUser')->name('');

    // inventario

    Route::get('/movimientoinventario','AdminController@movimientoinventario')->name('movimientoinventario');
    Route::post('/movimientoinventario','AdminController@filtrarmovimientoinventario')->name('filtrarmovimientoinventario');
    Route::post('/ajustemovimientoinventario','AdminController@ajustemovimientoinventario')->name('ajustemovimientoinventario');


    // api jumpseller

    Route::get('/jumpsellerEmpresas','Jumpseller\BluemixEmpresas\SincronizacionProductosController@index')->name('index.jumpsellerEmpresas');
    Route::get('/SincronizarProductos','Jumpseller\BluemixEmpresas\SincronizacionProductosController@sincronizarProductos')->name('sincronizar');
    Route::get('/CarritoDeCompras','Jumpseller\BluemixEmpresas\GenerarCarritoController@index')->name('CreacionCarrito.index');
    Route::get('/CarritoDeComprasSearch','Jumpseller\BluemixEmpresas\GenerarCarritoController@BuscarCotizacion')->name('GenerarCarrito.search');
    Route::post('/CrearCarrito','Jumpseller\BluemixEmpresas\GenerarCarritoController@CrearCarrito')->name('GenerarCarrito.store');

    Route::get('/jumpsellerWeb','Jumpseller\BluemixWeb\SincronizacionProductosWebController@index')->name('index.jumpsellerWeb');
    Route::get('/SincronizarProductosWeb','Jumpseller\BluemixWeb\SincronizacionProductosWebController@sincronizarProductos')->name('sincronizarWeb');

    Route::get('/actualizacionProductosWeb','Jumpseller\BluemixWeb\ActualizacionProductosWebController@index')->name('index.ActualizacionProductos');

    //Anulacion de documentos
    Route::get('/Anulacion-De-Documentos','AnulacionDocumentosController@index')->name('AnulacionDocs');
    Route::post('/AnularDocs','AnulacionDocumentosController@store')->name('AnulacionDocs.store');


});




Route::prefix('Giftcard')->namespace('GiftCard')->middleware('auth','GiftCard')->group(function(){

    Route::get('/Folios','GiftCardController@index')->name('indexGiftCard');
    Route::get('/Folios2/{cant}','GiftCardController@vistafolios')->name('Vfolios');
    Route::post('/Folios2','GiftCardController@generarGiftCard')->name('generarGiftCard');

    Route::get('/imprimir/{giftCreadas}','GiftCardController@imprimir')->name('imprimir');
    Route::get('/Load/{Monto}','GiftCardController@CargarTablaCodigos')->name('cargarCodigos');
    Route::get('/VentasGiftCards','GiftCardController@IndexVentasGiftCard')->name('indexVentas');
    Route::get('/LoadVenta/{Monto}','GiftCardController@CargarTablaCodigosVenta')->name('cargarCodigosVenta');
    Route::get('/Venta','GiftCardController@CargarVenta')->name('ventaGiftCard');

    Route::get('/Activacion2.0','GiftCardController@Activacion2')->name('Activacion2.0');




    Route::get('/VentaEmpresa','GiftCardController@VentaEmpresaIndex')->name('VentaEmpresa');
    Route::post('/VentaEmpresa','GiftCardController@VentaEmpresaFiltro')->name('FiltroVentaEmpresa');
    Route::get('/ListarVenta','GiftCardController@ListarGet');
    Route::post('/ListarVenta','GiftCardController@ListarFiltroVentaEmpresa')->name('ListaVentaEmpresa');
    Route::post('/VentasGiftcards','GiftCardController@VenderGiftcard')->name('venderGiftCard');


    Route::post('/Venta','GiftCardController@CargarVenta')->name('ventaGiftCard');
    Route::post('/BloqueoGiftCards','GiftCardController@BloqueoTarjetas')->name('BloqueoConfirmacion');


    Route::get('/Activacion3.0','GiftCardController@Activacion3')->name('Activacion3.0');

    //prueba ruta redirect para las giftcard activadas
    Route::get('/Activacion3.0/{desde}/{hasta}','GiftCardController@Activacion3Redirect')->name('ActivacionRedirect');

    Route::post('/Activacion3.0','GiftCardController@FiltrarActivacion3')->name('filtroActivacion3');
    Route::post('/Activacion2.0','GiftCardController@ActivacionPost')->name('Activacion2Post');
    Route::post('/Activar3','GiftCardController@ActivarRango')->name('ActivarRango');


    //gifcard

    Route::get('/ConsumoTarjeta','GiftCardController@vistaconsumotarjeta')->name('consumotarj');
    Route::post('/ConsumoTarjeta','GiftCardController@filtrarcambiotarjeta')->name('filtrartarjeta');
    Route::get('/BloqueoGiftCards','GiftCardController@BloqueoTarjetasIndex')->name('Bloqueo');
    Route::post('/BloqueoGiftCards','GiftCardController@filtrarbloqueo')->name('filtrartarjetabloqueo');
    Route::post('/BloqueoGiftCardsrango','GiftCardController@filtrarbloqueorango')->name('filtrartarjetabloqueorango');
    Route::post('/BloqueoGif','GiftCardController@bloqueotrajeta')->name('bloqueartarjetacard');
    Route::get('/detalle/{fk_cargos}','GiftCardController@detalletarjeta')->name('detalletarjeta');

});




