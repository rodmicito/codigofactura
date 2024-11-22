let tblUsuarios
let tblCajas
let tblClientes
let tblCategorias
let tblMedidas
let tblProductos
let tblFacturas
tblUsuarios = $("#tblUsuarios").DataTable({
    ajax: {
        url: base_url + "Usuarios/listar",
        dataSrc: ''
    },
    columns: [
        { 'data': 'id_usuario' },
        { 'data': 'nick' },
        { 'data': 'nombre' },
        { 'data': 'caja' },
        { 'data': 'usuario_estado' },
        { 'data': 'acciones' }
    ]
})

tblCajas = $("#tblCajas").DataTable({
    ajax: {
        url: base_url + "Cajas/listar",
        dataSrc: ''
    },
    columns: [
        { 'data': 'id_caja' },
        { 'data': 'caja' },
        { 'data': 'caja_estado' },
        { 'data': 'acciones' }
    ]
})

tblClientes = $("#tblClientes").DataTable({
    ajax: {
        url: base_url + "Clientes/listar",
        dataSrc: ''
    },
    columns: [
        { 'data': 'razon_social' },
        { 'data': 'documentoid' },
        { 'data': 'complementoid' },
        { 'data': 'tipo_documento' },
        { 'data': 'cliente_email' },
        { 'data': 'cliente_estado' },
        { 'data': 'acciones' }
    ]
})

tblCategorias = $("#tblCategorias").DataTable({
    ajax: {
        url: base_url + "Categorias/listar",
        dataSrc: ''
    },
    columns: [
        { 'data': 'id_categoria' },
        { 'data': 'nombre_categoria' },
        { 'data': 'codigoProductoSin' },
        { 'data': 'categoria_estado' },
        { 'data': 'acciones' }
    ]
})

tblMedidas = $("#tblMedidas").DataTable({
    ajax: {
        url: base_url + "Medidas/listar",
        dataSrc: ''
    },
    columns: [
        { 'data': 'id_medida' },
        { 'data': 'descripcion_medida' },
        { 'data': 'descripcion_corta' },
        { 'data': 'medidaSin' },
        { 'data': 'medida_estado' },
        { 'data': 'acciones' }
    ]
})

tblProductos = $("#tblProductos").DataTable({
    ajax: {
        url: base_url + "Productos/listar",
        dataSrc: ''
    },
    columns: [
        { 'data': 'codigo' },
        { 'data': 'nombre_producto' },
        { 'data': 'codigoProductoSin' },
        { 'data': 'nombre_categoria' },
        { 'data': 'descripcion_medida' },
        { 'data': 'cantidad' },
        { 'data': 'costo_compra' },
        { 'data': 'precio_venta' },
        { 'data': 'producto_estado' },
        { 'data': 'acciones' }
    ]
})

tblFacturas = $("#tblFacturas").DataTable({
    ajax: {
        url: base_url + "Pedidos/listar",
        dataSrc: ''
    },
    columns: [
        { 'data': 'razon_social' },
        { 'data': 'documentoid' },
        { 'data': 'numeroFactura' },
        { 'data': 'fechaEmision' },
        { 'data': 'MontoTotal' },
        { 'data': 'descuentoAdicional' },
        { 'data': 'factura_estado' },
        { 'data': 'acciones' }
    ]
})

//USUARIOS
function frmUsuario() {
    document.getElementById("frmUsuario").reset()
    document.getElementById("title").innerHTML = "Nuevo usuario"
    document.getElementById("btnAccion").innerHTML = "Guardar"
    document.getElementById("claves").classList.remove("d-none")
    document.getElementById("id_usuario").value = ""
    $("#usuarioModal").modal("show")
}

function registroUsuario(e) {
    e.preventDefault()
    const nick = document.getElementById("nick")
    const nombre = document.getElementById("nombre")
    const clave = document.getElementById("clave")
    if (nick.value == "" || nombre.value == "" || clave.value == "") {
        Swal.fire({
            title: "Los campos son obligatorios",
            icon: "warning"
        })
    } else {
        const url = base_url + "Usuarios/registrar"
        const frm = document.getElementById("frmUsuario")
        const http = new XMLHttpRequest()
        http.open("POST", url, true)
        http.send(new FormData(frm))
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText)
                if (res == "si") {
                    Swal.fire({
                        title: "Datos registrados con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $("#usuarioModal").modal("hide")
                    tblUsuarios.ajax.reload()
                } else if (res == "modif") {
                    Swal.fire({
                        title: "Datos actualizados con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $("#usuarioModal").modal("hide")
                    tblUsuarios.ajax.reload()
                } else {
                    Swal.fire({
                        title: "Error...!",
                        text: res,
                        icon: "error"
                    })
                }
            }
        }
    }
}

function btnEditarUsuario(id) {
    document.getElementById("title").innerHTML = "Editar usuario"
    document.getElementById("btnAccion").innerHTML = "Actualizar"
    const url = base_url + "Usuarios/get_usuario_id/" + id
    const http = new XMLHttpRequest()
    http.open("GET", url, true)
    http.send()
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText)
            document.getElementById("id_usuario").value = res.id_usuario
            document.getElementById("nick").value = res.nick
            document.getElementById("nombre").value = res.nombre
            document.getElementById("id_caja").value = res.id_caja
            document.getElementById("clave").value = 1
            document.getElementById("claves").classList.add("d-none")
            $("#usuarioModal").modal("show")
        }
    }
}

function btnInactivaUsuario(id) {
    Swal.fire({
        title: "¿Esta seguro de inactivar al usuario?",
        text: "El usuario no se eliminará, solo cambiara su estado a inactivo",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/inactivar/" + id
            const http = new XMLHttpRequest()
            http.open("GET", url, true)
            http.send()
            http.onreadystatechange = function () {
                tblUsuarios.ajax.reload()
                Swal.fire({
                    title: "Registro inactivado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    })
}

function btnActivaUsuario(id) {
    Swal.fire({
        title: "¿Esta seguro de activar al usuario?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/activar/" + id
            const http = new XMLHttpRequest()
            http.open("GET", url, true)
            http.send()
            http.onreadystatechange = function () {
                tblUsuarios.ajax.reload()
                Swal.fire({
                    title: "Registro activado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    })
}

//CAJAS
function frmCaja() {
    document.getElementById("frmCaja").reset()
    document.getElementById("title").innerHTML = "Nueva caja"
    document.getElementById("btnAccion").innerHTML = "Guardar"
    document.getElementById("id_caja").value = ""
    $("#cajaModal").modal("show")
}

function registroCaja(e) {
    e.preventDefault()
    const caja = document.getElementById("caja")
    if (caja.value == "") {
        Swal.fire({
            title: "Los campos son obligatorios",
            icon: "warning"
        })
    } else {
        const url = base_url + "Cajas/registrar"
        const frm = document.getElementById("frmCaja")
        const http = new XMLHttpRequest()
        http.open("POST", url, true)
        http.send(new FormData(frm))
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText)
                if (res == "si") {
                    Swal.fire({
                        title: "Datos registrados con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $("#cajaModal").modal("hide")
                    tblCajas.ajax.reload()
                } else if (res == "modif") {
                    Swal.fire({
                        title: "Datos actualizados con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $("#cajaModal").modal("hide")
                    tblCajas.ajax.reload()
                } else {
                    Swal.fire({
                        title: "Error...!",
                        text: res,
                        icon: "error"
                    })
                }
            }
        }
    }
}

function btnEditarCaja(id) {
    document.getElementById("title").innerHTML = "Editar caja"
    document.getElementById("btnAccion").innerHTML = "Actualizar"
    const url = base_url + "Cajas/get_caja_id/" + id
    const http = new XMLHttpRequest()
    http.open("GET", url, true)
    http.send()
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText)
            document.getElementById("id_caja").value = res.id_caja
            document.getElementById("caja").value = res.caja
            $("#cajaModal").modal("show")
        }
    }
}

function btnInactivaCaja(id) {
    Swal.fire({
        title: "¿Esta seguro de inactivar la caja?",
        text: "La caja no se eliminará, solo cambiara su estado a inactiva",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Cajas/inactivar/" + id
            const http = new XMLHttpRequest()
            http.open("GET", url, true)
            http.send()
            http.onreadystatechange = function () {
                tblCajas.ajax.reload()
                Swal.fire({
                    title: "Registro inactivado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    })
}

function btnActivaCaja(id) {
    Swal.fire({
        title: "¿Esta seguro de activar la caja?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Cajas/activar/" + id
            const http = new XMLHttpRequest()
            http.open("GET", url, true)
            http.send()
            http.onreadystatechange = function () {
                tblCajas.ajax.reload()
                Swal.fire({
                    title: "Registro activado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    })
}

//CLIENTES
function frmCliente() {
    document.getElementById("frmCliente").reset()
    document.getElementById("title").innerHTML = "Nuevo cliente"
    document.getElementById("btnAccion").innerHTML = "Guardar"
    document.getElementById("id_cliente").value = ""
    $("#clienteModal").modal("show")
}

function registroCliente(e) {
    e.preventDefault()
    const razon_social = document.getElementById("razon_social")
    const documentoid = document.getElementById("documentoid")
    if (razon_social.value == "" || documentoid.value == "") {
        Swal.fire({
            title: "Los campos son obligatorios",
            icon: "warning"
        })
    } else {
        const url = base_url + "Clientes/registrar"
        const frm = document.getElementById("frmCliente")
        const http = new XMLHttpRequest()
        http.open("POST", url, true)
        http.send(new FormData(frm))
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText)
                if (res == "si") {
                    Swal.fire({
                        title: "Datos registrados con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $("#clienteModal").modal("hide")
                    tblClientes.ajax.reload()
                } else if (res == "modif") {
                    Swal.fire({
                        title: "Datos actualizados con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $("#clienteModal").modal("hide")
                    tblClientes.ajax.reload()
                } else {
                    Swal.fire({
                        title: "Error...!",
                        text: res,
                        icon: "error"
                    })
                }
            }
        }
    }
}

function btnEditarCliente(id) {
    document.getElementById("title").innerHTML = "Editar cliente"
    document.getElementById("btnAccion").innerHTML = "Actualizar"
    const url = base_url + "Clientes/get_cliente_id/" + id
    const http = new XMLHttpRequest()
    http.open("GET", url, true)
    http.send()
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText)
            document.getElementById("id_cliente").value = res.id_cliente
            document.getElementById("documentoid").value = res.documentoid
            document.getElementById("complementoid").value = res.complementoid
            document.getElementById("razon_social").value = res.razon_social
            document.getElementById("cliente_email").value = res.cliente_email
            document.getElementById("tipo_documento").value = res.tipo_documento
            $("#clienteModal").modal("show")
        }
    }
}

function btnInactivaCliente(id) {
    Swal.fire({
        title: "¿Esta seguro de inactivar al cliente?",
        text: "El cliente no se eliminará, solo cambiara su estado a inactiva",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Clientes/inactivar/" + id
            const http = new XMLHttpRequest()
            http.open("GET", url, true)
            http.send()
            http.onreadystatechange = function () {
                tblClientes.ajax.reload()
                Swal.fire({
                    title: "Registro inactivado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    })
}

function btnActivaCliente(id) {
    Swal.fire({
        title: "¿Esta seguro de activar al cliente?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Clientes/activar/" + id
            const http = new XMLHttpRequest()
            http.open("GET", url, true)
            http.send()
            http.onreadystatechange = function () {
                tblClientes.ajax.reload()
                Swal.fire({
                    title: "Registro activado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    })
}

//CATEGORIAS
function frmCategoria() {
    document.getElementById("frmCategoria").reset()
    document.getElementById("title").innerHTML = "Nueva categoria"
    document.getElementById("btnAccion").innerHTML = "Guardar"
    document.getElementById("id_categoria").value = ""
    $("#categoriaModal").modal("show")
}

function registroCategoria(e) {
    e.preventDefault()
    const nombre_categoria = document.getElementById("nombre_categoria")
    const codigoProductoSin = document.getElementById("codigoProductoSin")
    if (nombre_categoria.value == "" || codigoProductoSin.value == "") {
        Swal.fire({
            title: "Los campos son obligatorios",
            icon: "warning"
        })
    } else {
        const url = base_url + "Categorias/registrar"
        const frm = document.getElementById("frmCategoria")
        const http = new XMLHttpRequest()
        http.open("POST", url, true)
        http.send(new FormData(frm))
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText)
                if (res == "si") {
                    Swal.fire({
                        title: "Datos registrados con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $("#categoriaModal").modal("hide")
                    tblCategorias.ajax.reload()
                } else if (res == "modif") {
                    Swal.fire({
                        title: "Datos actualizados con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $("#categoriaModal").modal("hide")
                    tblCategorias.ajax.reload()
                } else {
                    Swal.fire({
                        title: "Error...!",
                        text: res,
                        icon: "error"
                    })
                }
            }
        }
    }
}

function btnEditarCategoria(id) {
    document.getElementById("title").innerHTML = "Editar categoria"
    document.getElementById("btnAccion").innerHTML = "Actualizar"
    const url = base_url + "Categorias/get_categoria_id/" + id
    const http = new XMLHttpRequest()
    http.open("GET", url, true)
    http.send()
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText)
            document.getElementById("id_categoria").value = res.id_categoria
            document.getElementById("nombre_categoria").value = res.nombre_categoria
            document.getElementById("codigoProductoSin").value = res.codigoProductoSin
            $("#categoriaModal").modal("show")
        }
    }
}

function btnInactivaCategoria(id) {
    Swal.fire({
        title: "¿Esta seguro de inactivar la categoria?",
        text: "La categoria no se eliminará, solo cambiara su estado a inactiva",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Categorias/inactivar/" + id
            const http = new XMLHttpRequest()
            http.open("GET", url, true)
            http.send()
            http.onreadystatechange = function () {
                tblCategorias.ajax.reload()
                Swal.fire({
                    title: "Registro inactivado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    })
}

function btnActivaCategoria(id) {
    Swal.fire({
        title: "¿Esta seguro de activar la categoria?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Categorias/activar/" + id
            const http = new XMLHttpRequest()
            http.open("GET", url, true)
            http.send()
            http.onreadystatechange = function () {
                tblCategorias.ajax.reload()
                Swal.fire({
                    title: "Registro activado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    })
}

//MEDIDAS
function frmMedida() {
    document.getElementById("frmMedida").reset()
    document.getElementById("title").innerHTML = "Nueva medida"
    document.getElementById("btnAccion").innerHTML = "Guardar"
    document.getElementById("id_medida").value = ""
    $("#medidaModal").modal("show")
}

function registroMedida(e) {
    e.preventDefault()
    const descripcion_medida = document.getElementById("descripcion_medida")
    const medidaSin = document.getElementById("medidaSin")
    if (descripcion_medida.value == "" || medidaSin.value == "") {
        Swal.fire({
            title: "Los campos son obligatorios",
            icon: "warning"
        })
    } else {
        const url = base_url + "Medidas/registrar"
        const frm = document.getElementById("frmMedida")
        const http = new XMLHttpRequest()
        http.open("POST", url, true)
        http.send(new FormData(frm))
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText)
                if (res == "si") {
                    Swal.fire({
                        title: "Datos registrados con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $("#medidaModal").modal("hide")
                    tblMedidas.ajax.reload()
                } else if (res == "modif") {
                    Swal.fire({
                        title: "Datos actualizados con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $("#medidaModal").modal("hide")
                    tblMedidas.ajax.reload()
                } else {
                    Swal.fire({
                        title: "Error...!",
                        text: res,
                        icon: "error"
                    })
                }
            }
        }
    }
}

function btnEditarMedida(id) {
    document.getElementById("title").innerHTML = "Editar medida"
    document.getElementById("btnAccion").innerHTML = "Actualizar"
    const url = base_url + "Medidas/get_medida_id/" + id
    const http = new XMLHttpRequest()
    http.open("GET", url, true)
    http.send()
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText)
            document.getElementById("id_medida").value = res.id_medida
            document.getElementById("descripcion_medida").value = res.descripcion_medida
            document.getElementById("descripcion_corta").value = res.descripcion_corta
            document.getElementById("medidaSin").value = res.medidaSin
            $("#medidaModal").modal("show")
        }
    }
}

function btnInactivaMedida(id) {
    Swal.fire({
        title: "¿Esta seguro de inactivar la medida?",
        text: "La medida no se eliminará, solo cambiara su estado a inactiva",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Medidas/inactivar/" + id
            const http = new XMLHttpRequest()
            http.open("GET", url, true)
            http.send()
            http.onreadystatechange = function () {
                tblMedidas.ajax.reload()
                Swal.fire({
                    title: "Registro inactivado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    })
}

function btnActivaMedida(id) {
    Swal.fire({
        title: "¿Esta seguro de activar la medida?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Medidas/activar/" + id
            const http = new XMLHttpRequest()
            http.open("GET", url, true)
            http.send()
            http.onreadystatechange = function () {
                tblMedidas.ajax.reload()
                Swal.fire({
                    title: "Registro activado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    })
}

//PRODUCTOS
function frmProducto() {
    document.getElementById("frmProducto").reset()
    document.getElementById("title").innerHTML = "Nuevo producto"
    document.getElementById("btnAccion").innerHTML = "Guardar"
    document.getElementById("id_producto").value = ""
    $("#productoModal").modal("show")
}

function registroProducto(e) {
    e.preventDefault()
    const codigo = document.getElementById("codigo")
    const nombre_producto = document.getElementById("nombre_producto")
    if (codigo.value == "" || nombre_producto.value == "") {
        Swal.fire({
            title: "Los campos son obligatorios",
            icon: "warning"
        })
    } else {
        const url = base_url + "Productos/registrar"
        const frm = document.getElementById("frmProducto")
        const http = new XMLHttpRequest()
        http.open("POST", url, true)
        http.send(new FormData(frm))
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText)
                if (res == "si") {
                    Swal.fire({
                        title: "Datos registrados con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $("#productoModal").modal("hide")
                    tblProductos.ajax.reload()
                } else if (res == "modif") {
                    Swal.fire({
                        title: "Datos actualizados con éxito",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    })
                    $("#productoModal").modal("hide")
                    tblProductos.ajax.reload()
                } else {
                    Swal.fire({
                        title: "Error...!",
                        text: res,
                        icon: "error"
                    })
                }
            }
        }
    }
}

function btnEditarProducto(id) {
    document.getElementById("title").innerHTML = "Editar producto"
    document.getElementById("btnAccion").innerHTML = "Actualizar"
    const url = base_url + "Productos/get_producto_id/" + id
    const http = new XMLHttpRequest()
    http.open("GET", url, true)
    http.send()
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText)
            document.getElementById("id_producto").value = res.id_producto
            document.getElementById("codigo").value = res.codigo
            document.getElementById("nombre_producto").value = res.nombre_producto
            document.getElementById("costo_compra").value = res.costo_compra
            document.getElementById("precio_venta").value = res.precio_venta
            document.getElementById("cantidad").value = res.cantidad
            document.getElementById("id_categoria").value = res.id_categoria
            document.getElementById("id_medida").value = res.id_medida
            $("#productoModal").modal("show")
        }
    }
}

function btnInactivaProducto(id) {
    Swal.fire({
        title: "¿Esta seguro de inactivar el producto?",
        text: "El producto no se eliminará, solo cambiara su estado a inactivo",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Productos/inactivar/" + id
            const http = new XMLHttpRequest()
            http.open("GET", url, true)
            http.send()
            http.onreadystatechange = function () {
                tblProductos.ajax.reload()
                Swal.fire({
                    title: "Registro inactivado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    })
}

function btnActivaProducto(id) {
    Swal.fire({
        title: "¿Esta seguro de activar el producto?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Productos/activar/" + id
            const http = new XMLHttpRequest()
            http.open("GET", url, true)
            http.send()
            http.onreadystatechange = function () {
                tblProductos.ajax.reload()
                Swal.fire({
                    title: "Registro activado",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        }
    })
}