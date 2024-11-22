<?php
class Siat
{
    public function verificarComunicacion()
    {
        $wsdl = "https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionCodigos?wsdl";
        $opciones = array(
            'http' => array(
                'header' => "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJzYW5keWVzcGVqb21heW9AZ21haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjdDOEM1NTBCRDY5OTkxNkUxN0MxRDc2Iiwibml0IjoiSDRzSUFBQUFBQUFBQURNeE1qRTNNRFF5TUxRQUFEYVlPLVlLQUFBQSIsImlkIjo1MjA5MzIxLCJleHAiOjE3MzI5ODU2OTksImlhdCI6MTczMTQ0NDg2OSwibml0RGVsZWdhZG8iOjQyNDcwMTIwMTgsInN1YnNpc3RlbWEiOiJTRkUifQ.ImDDhTvc438WJf4FoGKBfBLwQiPBFBizzwZt87tDmCBoTgpYIG4YiNKiiLKrpQTw91SFstFK_ClINYnQopiG-w",
                'timeout' => 5
            )
        );

        $contexto = stream_context_create($opciones);

        try {
            $cliente = new SoapClient(
                $wsdl,
                [
                    'stream_context' => $contexto,
                    'cache_wsdl' => WSDL_CACHE_NONE,
                    'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE
                ]
            );
            $resultado = $cliente->verificarComunicacion();
        } catch (SoapFault $e) {
            $resultado = false;
        }
        return $resultado;
    }

    public function cuis()
    {
        $wsdl = "https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionCodigos?wsdl";

        $codigoAmbiente = 2;
        $codigoModalidad = 2;
        $codigoPuntoVenta = 0;
        $codigoSistema = "7C8C550BD699916E17C1D76";
        $codigoSucursal = 0;
        $nit = "4247012018";

        $parametros = array(
            'SolicitudCuis' => array(
                'codigoAmbiente' => $codigoAmbiente,
                'codigoModalidad' => $codigoModalidad,
                'codigoPuntoVenta' => $codigoPuntoVenta,
                'codigoSistema' => $codigoSistema,
                'codigoSucursal' => $codigoSucursal,
                'nit' => $nit
            )
        );

        $opciones = array(
            'http' => array(
                'header' => "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJzYW5keWVzcGVqb21heW9AZ21haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjdDOEM1NTBCRDY5OTkxNkUxN0MxRDc2Iiwibml0IjoiSDRzSUFBQUFBQUFBQURNeE1qRTNNRFF5TUxRQUFEYVlPLVlLQUFBQSIsImlkIjo1MjA5MzIxLCJleHAiOjE3MzI5ODU2OTksImlhdCI6MTczMTQ0NDg2OSwibml0RGVsZWdhZG8iOjQyNDcwMTIwMTgsInN1YnNpc3RlbWEiOiJTRkUifQ.ImDDhTvc438WJf4FoGKBfBLwQiPBFBizzwZt87tDmCBoTgpYIG4YiNKiiLKrpQTw91SFstFK_ClINYnQopiG-w",
                'timeout' => 5
            )
        );

        $contexto = stream_context_create($opciones);

        try {
            $cliente = new SoapClient(
                $wsdl,
                [
                    'stream_context' => $contexto,
                    'cache_wsdl' => WSDL_CACHE_NONE,
                    'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE
                ]
            );
            $resultado = $cliente->cuis($parametros);
        } catch (SoapFault $e) {
            $resultado = false;
        }
        return $resultado;
    }

    public function cufd()
    {
        $wsdl = "https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionCodigos?wsdl";

        $codigoAmbiente = 2;
        $codigoModalidad = 2;
        $codigoPuntoVenta = 0;
        $codigoSistema = "7C8C550BD699916E17C1D76";
        $codigoSucursal = 0;
        $cuis = $_SESSION['scuis'];
        $nit = "4247012018";

        $parametros = array(
            'SolicitudCufd' => array(
                'codigoAmbiente' => $codigoAmbiente,
                'codigoModalidad' => $codigoModalidad,
                'codigoPuntoVenta' => $codigoPuntoVenta,
                'codigoSistema' => $codigoSistema,
                'codigoSucursal' => $codigoSucursal,
                'cuis' => $cuis,
                'nit' => $nit
            )
        );

        $opciones = array(
            'http' => array(
                'header' => "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJzYW5keWVzcGVqb21heW9AZ21haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjdDOEM1NTBCRDY5OTkxNkUxN0MxRDc2Iiwibml0IjoiSDRzSUFBQUFBQUFBQURNeE1qRTNNRFF5TUxRQUFEYVlPLVlLQUFBQSIsImlkIjo1MjA5MzIxLCJleHAiOjE3MzI5ODU2OTksImlhdCI6MTczMTQ0NDg2OSwibml0RGVsZWdhZG8iOjQyNDcwMTIwMTgsInN1YnNpc3RlbWEiOiJTRkUifQ.ImDDhTvc438WJf4FoGKBfBLwQiPBFBizzwZt87tDmCBoTgpYIG4YiNKiiLKrpQTw91SFstFK_ClINYnQopiG-w",
                'timeout' => 5
            )
        );

        $contexto = stream_context_create($opciones);

        try {
            $cliente = new SoapClient(
                $wsdl,
                [
                    'stream_context' => $contexto,
                    'cache_wsdl' => WSDL_CACHE_NONE,
                    'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE
                ]
            );
            $resultado = $cliente->cufd($parametros);
        } catch (SoapFault $e) {
            $resultado = false;
        }
        return $resultado;
    }

    public function sincronizarActividades()
    {
        $wsdl = "https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionSincronizacion?wsdl";

        $codigoAmbiente = 2;
        $codigoPuntoVenta = 0;
        $codigoSistema = "7C8C550BD699916E17C1D76";
        $codigoSucursal = 0;
        $cuis = $_SESSION['scuis'];
        $nit = "4247012018";

        $parametros = array(
            'SolicitudSincronizacion' => array(
                'codigoAmbiente' => $codigoAmbiente,
                'codigoPuntoVenta' => $codigoPuntoVenta,
                'codigoSistema' => $codigoSistema,
                'codigoSucursal' => $codigoSucursal,
                'cuis' => $cuis,
                'nit' => $nit
            )
        );

        $opciones = array(
            'http' => array(
                'header' => "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJzYW5keWVzcGVqb21heW9AZ21haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjdDOEM1NTBCRDY5OTkxNkUxN0MxRDc2Iiwibml0IjoiSDRzSUFBQUFBQUFBQURNeE1qRTNNRFF5TUxRQUFEYVlPLVlLQUFBQSIsImlkIjo1MjA5MzIxLCJleHAiOjE3MzI5ODU2OTksImlhdCI6MTczMTQ0NDg2OSwibml0RGVsZWdhZG8iOjQyNDcwMTIwMTgsInN1YnNpc3RlbWEiOiJTRkUifQ.ImDDhTvc438WJf4FoGKBfBLwQiPBFBizzwZt87tDmCBoTgpYIG4YiNKiiLKrpQTw91SFstFK_ClINYnQopiG-w",
                'timeout' => 5
            )
        );

        $contexto = stream_context_create($opciones);

        try {
            $cliente = new SoapClient(
                $wsdl,
                [
                    'stream_context' => $contexto,
                    'cache_wsdl' => WSDL_CACHE_NONE,
                    'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE
                ]
            );
            $resultado = $cliente->sincronizarActividades($parametros);
        } catch (SoapFault $e) {
            $resultado = false;
        }
        return $resultado;
    }

    public function sincronizarListaProductosServicios()
    {
        $wsdl = "https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionSincronizacion?wsdl";

        $codigoAmbiente = 2;
        $codigoPuntoVenta = 0;
        $codigoSistema = "7C8C550BD699916E17C1D76";
        $codigoSucursal = 0;
        $cuis = $_SESSION['scuis'];
        $nit = "4247012018";

        $parametros = array(
            'SolicitudSincronizacion' => array(
                'codigoAmbiente' => $codigoAmbiente,
                'codigoPuntoVenta' => $codigoPuntoVenta,
                'codigoSistema' => $codigoSistema,
                'codigoSucursal' => $codigoSucursal,
                'cuis' => $cuis,
                'nit' => $nit
            )
        );

        $opciones = array(
            'http' => array(
                'header' => "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJzYW5keWVzcGVqb21heW9AZ21haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjdDOEM1NTBCRDY5OTkxNkUxN0MxRDc2Iiwibml0IjoiSDRzSUFBQUFBQUFBQURNeE1qRTNNRFF5TUxRQUFEYVlPLVlLQUFBQSIsImlkIjo1MjA5MzIxLCJleHAiOjE3MzI5ODU2OTksImlhdCI6MTczMTQ0NDg2OSwibml0RGVsZWdhZG8iOjQyNDcwMTIwMTgsInN1YnNpc3RlbWEiOiJTRkUifQ.ImDDhTvc438WJf4FoGKBfBLwQiPBFBizzwZt87tDmCBoTgpYIG4YiNKiiLKrpQTw91SFstFK_ClINYnQopiG-w",
                'timeout' => 5
            )
        );

        $contexto = stream_context_create($opciones);

        try {
            $cliente = new SoapClient(
                $wsdl,
                [
                    'stream_context' => $contexto,
                    'cache_wsdl' => WSDL_CACHE_NONE,
                    'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE
                ]
            );
            $resultado = $cliente->sincronizarListaProductosServicios($parametros);
        } catch (SoapFault $e) {
            $resultado = false;
        }
        return $resultado;
    }

    public function sincronizarListaLeyendasFactura()
    {
        $wsdl = "https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionSincronizacion?wsdl";

        $codigoAmbiente = 2;
        $codigoPuntoVenta = 0;
        $codigoSistema = "7C8C550BD699916E17C1D76";
        $codigoSucursal = 0;
        $cuis = $_SESSION['scuis'];
        $nit = "4247012018";

        $parametros = array(
            'SolicitudSincronizacion' => array(
                'codigoAmbiente' => $codigoAmbiente,
                'codigoPuntoVenta' => $codigoPuntoVenta,
                'codigoSistema' => $codigoSistema,
                'codigoSucursal' => $codigoSucursal,
                'cuis' => $cuis,
                'nit' => $nit
            )
        );

        $opciones = array(
            'http' => array(
                'header' => "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJzYW5keWVzcGVqb21heW9AZ21haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjdDOEM1NTBCRDY5OTkxNkUxN0MxRDc2Iiwibml0IjoiSDRzSUFBQUFBQUFBQURNeE1qRTNNRFF5TUxRQUFEYVlPLVlLQUFBQSIsImlkIjo1MjA5MzIxLCJleHAiOjE3MzI5ODU2OTksImlhdCI6MTczMTQ0NDg2OSwibml0RGVsZWdhZG8iOjQyNDcwMTIwMTgsInN1YnNpc3RlbWEiOiJTRkUifQ.ImDDhTvc438WJf4FoGKBfBLwQiPBFBizzwZt87tDmCBoTgpYIG4YiNKiiLKrpQTw91SFstFK_ClINYnQopiG-w",
                'timeout' => 5
            )
        );

        $contexto = stream_context_create($opciones);

        try {
            $cliente = new SoapClient(
                $wsdl,
                [
                    'stream_context' => $contexto,
                    'cache_wsdl' => WSDL_CACHE_NONE,
                    'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE
                ]
            );
            $resultado = $cliente->sincronizarListaLeyendasFactura($parametros);
        } catch (SoapFault $e) {
            $resultado = false;
        }
        return $resultado;
    }

    public function sincronizarParametricaTipoDocumentoIdentidad()
    {
        $wsdl = "https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionSincronizacion?wsdl";

        $codigoAmbiente = 2;
        $codigoPuntoVenta = 0;
        $codigoSistema = "7C8C550BD699916E17C1D76";
        $codigoSucursal = 0;
        $cuis = $_SESSION['scuis'];
        $nit = "4247012018";

        $parametros = array(
            'SolicitudSincronizacion' => array(
                'codigoAmbiente' => $codigoAmbiente,
                'codigoPuntoVenta' => $codigoPuntoVenta,
                'codigoSistema' => $codigoSistema,
                'codigoSucursal' => $codigoSucursal,
                'cuis' => $cuis,
                'nit' => $nit
            )
        );

        $opciones = array(
            'http' => array(
                'header' => "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJzYW5keWVzcGVqb21heW9AZ21haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjdDOEM1NTBCRDY5OTkxNkUxN0MxRDc2Iiwibml0IjoiSDRzSUFBQUFBQUFBQURNeE1qRTNNRFF5TUxRQUFEYVlPLVlLQUFBQSIsImlkIjo1MjA5MzIxLCJleHAiOjE3MzI5ODU2OTksImlhdCI6MTczMTQ0NDg2OSwibml0RGVsZWdhZG8iOjQyNDcwMTIwMTgsInN1YnNpc3RlbWEiOiJTRkUifQ.ImDDhTvc438WJf4FoGKBfBLwQiPBFBizzwZt87tDmCBoTgpYIG4YiNKiiLKrpQTw91SFstFK_ClINYnQopiG-w",
                'timeout' => 5
            )
        );

        $contexto = stream_context_create($opciones);

        try {
            $cliente = new SoapClient(
                $wsdl,
                [
                    'stream_context' => $contexto,
                    'cache_wsdl' => WSDL_CACHE_NONE,
                    'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE
                ]
            );
            $resultado = $cliente->sincronizarParametricaTipoDocumentoIdentidad($parametros);
        } catch (SoapFault $e) {
            $resultado = false;
        }
        return $resultado;
    }

    public function sincronizarParametricaTipoMetodoPago()
    {
        $wsdl = "https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionSincronizacion?wsdl";

        $codigoAmbiente = 2;
        $codigoPuntoVenta = 0;
        $codigoSistema = "7C8C550BD699916E17C1D76";
        $codigoSucursal = 0;
        $cuis = $_SESSION['scuis'];
        $nit = "4247012018";

        $parametros = array(
            'SolicitudSincronizacion' => array(
                'codigoAmbiente' => $codigoAmbiente,
                'codigoPuntoVenta' => $codigoPuntoVenta,
                'codigoSistema' => $codigoSistema,
                'codigoSucursal' => $codigoSucursal,
                'cuis' => $cuis,
                'nit' => $nit
            )
        );

        $opciones = array(
            'http' => array(
                'header' => "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJzYW5keWVzcGVqb21heW9AZ21haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjdDOEM1NTBCRDY5OTkxNkUxN0MxRDc2Iiwibml0IjoiSDRzSUFBQUFBQUFBQURNeE1qRTNNRFF5TUxRQUFEYVlPLVlLQUFBQSIsImlkIjo1MjA5MzIxLCJleHAiOjE3MzI5ODU2OTksImlhdCI6MTczMTQ0NDg2OSwibml0RGVsZWdhZG8iOjQyNDcwMTIwMTgsInN1YnNpc3RlbWEiOiJTRkUifQ.ImDDhTvc438WJf4FoGKBfBLwQiPBFBizzwZt87tDmCBoTgpYIG4YiNKiiLKrpQTw91SFstFK_ClINYnQopiG-w",
                'timeout' => 5
            )
        );

        $contexto = stream_context_create($opciones);

        try {
            $cliente = new SoapClient(
                $wsdl,
                [
                    'stream_context' => $contexto,
                    'cache_wsdl' => WSDL_CACHE_NONE,
                    'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE
                ]
            );
            $resultado = $cliente->sincronizarParametricaTipoMetodoPago($parametros);
        } catch (SoapFault $e) {
            $resultado = false;
        }
        return $resultado;
    }

    public function sincronizarParametricaUnidadMedida()
    {
        $wsdl = "https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionSincronizacion?wsdl";

        $codigoAmbiente = 2;
        $codigoPuntoVenta = 0;
        $codigoSistema = "7C8C550BD699916E17C1D76";
        $codigoSucursal = 0;
        $cuis = $_SESSION['scuis'];
        $nit = "4247012018";

        $parametros = array(
            'SolicitudSincronizacion' => array(
                'codigoAmbiente' => $codigoAmbiente,
                'codigoPuntoVenta' => $codigoPuntoVenta,
                'codigoSistema' => $codigoSistema,
                'codigoSucursal' => $codigoSucursal,
                'cuis' => $cuis,
                'nit' => $nit
            )
        );

        $opciones = array(
            'http' => array(
                'header' => "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJzYW5keWVzcGVqb21heW9AZ21haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjdDOEM1NTBCRDY5OTkxNkUxN0MxRDc2Iiwibml0IjoiSDRzSUFBQUFBQUFBQURNeE1qRTNNRFF5TUxRQUFEYVlPLVlLQUFBQSIsImlkIjo1MjA5MzIxLCJleHAiOjE3MzI5ODU2OTksImlhdCI6MTczMTQ0NDg2OSwibml0RGVsZWdhZG8iOjQyNDcwMTIwMTgsInN1YnNpc3RlbWEiOiJTRkUifQ.ImDDhTvc438WJf4FoGKBfBLwQiPBFBizzwZt87tDmCBoTgpYIG4YiNKiiLKrpQTw91SFstFK_ClINYnQopiG-w",
                'timeout' => 5
            )
        );

        $contexto = stream_context_create($opciones);

        try {
            $cliente = new SoapClient(
                $wsdl,
                [
                    'stream_context' => $contexto,
                    'cache_wsdl' => WSDL_CACHE_NONE,
                    'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE
                ]
            );
            $resultado = $cliente->sincronizarParametricaUnidadMedida($parametros);
        } catch (SoapFault $e) {
            $resultado = false;
        }
        return $resultado;
    }

    public function recepcionFactura($archivo, $fechaEmision, $hashArchivo)
    {
        $wsdl = "https://pilotosiatservicios.impuestos.gob.bo/v2/ServicioFacturacionCompraVenta?wsdl";

        $codigoAmbiente = 2;
        $codigoDocumentoSector = 1;
        $codigoEmision = 1;
        $codigoModalidad = 2;
        $codigoPuntoVenta = 0;
        $codigoSistema = "7C8C550BD699916E17C1D76";
        $codigoSucursal = 0;
        $cufd = $_SESSION['scufd'];
        $cuis = $_SESSION['scuis'];
        $nit = "4247012018";
        $tipoFacturaDocumento = 1;
        $archivo = $archivo;
        $fechaEnvio = $fechaEmision;
        $hashArchivo = $hashArchivo;

        $parametros = array(
            'SolicitudServicioRecepcionFactura' => array(
                'codigoAmbiente' => $codigoAmbiente,
                'codigoDocumentoSector' => $codigoDocumentoSector,
                'codigoEmision' => $codigoEmision,
                'codigoModalidad' => $codigoModalidad,
                'codigoPuntoVenta' => $codigoPuntoVenta,
                'codigoSistema' => $codigoSistema,
                'codigoSucursal' => $codigoSucursal,
                'cufd' => $cufd,
                'cuis' => $cuis,
                'nit' => $nit,
                'tipoFacturaDocumento' => $tipoFacturaDocumento,
                'archivo' => $archivo,
                'fechaEnvio' => $fechaEnvio,
                'hashArchivo' => $hashArchivo
            )
        );

        $opciones = array(
            'http' => array(
                'header' => "apikey: TokenApi eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJzYW5keWVzcGVqb21heW9AZ21haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjdDOEM1NTBCRDY5OTkxNkUxN0MxRDc2Iiwibml0IjoiSDRzSUFBQUFBQUFBQURNeE1qRTNNRFF5TUxRQUFEYVlPLVlLQUFBQSIsImlkIjo1MjA5MzIxLCJleHAiOjE3MzI5ODU2OTksImlhdCI6MTczMTQ0NDg2OSwibml0RGVsZWdhZG8iOjQyNDcwMTIwMTgsInN1YnNpc3RlbWEiOiJTRkUifQ.ImDDhTvc438WJf4FoGKBfBLwQiPBFBizzwZt87tDmCBoTgpYIG4YiNKiiLKrpQTw91SFstFK_ClINYnQopiG-w",
                'timeout' => 5
            )
        );

        $contexto = stream_context_create($opciones);

        try {
            $cliente = new SoapClient(
                $wsdl,
                [
                    'stream_context' => $contexto,
                    'cache_wsdl' => WSDL_CACHE_NONE,
                    'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE
                ]
            );
            $resultado = $cliente->recepcionFactura($parametros);
        } catch (SoapFault $e) {
            $resultado = false;
        }
        return $resultado;
    }
}
