//PEDIDOS
function buscarCliente() {
    let documentoid = document.getElementById("documentoid").value
    $.ajax({
        type: "POST",
        url: base_url + "Pedidos/buscarCliente",
        data: { documentoid: documentoid },
        cache: false,
        dataType: "json",
        success: function (data) {
            if (data == "error") {
                Swal.fire({
                    title: "El cliente no existe",
                    icon: "error",
                    timer: 2000
                })
            } else {
                document.getElementById("razon_social").value = data['razon_social']
                document.getElementById("cliente_email").value = data['cliente_email']
                document.getElementById("tipo_documento").value = data['tipo_documento']
                document.getElementById("complementoid").value = data['complementoid']
                document.getElementById("id_cliente").value = data['id_cliente']
            }
        }

    })
}

function buscarProducto() {
    let codigo = document.getElementById("codigo").value
    $.ajax({
        type: "POST",
        url: base_url + "Pedidos/buscarProducto",
        data: { codigo: codigo },
        cache: false,
        dataType: "json",
        success: function (data) {
            document.getElementById("codigoProductoSin").value = data['codigoProductoSin']
            document.getElementById("nombre_producto").value = data['nombre_producto']
            document.getElementById("descripcion_corta").value = data['descripcion_corta']
            document.getElementById("medidaSin").value = data['medidaSin']
            document.getElementById("precio_venta").value = data['precio_venta']
            document.getElementById("cantidad").value = "1.00"
            document.getElementById("descProducto").value = "0.00"
            document.getElementById("sTotal").value = data['precio_venta']
        }
    })
}

function calcularstotal() {
    let totalPedido = 0
    for(var i = 0; i < arrayProductos.length; i++){
        totalPedido += parseFloat(arrayProductos[i].subTotal)
    }
    document.getElementById("subtotal").value = totalPedido.toFixed(2)
    let descAdicional = parseFloat(document.getElementById("descAdicional").value)
    document.getElementById("descAdicional").value = descAdicional.toFixed(2)
    document.getElementById("total").value = (totalPedido - descAdicional).toFixed(2)
    let precio_venta = parseFloat(document.getElementById("precio_venta").value)
    let cantidad = parseFloat(document.getElementById("cantidad").value)
    let descProducto = parseFloat(document.getElementById("descProducto").value)
    document.getElementById("precio_venta").value = precio_venta.toFixed(2)
    document.getElementById("sTotal").value = ((precio_venta * cantidad) - descProducto).toFixed(2)
}

var arrayProductos = []
function cargarProductos() {
    let actEconomica = document.getElementById("actEconomica").value
    let codigoProductoSin = document.getElementById("codigoProductoSin").value
    let codigo = document.getElementById("codigo").value
    let nombre_producto = document.getElementById("nombre_producto").value
    let cantidad = document.getElementById("cantidad").value
    let medidaSin = document.getElementById("medidaSin").value
    let precio_venta = document.getElementById("precio_venta").value
    let descProducto = document.getElementById("descProducto").value
    let sTotal = document.getElementById("sTotal").value

    let detallesobj = {
        actividadEconomica: actEconomica,
        codigoProductoSin: codigoProductoSin,
        codigoProducto: codigo,
        descripcion: nombre_producto,
        cantidad: cantidad,
        unidadMedida: medidaSin,
        precioUnitario: precio_venta,        
        montoDescuento: descProducto,
        subTotal: sTotal,
        numeroSerie: null,
        numeroImei: null
    }
    arrayProductos.push(detallesobj)
    armarPedido()

    document.getElementById("codigo").value=""
    document.getElementById("codigoProductoSin").value=""
    document.getElementById("nombre_producto").value=""
    document.getElementById("medidaSin").value = ""
    document.getElementById("descripcion_corta").value = ""
    document.getElementById("precio_venta").value = ""
    document.getElementById("cantidad").value = ""
    document.getElementById("descProducto").value = ""
    document.getElementById("sTotal").value = ""
    $("#codigo").focus()
}

var detalles = document.getElementById("detalles")
function armarPedido() {
    detalles.innerHTML=""
    arrayProductos.forEach((detalle) => {
        let fila = document.createElement("tr")
        fila.innerHTML = '<td>' + detalle.codigoProducto + '</td>' +
            '<td>' + detalle.descripcion + '</td>' +
            '<td>' + detalle.precioUnitario + '</td>' +
            '<td>' + detalle.cantidad + '</td>' +
            '<td>' + detalle.montoDescuento + '</td>' +
            '<td>' + detalle.subTotal + '</td>'
        let tdBorrar = document.createElement("td")
        let btnEliminar = document.createElement("button")
        btnEliminar.classList.add("btn", "btn-danger")
        btnEliminar.innerHTML = '<i class="fas fa-trash-alt"></i>'
        btnEliminar.onclick = () => {
            eliminarProducto(detalle.codigoProducto)
        }
        tdBorrar.appendChild(btnEliminar)
        fila.appendChild(tdBorrar)
        detalles.appendChild(fila)
    })
    calcularstotal()
}

function eliminarProducto(codigo){
    arrayProductos = arrayProductos.filter((detalle) => {
        if(codigo != detalle.codigoProducto){
            return detalle
        }
    })
    armarPedido()
}

function verificarComunicacion(){
    $.ajax({
        type: "POST",
        url: base_url + "Pedidos/verificarComunicacion",
        cache: false,
        dataType: "json",
        success: function(data){
            if(data!=false){
                if(data.RespuestaComunicacion.transaccion == true){
                    document.getElementById("comunicacion").innerHTML = data.RespuestaComunicacion.mensajesList.descripcion
                    document.getElementById("comunicacion").className = "badge badge-success"
                } 
            }                     
        }
    })
}

verificarComunicacion()

function cuis(){
    $.ajax({
        type: "POST",
        url: base_url + "Pedidos/cuis",
        cache: false,
        dataType: "json",
        success: function(data){
            if(data!=false){
                document.getElementById("cuisp").innerHTML="CUIS: "+data.RespuestaCuis.codigo
            }           
        }
    })
}

cuis()

function cufd(){
    $.ajax({
        type: "POST",
        url: base_url + "Pedidos/cufd",
        cache: false,
        dataType: "json",
        success: function(data){
            if(data.RespuestaCufd.transaccion == true){
                document.getElementById("cufd").innerHTML = "CUFD vigente "+data.RespuestaCufd.fechaVigencia.substring(0, 16)
                document.getElementById("cufd").className = "badge badge-success";
            }           
        }
    })
}

cufd()

function emitirFactura(){
    let nitEmisor = "4247012018";
    let razonSocialEmisor = "INDEX INGENIERIA";
    let municipio = "Santa Cruz";
    let telefono = "71536202";
    let numeroFactura = document.getElementById("nrofactura").value
    let cuf = "12345"
    let cufd = document.getElementById("cufdvalor").value
    let codigoSucursal = 0
    let direccion = "AV. 20 de octubre 1589"
    let codigoPuntoVenta = 0
    var diferenciaH = new Date().getTimezoneOffset() * 60000
    let fechaEmision = new Date(Date.now()-diferenciaH).toISOString().slice(0, -1)
    let nombreRazonSocial = document.getElementById("razon_social").value
    let codigoTipoDocumentoIdentidad = document.getElementById("tipo_documento").value
    let numeroDocumento = document.getElementById("documentoid").value
    let complemento = document.getElementById("complementoid").value
    let codigoCliente = document.getElementById("documentoid").value
    let codigoMetodoPago = 1
    let numeroTarjeta = null
    let montoTotal = document.getElementById("total").value
    let montoTotalSujetoIva = document.getElementById("total").value
    let montoGiftCard = null
    let descuentoAdicional = document.getElementById("descAdicional").value
    let codigoExcepcion = 0
    let cafc = null
    let codigoMoneda = 1
    let tipoCambio = 1
    let montoTotalMoneda = document.getElementById("total").value
    let leyenda = "Ley N° 453: El proveedor de servicios debe habilitar medios e instrumentos para efectuar consultas y reclamaciones."
    let usuario = document.getElementById("usuario").value
    let codigoDocumentoSector = 1

    var factura = []
    factura.push({
        cabecera: {
            nitEmisor: nitEmisor,
            razonSocialEmisor: razonSocialEmisor,
            municipio: municipio,
            telefono: telefono,
            numeroFactura: numeroFactura,
            cuf: cuf,
            cufd: cufd,
            codigoSucursal: codigoSucursal,
            direccion: direccion,
            codigoPuntoVenta: codigoPuntoVenta,
            fechaEmision: fechaEmision,
            nombreRazonSocial: nombreRazonSocial,
            codigoTipoDocumentoIdentidad: codigoTipoDocumentoIdentidad,
            numeroDocumento: numeroDocumento,
            complemento: complemento,
            codigoCliente: codigoCliente,
            codigoMetodoPago: codigoMetodoPago,
            numeroTarjeta: numeroTarjeta,
            montoTotal: montoTotal,
            montoTotalSujetoIva: montoTotalSujetoIva,
            codigoMoneda: codigoMoneda,
            tipoCambio: tipoCambio,
            montoTotalMoneda: montoTotalMoneda,
            montoGiftCard: montoGiftCard,
            descuentoAdicional: descuentoAdicional,
            codigoExcepcion: codigoExcepcion,
            cafc: cafc,            
            leyenda: leyenda,
            usuario: usuario,
            codigoDocumentoSector: codigoDocumentoSector
        }
    })
    
    arrayProductos.forEach(function (item){
        factura.push({
            detalle: item
        })
    })
    id_cliente = document.getElementById("id_cliente").value
    $.ajax({
        type: "POST",
        url: base_url + "Pedidos/emitirFactura",
        data: {
            factura: factura,
            id_cliente: id_cliente
        },
        dataType: "json",
        success: function(data){
            if(data.RespuestaServicioFacturacion.transaccion==true){
                Swal.fire({
                    title: data.RespuestaServicioFacturacion.codigoDescripcion,
                    text: data.RespuestaServicioFacturacion.codigoRecepcion,
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                })
                setTimeout(function(){
                    window.location.href = base_url + "Pedidos"
                },2000)
            }else{
                Swal.fire({
                    title: data.RespuestaServicioFacturacion.codigoDescripcion,
                    text: data.RespuestaServicioFacturacion.mensajesList.descripcion,
                    icon: "error"
                })
            }           
        }
    })
}