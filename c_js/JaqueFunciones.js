/*
 * Copyright (c) $today.year.Todos los derechos reservados a nombre de Informática Rodrigo Jaque Escobar.
 */

// JavaScript Document
//Descripción: Inicio Sistema HyV
//Fecha: 22 julio 2022
//Solicitado por: Rodrigo Jaque
// Sistema HyV


// Buscar Patente
function fnjs_existe_patente(patente) {
    $.get("c_connections/funcionesJava.php", {RJE: 100, patente: patente },
        function (htmlExternoPHP) {
            console.log(htmlExternoPHP);

            //No existe, lo dejo continuar
            if(htmlExternoPHP == 0  )
            {
                document.getElementById('btn_patente').style.backgroundColor = "green";
                document.getElementById('btn_patente').removeAttribute("disabled");
                $texto =  "<i class='fa-2x fal fa-check-circle'></i>" ;
            }

            //Si existe, lo detengo
            if (htmlExternoPHP == 1)
            {
                document.getElementById('btn_patente').style.backgroundColor = "red";

                $texto = "Patente Ya registrada <i class=' fal fa-times-circle'></i>  <a href='home_admin.php?template=t_patentes_listar&accion=Listar&titulo_pagina=Patentes>Listar&seccion=Siniestros&desc_pagina=Listado de siniestros, ordenados por patente y registro'><br> <hr> Abrir Listado de Patentes</a>";
                $texto2 = "Patente Ya registrada ";

            alert($texto2);
            }

            $("#patente_ok").html($texto);
        });
}



//registra una modificación en la tabla siniestros
    function fnjs_estado_siniestro(id_estado, id_siniestro, id_usuario)
    {
        $.get("c_connections/funcionesJava.php", { RJE: 02,  id_estado: id_estado,  id_siniestro: id_siniestro,   id_usuario: id_usuario  },
            function(htmlExternoPHP)
            {
                // aqí devolvemos el mensaje
                $("#AvisoX_" + id_siniestro).html("<i class='fa fa-check-circle text-success' </i>");
                document.getElementById("descripcion_"+ id_siniestro).style.visibility = "hidden";
            });
    }





//Mostrar o ocultar password
function fnjava_verClave(password, botonVer) {
//recibe los nombres de los campos que no siempre se llaman igual

    password = document.getElementById(password);
    botonVer = document.getElementById(botonVer);
    console.log("Entra");
    if (botonVer.checked == true) // Si la checkbox de mostrar contraseña está activada
    {
        password.type = "text";
    } else // Si no está activada
    {
        password.type = "password";
    }
}

//Descripción: Fin Sistema HyV



//
//
// function fnjs_nombreClientedeEmpresa(idEmpresaCliente, posDiv) {
//     $.get("Connections/funcionesJava.php", {RJE: 43, idEmpresaCliente: idEmpresaCliente },
//         function (htmlExternoPHP) {
//             // Verificamos la rpta entregada por miscript.php
//             // $("#ubicacion-" + varcodbarra + "-" + varlote).html("<i class='fas fa-check-circle text-success'> </i> " + htmlExternoPHP);
//
//             // Esta fila es para saber que responde la base de datos solamente.
//             //    $("#AvisoTienda" + varidPackingListDetalle).html(htmlExternoPHP);
//             console.log(htmlExternoPHP)
//             $("#nombreEmpresa-" + posDiv).html(htmlExternoPHP);
//
//         });
// }
//
//

//
//
//
// //Habilita el boton hay que enviar el id del boton
// // se usa el id = idBoton
// function fnjs_habilitarBoton(idBoton) {
//     document.getElementById(idBoton).style.visibility = "visible";
//     document.getElementById(idBoton).className = "btn btn-success";
//     document.getElementById(idBoton).removeAttribute("disabled");
//     document.getElementById(idBoton).value = " Enviar"
// }
//
//
// //Valida Rut:
// function Valida_Rut(Objeto) {
//     var tmpstr = "";
//     var intlargo = Objeto.value
//     if (intlargo.length > 0) {
//         crut = Objeto.value
//         largo = crut.length;
//         if (largo < 2) {
//             alert('rut inválido')
//             Objeto.focus()
//             return false;
//         }
//
//         for (i = 0; i < crut.length; i++)
//             if (crut.charAt(i) != ' ' && crut.charAt(i) != '.' && crut.charAt(i) != '-') {
//                 tmpstr = tmpstr + crut.charAt(i);
//             }
//         rut = tmpstr;
//         crut = tmpstr;
//         largo = crut.length;
//
//         if (largo > 2)
//             rut = crut.substring(0, largo - 1);
//         else
//             rut = crut.charAt(0);
//         dv = crut.charAt(largo - 1);
//         if (rut == null || dv == null)
//             return 0;
//         var dvr = '0';
//         suma = 0;
//         mul = 2;
//
//
//         for (i = rut.length - 1; i >= 0; i--) {
//             suma = suma + rut.charAt(i) * mul;
//             if (mul == 7)
//                 mul = 2;
//             else
//                 mul++;
//         }
//
//
//         res = suma % 11;
//         if (res == 1)
//             dvr = 'k';
//         else if (res == 0)
//             dvr = '0';
//         else {
//             dvi = 11 - res;
//             dvr = dvi + "";
//         }
//
//
//         if (dvr != dv.toLowerCase()) {
//             alert('El Rut Ingreso es Invalido')
//             Objeto.focus()
//             document.getElementById('rut').value = "";
//             return false;
//         }
//
//         //	alert('El Rut Ingresado es Correcto!')
//         Objeto.focus()
//         return true;
//     }
// }
//
//
// // Va a buscar los datos de clientes según al empresa que se seleccone.
// // se llama desde un combobox y carga otro
// function fnjs_clientesEmpresas(idEmpresa) {
//     var varidEmpresa = idEmpresa;
//     console.log(idEmpresa);
//
//     $.get("Connections/funcionesJava.php", {RJE: 41, idEmpresa: varidEmpresa},
//         function (htmlExternoPHP) {
//             console.log(htmlExternoPHP);
//             var str = htmlExternoPHP;
//             var arr = str.split(";");
//             var total_palabras = str.split(";").length;
//             var iteraciones = (total_palabras - 1);
//             var i = 1;
//             while (i <= iteraciones) {
//                 var sel = document.getElementById('idCliente');
//                 var opt = document.createElement("option");
//                 var valorText = i + 1;
//
//                 if (i % 2 == 0) {
//                     console.log("No hago nada impar");
//                 } else {
//                     // opt.text = arr[valorText];
//                     // opt.value = arr[i];
//                     opt.text = arr[i];
//                     opt.value = arr[valorText] - 1;
//                     sel.add(opt, null);
//                 }
//                 i++;
//             }
//
//         })
//
// }
//
//
// function fnjs_buscaProductoRack(getcodbarra, getlote) {
//     var varcodbarra = getcodbarra;
//     var varlote = getlote;
//
//     console.log(varcodbarra, varlote);
//
//     $.get("Connections/funcionesJava.php", {RJE: 32, codigodeBarra: varcodbarra, lote: varlote},
//         function (htmlExternoPHP) {
//             // Verificamos la rpta entregada por miscript.php
//             // $("#ubicacion-" + varcodbarra + "-" + varlote).html("<i class='fas fa-check-circle text-success'> </i> " + htmlExternoPHP);
//
//             // Esta fila es para saber que responde la base de datos solamente.
//             //    $("#AvisoTienda" + varidPackingListDetalle).html(htmlExternoPHP);
//             console.log(htmlExternoPHP)
//             $("#ubicacion-" + varcodbarra + "-" + varlote).html(htmlExternoPHP);
//
//         });
// }
//
//
// //Cambiar el estado de un Picking
// function js_asignaTiendaPicking(idTienda, idPackingListDetalle) {
//     var varidtienda = idTienda;
//     var varidPackingListDetalle = idPackingListDetalle;
//
//     $.get("Connections/funcionesJava.php", {RJE: 30, idTienda: varidtienda, idPackingListDetalle: varidPackingListDetalle},
//         function (htmlExternoPHP) {
//             // Verificamos la rpta entregada por miscript.php
//             $("#AvisoTienda" + varidPackingListDetalle).html("<i class='fas fa-check-circle text-success'> </i>");
//
//             // Esta fila es para saber que responde la base de datos solamente.
//             //    $("#AvisoTienda" + varidPackingListDetalle).html(htmlExternoPHP);
//             //    console.log(htmlExternoPHP)
//
//         });
// }
//
//
//
//
// //Cambiar el estado de un Picking
// function fnjs_eliminarProducto(idProducto) {
//     var varidproducto = idProducto;
//     $.get("Connections/funcionesJava.php", {RJE: 26, idProducto: varidproducto},
//         function (htmlExternoPHP) {
//             alert('Producto Eliminado')
//             window.location.href = 'a_productos.php';
//         });
// }
//
//
// //Cambiar el estado de un Picking
// function js_cambiaestadoPicking(idPicking, estadoPicking, idUsuario) {
//     var varidpicking = idPicking;
//     var varestadopicking = estadoPicking;
//     var varidusuario = idUsuario;
//     // var varcodpicking = codPicking;
//
//     $.get("Connections/funcionesJava.php", {RJE: 23, idpicking: varidpicking, estadopicking: varestadopicking, idUsuario: varidusuario},
//         function (htmlExternoPHP) {
//             // Verificamos la rpta entregada por miscript.php
//             $("#AvisoX" + varidpicking).html("<i class='fas fa-check-circle text-success fa-2x'> </i>");
//
//             // Esta fila es para saber que responde la base de datos solamente.
//             //  $("#AvisoX" + varidpicking).html(htmlExternoPHP);
//             // $("#AvisoX" + varidpicking).html(htmlExternoPHP);
//             console.log(htmlExternoPHP)
//             alert("Se ha cambiado el Estado a: " + estadoPicking);
//         });
// }
//
//
// //salvar proyección javascript
// function js_guardarObsPicking(idPackingListDetalle, estadoPicking, IdUsuario) {
//     var varidPackingListDetalle = idPackingListDetalle;
//     var varestadoPicking = estadoPicking;
//     var varIdUsuario = IdUsuario;
//
//     $.get("Connections/funcionesJava.php", {RJE: 19, idPackingListDetalle: varidPackingListDetalle, estadoPicking: varestadoPicking, idUsuario: varIdUsuario},
//         function (htmlExternoPHP) {
//             // Verificamos la rpta entregada por miscript.php
//             $("#AvisoX" + varidPackingListDetalle).html("<i class='fas fa-check-circle text-success >' </i>");
//             $("#AvisoX2" + varidPackingListDetalle).html(varestadoPicking);
//         });
// }
//
//
// // Funciones de carga de Modal de archivos en funciones Java.
// function fnjava_calculabM3($cajas) {
//     var $DUN = '';
//     if ($cajas != "") {
//         $DUN = document.getElementById("DUN").value;
//         // alert($DUN);
//         // document.getElementById("M3").innerHTML="Hola";
//     }
//
//
//     $.get("Connections/funcionesJava.php", {RJE: 13, DUN: $DUN, cajas: $cajas},
//         function (htmlExternoPHP) {
//             // Verificamos la rpta entregada por miscript.php
//             //$("#Aviso" + var1).html('OK. ');
//             // $("#detalleProyeccion").html(htmlExternoPHP);
//             //alert("Llegamos");
//             document.getElementById("M3").innerHTML = htmlExternoPHP;
//         });
//
// }
//
//
// function fnJava_calculaTotalpeso($valordigitado) {
//
//     // var ten = document.getElementById("pesoUnidad").value;
//     var ten2 = document.getElementById("pesoBrutoKilosDUN").value;
//     var PesoBruto = ten2.replace(",", ".");
//     var total = 0;
//
//     num_entero = parseInt($valordigitado);
//     num_flotante = parseFloat(PesoBruto);
//
//     total = num_entero * num_flotante;
//     document.getElementById("pesoBruto").value = total;
// }
//
//
// // Funciones de carga de Modal de archivos en funciones Java.
// function fnjava_cargaCodigoBarra(codBarra) {
//     var varCdeBarra = codBarra;
//
//     //asigna directamente los datos al campo del formulario
//     // document.getElementById("DUN").value = var1;
//
//     if (varCdeBarra == "") {
//         varCdeBarra = document.getElementById("CodBarra").value;
//         return;
//     }
//     // alert(varDUN );
//
//     // código para IE7+, Firefox, Chrome, Opera, Safari
//     if (window.XMLHttpRequest) {
//         xmlhttp = new XMLHttpRequest();
//         //código para IE6, IE5
//     } else {
//         var xhttp = new XMLHttpRequest();
//         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//     }
//     xmlhttp.onreadystatechange = function () {
//         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//
//             var VarMatriz = xmlhttp.responseText;
//
//             var res = VarMatriz.split("/");
//
//             document.getElementById("DUN").value = res[0];
//             document.getElementById("detalle").value = res[1];
//             document.getElementById("codigoATLAS").value = res[2];
//             document.getElementById("codigoSAP").value = res[3];
//             document.getElementById("pesoUnidad").value = res[4];
//             document.getElementById("pesoBrutoKilosDUN").value = res[5];
//         }
//     }
//     xmlhttp.open('GET', 'Connections/funcionesJava.php?RJE=11&codBarra=' + varCdeBarra, true);
//     xmlhttp.send();
// }
//
//
// // Funciones de carga de Modal de archivos en funciones Java.
// function fnjava_cargaDUN(DUN) {
//     var varDUN = DUN;
//
//     //asigna directamente los datos al campo del formulario
//     // document.getElementById("DUN").value = var1;
//
//     if (varDUN == "") {
//         varDUN = document.getElementById("DUN").value;
//         return;
//     }
//     // alert(varDUN );
//
//     // código para IE7+, Firefox, Chrome, Opera, Safari
//     if (window.XMLHttpRequest) {
//         xmlhttp = new XMLHttpRequest();
//         //código para IE6, IE5
//     } else {
//         var xhttp = new XMLHttpRequest();
//         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//     }
//     xmlhttp.onreadystatechange = function () {
//         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//
//             var VarMatriz = xmlhttp.responseText;
//
//             var res = VarMatriz.split("/");
//
//             document.getElementById("CodBarra").value = res[0];
//             document.getElementById("detalle").value = res[1];
//             document.getElementById("codigoATLAS").value = res[2];
//             document.getElementById("codigoSAP").value = res[3];
//             document.getElementById("codigoBarras").value = res[4];
//             document.getElementById("pesoUnidad").value = res[5];
//             document.getElementById("pesoBrutoKilosDUN").value = res[6];
//
//         }
//     }
//     xmlhttp.open('GET', 'Connections/funcionesJava.php?RJE=10&DUN=' + varDUN, true);
//     xmlhttp.send();
// }
//
//
// //funcion llama a un modal y le  pasa el Rut del Cliente para agregar contactos
// function fnjava_cargarModalRutCliente(rutCliente) {
// //Declaro Variables
//     var var1 = rutCliente
//
//     document.getElementById("rutClienteAgregar").value = var1;
// };
//
//
// // Funciones de carga de Modal de archivos en funciones Java.
// function fnjava_cargarModalEliminarContacto(idContacto) {
//
//     var var0 = 8;
//     var var1 = idContacto;
//
//     //asigna directamente los datos al campo del formulario
//     //document.getElementById("idContacto").value = var1;
//     //document.getElementById("idContacto2").value = var1;
//
//     if (var1 == "") {
//         document.getElementById("rutCli").innerHTML = "";
//         return;
//     }
//     // código para IE7+, Firefox, Chrome, Opera, Safari
//     if (window.XMLHttpRequest) {
//         xmlhttp = new XMLHttpRequest();
//         //código para IE6, IE5
//     } else {
//         var xhttp = new XMLHttpRequest();
//         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//     }
//     xmlhttp.onreadystatechange = function () {
//         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//
//             var VarMatriz = xmlhttp.responseText;
//
//             var res = VarMatriz.split("/");
//
//             //document.getElementById("idContactoBorrar").value=res[0];
//             document.getElementById("idContactoBorrar").value = var1;
//             document.getElementById("nombreContactoBorrar").value = res[1];
//             //RutContactoBorrar
//             document.getElementById("RutContactoBorrar").value = res[0];
// //		document.getElementById("fonos").value=res[3];
// //		document.getElementById("comentarios").value=res[4];
// //		document.getElementById("movil").value=res[5];
//         }
//     }
//     xmlhttp.open('GET', 'Connections/funcionesJava.php?RJE=8&idContacto=' + var1, true);
//     xmlhttp.send();
// }
//
//
// // Funciones de carga de Modal de archivos en funciones Java.
// function fnjava_cargarModalIdContacto(idContacto) {
//
//     var var0 = 8;
//     var var1 = idContacto;
//
//     //asigna directamente los datos al campo del formulario
//     document.getElementById("idContacto").value = var1;
//     //document.getElementById("idContacto2").value = var1;
//
//     if (var1 == "") {
//         document.getElementById("rutCli").innerHTML = "";
//         return;
//     }
//     // código para IE7+, Firefox, Chrome, Opera, Safari
//     if (window.XMLHttpRequest) {
//         xmlhttp = new XMLHttpRequest();
//         //código para IE6, IE5
//     } else {
//         var xhttp = new XMLHttpRequest();
//         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//     }
//     xmlhttp.onreadystatechange = function () {
//         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//
//             var VarMatriz = xmlhttp.responseText;
//
//             var res = VarMatriz.split("/");
//
//             document.getElementById("rutCli").value = res[0];
//             document.getElementById("nombre").value = res[1];
//             document.getElementById("mail").value = res[2];
//             document.getElementById("fonos").value = res[3];
//             document.getElementById("comentarios").value = res[4];
//             document.getElementById("movil").value = res[5];
//         }
//     }
//     xmlhttp.open('GET', 'Connections/funcionesJava.php?RJE=8&idContacto=' + var1, true);
//     xmlhttp.send();
// }
//
//
// ////////////////////////////////////
//
//
// function fnjava_SaberGestionHoy(varRUT) {
//     $.get("Connections/funcionesJava.php", {RJE: 7, RUT: varRUT}, function (data) {
//         //// Verificamos la rpta entregada por miscript.php
//         $("#td-" + varRUT).html(data);
//     });
// }
//
// ////////////////////////////////////
//
// function abrirVentana(url) {
//     window.open(url, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=200");
// //var formularioPrincipal = document.formModal1;
//     //	var primerElemento = document.getElementById("rutCliente").value = rut;
// };
//
// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
// function number_format(amount, decimals) {
//
//     amount += ''; // por si pasan un numero en vez de un string
//     amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto
//
//     decimals = decimals || 0; // por si la variable no fue fue pasada
//
//     // si no es un numero o es igual a cero retorno el mismo cero
//     if (isNaN(amount) || amount === 0)
//         return parseFloat(0).toFixed(decimals);
//
//     // si es mayor o menor que cero retorno el valor formateado como numero
//     amount = '' + amount.toFixed(decimals);
//
//     var amount_parts = amount.split(','),
//         regexp = /(\d+)(\d{3})/;
//
//     while (regexp.test(amount_parts[0]))
//         amount_parts[0] = amount_parts[0].replace(regexp, '$1' + '.' + '$2');
//
//     return amount_parts.join('.');
// }
//
//
// function fn_CargarNotadeCredito(nroFactura) {
//     var varnroFactura = nroFactura;
//     //alert(varnroFactura);
//
//     $("#ID-nroFactura").html(varnroFactura);
//
//     //var varRsocial  = document.getElementById("razonSocial").value.trim();
// //	alert(varRut + " / " + varRsocial + " / " + varCobrador + " / " + varFecha + " / " + varMonto);
//     //if(varFecha===''){ alert("Debe seleccionar una fecha"); $("#datepicker").focus(); return; }
//     //	if(varMonto===''){ alert("El campo de monto no debe estar vacio"); $("#montoProyeccion").focus(); return; };
//     $.get("Connections/funcionesJava.php", {RJE: 5, nrofactura: varnroFactura},
//         function (listadoFacturas) {
//             // Verificamos la rpta entregada por miscript.php
//             //$("#Aviso" + var1).html('OK. ');
//             $("#id-ListadoFacturas").html(listadoFacturas);
//             //alert("Llegamos");
//         });
// }
//
//
// function CambiarClase() {
//     document.getElementById("data").className = "form-control";
//     document.getElementById("trigger").className = "btn-xs btn-warning";
// };
//
//
// function recargaSelectEstado(nroFactura, idEstado) {
//     var var1 = nroFactura;
//     var var2 = idEstado;
//     $.get("Connections/funcionesJava.php", {RJE: 1, nroFactura: var1, idEstado: var2},
//         function (data) {
//             // $("#Aviso" + var1).html(data);
//             $("#Aviso" + var1).html('OK. ');
//         });
// };
//
//
// //salvar proyección javascript
// function salvarProyeccion() {
//     var varRut = document.getElementById("rut").value.trim();
//     var varRsocial = document.getElementById("razonSocial").value.trim();
//     var varCobrador = document.getElementById("cobrador").value.trim();
//     var varFecha = document.getElementById("datepicker").value.trim();
//     var varMonto = document.getElementById("montoProyeccion").value.trim();
//
// //	alert(varRut + " / " + varRsocial + " / " + varCobrador + " / " + varFecha + " / " + varMonto);
//
//     if (varFecha === '') {
//         alert("Debe seleccionar una fecha");
//         $("#datepicker").focus();
//         return;
//     }
//     if (varMonto === '') {
//         alert("El campo de monto no debe estar vacio");
//         $("#montoProyeccion").focus();
//         return;
//     }
//     ;
//
//     $.get("Connections/funcionesJava.php", {RJE: 2, rut: varRut, rSocial: varRsocial, fecha: varFecha, monto: varMonto, cobrador: varCobrador},
//         function (htmlExternoPHP) {
//             // Verificamos la rpta entregada por miscript.php
//             //$("#Aviso" + var1).html('OK. ');
//             $("#detalleProyeccion").html(htmlExternoPHP);
//             //alert("Llegamos");
//         });
// }
//
//
// function borrarProyeccion(idProyeccion) {
//     var varIdProyeccion = idProyeccion
//     var varRut = document.getElementById("rut").value.trim();
//     $.get("Connections/funcionesJava.php", {RJE: 4, idProyeccion: varIdProyeccion, rut: varRut},
//         function (htmlExternoPHP) {
//             $("#detalleProyeccion").html(htmlExternoPHP);
//         });
// }
//
