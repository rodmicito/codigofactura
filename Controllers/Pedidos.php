<?php
class Pedidos extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->views->getView($this, "index");
    }

    public function listar()
    {
        $data = $this->model->getFacturas();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['factura_estado'] = '<a href="https://pilotosiat.impuestos.gob.bo/consulta/QR?nit=4247012018&cuf='.$data[$i]['cuf'].'&numero='.$data[$i]['numeroFactura'].'&t=2" target="_blank"><span class="badge badge-success">Válida</span></a>';
            $data[$i]['acciones'] = '<a href="'.base_url.'Pedidos/imprimirFactura?id='.$data[$i]['id_factura'].'" class="btn btn-primary" title="Imprimir" target="_blank"><i class="fas fa-print"></i></a>';
        }
        echo json_encode($data);
        die();
    }

    public function nuevo_pedido()
    {
        $this->views->getView($this, "nuevo_pedido");
    }

    public function buscarCliente()
    {
        $documentoid = $_POST['documentoid'];
        $data = $this->model->buscarCliente($documentoid);
        if ($data) {
            echo json_encode($data);
        } else {
            $msg = "error";
            echo json_encode($msg);
        }
        die();
    }

    public function buscarProducto()
    {
        $codigo = $_POST['codigo'];
        $data = $this->model->buscarProducto($codigo);
        if ($data) {
            echo json_encode($data);
        } else {
            $msg = "error";
            echo json_encode($msg);
        }
        die();
    }

    public function verificarComunicacion()
    {
        require "Siat.php";
        $siat = new Siat();
        $res = $siat->verificarComunicacion();
        echo json_encode($res);
        die();
    }

    public function cuis()
    {
        if (!isset($_SESSION['scuis'])) {
            require "Siat.php";
            $siat = new Siat();
            $res = $siat->cuis();
            if ($res->RespuestaCuis->mensajesList->codigo == 980) {
                $_SESSION['scuis'] = $res->RespuestaCuis->codigo;
                $_SESSION['sfechaVigenciaCuis'] = $res->RespuestaCuis->fechaVigencia;
            }
        } else {
            $res['RespuestaCuis']['codigo'] = $_SESSION['scuis'];
        }
        echo json_encode($res);
        die();
    }

    public function cufd()
    {
        if (!isset($_SESSION['scufd'])) {
            require "Siat.php";
            $siat = new Siat();
            $res = $siat->cufd();
            if ($res->RespuestaCufd->transaccion == true) {
                $_SESSION['scufd'] = $res->RespuestaCufd->codigo;
                $_SESSION['scodigoControl'] = $res->RespuestaCufd->codigoControl;
                $_SESSION['sfechaVigenciaCufd'] = $res->RespuestaCufd->fechaVigencia;
            }
        } else {
            $res['RespuestaCufd']['transaccion'] = true;
            $res['RespuestaCufd']['codigo'] = $_SESSION['scufd'];
            $res['RespuestaCufd']['codigoControl'] = $_SESSION['scodigoControl'];
            $res['RespuestaCufd']['fechaVigencia'] = $_SESSION['sfechaVigenciaCufd'];
        }
        echo json_encode($res);
        die();
    }

    public function sincronizarActividades()
    {
        require "Siat.php";
        $siat = new Siat();
        $res = $siat->sincronizarActividades();
        echo json_encode($res);
    }

    public function sincronizarListaProductosServicios()
    {
        require "Siat.php";
        $siat = new Siat();
        $res = $siat->sincronizarListaProductosServicios();
        echo json_encode($res);
    }

    public function sincronizarListaLeyendasFactura()
    {
        require "Siat.php";
        $siat = new Siat();
        $res = $siat->sincronizarListaLeyendasFactura();
        echo json_encode($res);
    }

    public function sincronizarParametricaTipoDocumentoIdentidad()
    {
        require "Siat.php";
        $siat = new Siat();
        $res = $siat->sincronizarParametricaTipoDocumentoIdentidad();
        echo json_encode($res);
    }

    public function sincronizarParametricaTipoMetodoPago()
    {
        require "Siat.php";
        $siat = new Siat();
        $res = $siat->sincronizarParametricaTipoMetodoPago();
        echo json_encode($res);
    }

    public function sincronizarParametricaUnidadMedida()
    {
        require "Siat.php";
        $siat = new Siat();
        $res = $siat->sincronizarParametricaUnidadMedida();
        echo json_encode($res);
    }

    public function emitirFactura()
    {
        $datos = $_POST['factura'];
        $id_cliente = $_POST['id_cliente'];
        $valores = $datos[0]['cabecera'];
        $nitEmisor = $valores['nitEmisor'];
        $nitEmisor = str_pad($nitEmisor, 13, "0", STR_PAD_LEFT);
        $fechaEmision = $valores['fechaEmision'];
        $fechafinal = str_replace("T", "", $fechaEmision);
        $fechafinal = str_replace("-", "", $fechafinal);
        $fechafinal = str_replace(":", "", $fechafinal);
        $fechafinal = str_replace(".", "", $fechafinal);
        $sucursal = str_pad(0, 4, "0", STR_PAD_LEFT);
        $modalidad = 2;
        $tipoEmision = 1;
        $tipoFactura = 1;
        $tipoDocSector = str_pad(1, 2, "0", STR_PAD_LEFT);
        $numeroFactura = str_pad($valores['numeroFactura'], 10, "0", STR_PAD_LEFT);
        $puntoVenta = str_pad(0, 4, "0", STR_PAD_LEFT);
        $cadena = $nitEmisor . $fechafinal . $sucursal . $modalidad . $tipoEmision . $tipoFactura . $tipoDocSector . $numeroFactura . $puntoVenta;
        $modulo11 = $this->obtenerModulo11($cadena);
        $cadena .= $modulo11;
        $base16 = $this->base16($cadena);
        $cuf = $base16 . $_SESSION['scodigoControl'];
        $datos[0]['cabecera']['cuf'] = $cuf;
        $valores = $datos[0]['cabecera'];
        $temporal = $datos;
        $xml_temporal = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?><facturaComputarizadaCompraVenta xsi:noNamespaceSchemaLocation=\"facturaComputarizadaCompraVenta.xsd\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"></facturaComputarizadaCompraVenta>");
        $this->array_to_xml($temporal, $xml_temporal);
        $xml_temporal->asXML("docs/factura.xml");
        $archivoxml = "";
        $file = fopen("docs/factura.xml", "r");
        while (!feof($file)) {
            $linea = fgets($file);
            $archivoxml .= $linea;
        }
        fclose($file);
        $gzip = gzencode($archivoxml, 9);
        $file = fopen("docs/factura.xml.zip", "w");
        fwrite($file, $gzip);
        fclose($file);
        $archivo = $gzip;
        $hashArchivo = hash("sha256", $archivoxml);
        require "Siat.php";
        $siat = new Siat();
        $resFactura = $siat->recepcionFactura($archivo, $fechaEmision, $hashArchivo);
        if ($resFactura->RespuestaServicioFacturacion->transaccion == true) {
            $id_cliente = $id_cliente;
            $numeroFactura = $valores['numeroFactura'];
            $cuf = $valores['cuf'];
            $fechaEmision = $fechaEmision;
            $codigoMetodoPago = 1;
            $MontoTotal = $valores['montoTotal'];
            $MontoTotalSujetoIva = $valores['montoTotalSujetoIva'];
            $descuentoAdicional = $valores['descuentoAdicional'];
            $productos = $archivoxml;
            $codigoRecepcion = $resFactura->RespuestaServicioFacturacion->codigoRecepcion;
            $data = $this->model->guardarFactura($id_cliente, $numeroFactura, $cuf, $fechaEmision, $codigoMetodoPago, $MontoTotal, $MontoTotalSujetoIva, $descuentoAdicional, $productos, $codigoRecepcion);
            if ($data == "error") {
                $resFactura->RespuestaServicioFacturacion->transaccion = false;
                $resFactura->RespuestaServicioFacturacion->mensajesList->descripcion = "No se guardo la factura en la base de datos";
            }
            echo json_encode($resFactura);
        } else {
            echo json_encode($resFactura);
        }
        die();
    }

    public function calculaDigitoMod11(string $cadena, int $numDig, int $limMult, bool $x10): string
    {
        if (!$x10) {
            $numDig = 1;
        }

        for ($n = 1; $n <= $numDig; $n++) {
            $suma = 0;
            $mult = 2;
            for ($i = strlen($cadena) - 1; $i >= 0; $i--) {
                $suma += ($mult * substr($cadena, $i, 1));
                if (++$mult > $limMult) {
                    $mult = 2;
                }
            }
            if ($x10) {
                $dig = (($suma * 10) % 11) % 10;
            } else {
                $dig = $suma % 11;
            }
            if ($dig == 10) {
                $cadena .= "1";
            }
            if ($dig == 11) {
                $cadena .= "0";
            }
            if ($dig < 10) {
                $cadena .= $dig;
            }
        }
        return substr($cadena, strlen($cadena) - $numDig, strlen($cadena));
    }

    public function obtenerModulo11(string $cadena): string
    {
        $vDigito = $this->calculaDigitoMod11($cadena, 1, 9, false);
        return $vDigito;
    }

    function base16($number): string
    {
        $hexvalues = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F');
        $hexval = '';
        while ($number != '0') {
            $hexval = $hexvalues[round(bcmod($number, '16'))] . $hexval;
            $number = bcdiv($number, '16', 0);
        }
        return $hexval;
    }

    function array_to_xml($temporal, $xml_temporal)
    {
        $xsi = "http://www.w3.org/2001/XMLSchema-instance";
        foreach ($temporal as $llave => $valor) {
            if (is_array($valor)) {
                if (!is_numeric($llave)) {
                    $subnodo = $xml_temporal->addChild("$llave");
                    $this->array_to_xml($valor, $subnodo);
                } else {
                    $this->array_to_xml($valor, $xml_temporal);
                }
            } else {
                if ($valor == null && $valor <> '0') {
                    $hijo = $xml_temporal->addChild("$llave", "$valor");
                    $hijo->addAttribute('xsi:nil', 'true', $xsi);
                } else {
                    $xml_temporal->addChild("$llave", "$valor");
                }
            }
        }
    }

    public function imprimirFactura(){
        $id_factura=$_GET['id'];
        $data=$this->model->getFactura($id_factura);
        $xml = $data['productos'];
        $archivoxml = new SimpleXMLElement($xml);
        $valor = $archivoxml->cabecera[0];
        $razonSocialEmisor = $valor->razonSocialEmisor;
        $nitEmisor = $valor->nitEmisor;
        $codigoSucursal = $valor->codigoSucursal;
        if($codigoSucursal == 0){
            $sucursal = "CASA MATRIZ";
        }else{
            $sucursal = "SUCURSAL N. ".$codigoSucursal;
        }
        $numeroFactura = $valor->numeroFactura;
        $codigoPuntoVenta = $valor->codigoPuntoVenta;
        $cuf = $valor->cuf;
        $direccion = $valor->direccion;
        $telefono = $valor->telefono;
        $municipio = $valor->municipio;
        $fechaEmision = str_replace("T"," ",$valor->fechaEmision);
        $numeroDocumento = $valor->numeroDocumento;
        $complemento = $valor->complemento;
        if($complemento!= ""){
            $nitCliente = $numeroDocumento.'-'.$complemento;
        }else{
            $nitCliente = $numeroDocumento;
        }
        $nombreRazonSocial=$valor->nombreRazonSocial;
        $codigoCliente = $valor->codigoCliente;
        $descuentoAdicional = $valor->descuentoAdicional;
        $montoTotal = $valor->montoTotal;
        $montoTotalSujetoIva = $valor->montoTotalSujetoIva;
        require ('Assets/fpdf/fpdf.php');
        $pdf = new FPDF('P','mm','Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B','9');

        $pdf->Cell(61,4,utf8_decode($razonSocialEmisor),0,0,'C');
        $pdf->Cell(36,4,"",0,0,'C');
        $pdf->Cell(31,4,"",0,0,'C');
        $pdf->Cell(37,4,"NIT",0,0,'L');
        $pdf->SetFont('Arial','','8');
        $pdf->Cell(0,4,$nitEmisor,0,1,'L');

        $pdf->SetFont('Arial','B','8');
        $pdf->Cell(61,4,utf8_decode($sucursal),0,0,'C');
        $pdf->Cell(36,4,"",0,0,'C');
        $pdf->Cell(31,4,"",0,0,'C');
        $pdf->Cell(37,4,utf8_decode("FACTURA N°"),0,0,'L');
        $pdf->SetFont('Arial','','8');
        $pdf->Cell(0,4,$numeroFactura,0,1,'L');
        
        $pdf->Cell(61,4,utf8_decode("No. Punto de Venta ".$codigoPuntoVenta),0,0,'C');
        $pdf->Cell(36,4,"",0,0,'C');
        $pdf->Cell(31,4,"",0,0,'C');
        $pdf->SetFont('Arial','B','8');
        $pdf->Cell(37,4,utf8_decode("CÓD. AUTORIZACIÓN"),0,0,'L');
        $pdf->SetFont('Arial','','8');
        $y = $pdf->GetY();
        $pdf->MultiCell(0,3.5,utf8_decode($cuf),0,'L');
        $pdf->SetY($y+4);
        $pdf->Cell(61,4,utf8_decode($direccion),0,1,'C');
        $pdf->Cell(61,4,utf8_decode("Teléfono: ".$telefono),0,1,'C');
        $pdf->Cell(61,4,utf8_decode($municipio),0,1,'C');
        $pdf->Ln(10);
        $pdf->SetFont('Arial','B','14');
        $pdf->Cell(0,4,utf8_decode("FACTURA"),0,1,'C');
        $pdf->SetFont('Arial','','9');
        $pdf->Cell(0,8,utf8_decode("(Con Derecho a Crédito Fiscal)"),0,1,'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial','B','9');
        $pdf->Cell(40,4,utf8_decode("Fecha:"),0,0,'L');
        $pdf->SetFont('Arial','','9');
        $pdf->Cell(97,4,utf8_decode($fechaEmision),0,0,'L');
        $pdf->SetFont('Arial','B','9');
        $pdf->Cell(30,4,utf8_decode("NIT/CI/CEX:   "),0,0,'R');
        $pdf->SetFont('Arial','','9');
        $pdf->Cell(0,4,utf8_decode($nitCliente),0,1,'L');

        $pdf->SetFont('Arial','B','9');
        $pdf->Cell(40,6,utf8_decode("Nombre/Razón Social:"),0,0,'L');
        $pdf->SetFont('Arial','','9');
        $pdf->Cell(97,6,utf8_decode($nombreRazonSocial),0,0,'L');
        $pdf->SetFont('Arial','B','9');
        $pdf->Cell(30,6,utf8_decode("Cod. Cliente:   "),0,0,'R');
        $pdf->SetFont('Arial','','9');
        $pdf->Cell(0,6,utf8_decode($codigoCliente),0,1,'L');
        $pdf->Ln(5);

        $pdf->SetFont('Arial','B','8');
        $y=$pdf->GetY();
        $x=$pdf->GetX();
        $pdf->MultiCell(30,4,utf8_decode("CÓDIGO PRODUCTO / SERVICIO"),1,'C');
        $pdf->SetY($y);
        $pdf->SetX($x+30);
        $pdf->MultiCell(20,4,utf8_decode("\nCANTIDAD\n "),1,'C');
        $pdf->SetY($y);
        $pdf->SetX($x+50);
        $pdf->MultiCell(20,4,utf8_decode("\nUNIDAD DE MEDIDA"),1,'C');
        $pdf->SetY($y);
        $pdf->SetX($x+70);
        $pdf->MultiCell(50,4,utf8_decode("\nDESCRIPCIÓN\n "),1,'C');
        $pdf->SetY($y);
        $pdf->SetX($x+120);
        $pdf->MultiCell(25,4,utf8_decode("\nPRECIO UNITARIO"),1,'C');
        $pdf->SetY($y);
        $pdf->SetX($x+145);
        $pdf->MultiCell(25,4,utf8_decode("\nDESCUENTO\n "),1,'C');
        $pdf->SetY($y);
        $pdf->SetX($x+170);
        $pdf->MultiCell(0,4,utf8_decode("\nSUBTOTAL\n "),1,'C');

        $pdf->SetFont('Arial','','8');

        $lista_productos = $archivoxml->detalle;
        $subTotal=0;
        foreach($lista_productos as $p){
            $pdf->Cell(30,7,utf8_decode($p->codigoProducto),1,0,'L');
            $pdf->Cell(20,7,number_format(floatval($p->cantidad),2),1,0,'R');
            $pdf->Cell(20,7,utf8_decode("UNIDAD"),1,0,'L');
            $pdf->Cell(50,7,utf8_decode($p->descripcion),1,0,'L');
            $pdf->Cell(25,7,number_format(floatval($p->precioUnitario),2),1,0,'R');
            $pdf->Cell(25,7,number_format(floatval($p->montoDescuento),2),1,0,'R');
            $pdf->Cell(0,7,number_format(floatval($p->subTotal),2),1,1,'R');
            $subTotal+=$p->subTotal;
        }   


        $pdf->Cell(120,4,"",0,0,'L');
        $pdf->SetFont('Arial','','7');
        $pdf->Cell(50,4,"SUBTOTAL Bs",1,0,'R');
        $pdf->SetFont('Arial','','8');
        $pdf->Cell(0,4,number_format($subTotal,2),1,1,'R');

        $pdf->Cell(120,4,"",0,0,'L');
        $pdf->SetFont('Arial','','7');
        $pdf->Cell(50,4,"DESCUENTO Bs",1,0,'R');
        $pdf->SetFont('Arial','','8');
        $pdf->Cell(0,4,number_format(floatval($descuentoAdicional),2),1,1,'R');

        $pdf->SetFont('Arial','B','8');
        $pdf->Cell(120,4,"Son: Trescientos nueve 51/100 Bolivianos",0,0,'L');
        $pdf->SetFont('Arial','','7');
        $pdf->Cell(50,4,"TOTAL Bs",1,0,'R');
        $pdf->SetFont('Arial','','8');
        $pdf->Cell(0,4,number_format(floatval($montoTotal),2),1,1,'R');

        $pdf->Cell(120,4,"",0,0,'L');
        $pdf->SetFont('Arial','','7');
        $pdf->Cell(50,4,"MONTO GIFT CARD Bs",1,0,'R');
        $pdf->SetFont('Arial','','8');
        $pdf->Cell(0,4,"0.00",1,1,'R');

        $pdf->Cell(120,4,"",0,0,'L');
        $pdf->SetFont('Arial','B','7');
        $pdf->Cell(50,4,"MONTO A PAGAR Bs",1,0,'R');
        $pdf->SetFont('Arial','B','8');
        $pdf->Cell(0,4,number_format(floatval($montoTotal),2),1,1,'R');

        $pdf->Cell(120,4,"",0,0,'L');
        $pdf->SetFont('Arial','B','7');
        $pdf->Cell(50,4,"IMPORTE BASE CRÉDITO FISCAL",1,0,'R');
        $pdf->SetFont('Arial','B','8');
        $pdf->Cell(0,4,number_format(floatval($montoTotalSujetoIva),2),1,1,'R');

        $pdf->Ln(6);
        $y=$pdf->GetY();
        $pdf->SetFont('Arial','','7');
        $pdf->Cell(170,7,utf8_decode("ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS, EL USO ILÍCITO SERÁ SANCIONADO PENALMENTE DE ACUERDO A LEY"),0,1,'C');
        $pdf->SetFont('Arial','','7.5');
        $pdf->Cell(170,5,utf8_decode("Ley N° 453: El proveedor deberá entregar el producto en las modalidades y términos ofertados o convenidos."),0,1,'C');
        $pdf->Cell(170,5,utf8_decode('"Este documento es la Representación Gráfica de un Documento Fiscal Digital emitido en una modalidad de facturación en línea"'),0,1,'C');

        $pdf->Image("Assets/img/qrfactura.png", 180, $y, 22);


        $pdf->Output();
    }
}
