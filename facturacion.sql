-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2024 a las 02:58:38
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `facturacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

CREATE TABLE `cajas` (
  `id_caja` int(11) NOT NULL,
  `caja` varchar(20) NOT NULL,
  `caja_estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cajas`
--

INSERT INTO `cajas` (`id_caja`, `caja`, `caja_estado`) VALUES
(1, 'CAJA 1', 1),
(2, 'CAJA 2', 1),
(3, 'Caja 3', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL,
  `codigoProductoSin` int(11) NOT NULL,
  `categoria_estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `codigoProductoSin`, `categoria_estado`) VALUES
(1, 'GASEOSAS SIN ALCOHOL', 82221, 1),
(2, 'ABARROTES', 82310, 1),
(3, 'HERRAMIENTAS', 99100, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `documentoid` varchar(20) NOT NULL,
  `complementoid` varchar(10) DEFAULT NULL,
  `razon_social` varchar(255) NOT NULL,
  `cliente_email` varchar(100) NOT NULL,
  `tipo_documento` int(11) NOT NULL,
  `cliente_estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `documentoid`, `complementoid`, `razon_social`, `cliente_email`, `tipo_documento`, `cliente_estado`) VALUES
(1, '456687', 'AE', 'Molina', 'molina@gmail.com', 1, 1),
(2, '1005447026', '', 'FARMACORP S.A.', 'farmacorp@gmail.com', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `numeroFactura` int(11) NOT NULL,
  `cuf` varchar(255) NOT NULL,
  `fechaEmision` datetime NOT NULL,
  `codigoMetodoPago` int(11) NOT NULL,
  `MontoTotal` decimal(10,0) NOT NULL,
  `MontoTotalSujetoIva` decimal(10,2) NOT NULL,
  `descuentoAdicional` decimal(10,2) NOT NULL,
  `productos` text NOT NULL,
  `codigoRecepcion` varchar(50) NOT NULL,
  `factura_estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id_factura`, `id_cliente`, `numeroFactura`, `cuf`, `fechaEmision`, `codigoMetodoPago`, `MontoTotal`, `MontoTotalSujetoIva`, `descuentoAdicional`, `productos`, `codigoRecepcion`, `factura_estado`) VALUES
(2, 2, 12, '12297A48A81D2F8B3FC9E67A509745660D29796CF8124685D349039E74', '2024-11-18 20:44:39', 1, '8', '8.00', '0.00', '<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n<facturaComputarizadaCompraVenta xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"facturaComputarizadaCompraVenta.xsd\"><cabecera><nitEmisor>4247012018</nitEmisor><razonSocialEmisor>INDEX INGENIERIA</razonSocialEmisor><municipio>Santa Cruz</municipio><telefono>71536202</telefono><numeroFactura>12</numeroFactura><cuf>12297A48A81D2F8B3FC9E67A509745660D29796CF8124685D349039E74</cuf><cufd>BQT5CTcKhWUVBN0TE2RTE3QzFENzY=Q28nR01VVExZVUFM4QzU1MEJENjk5O</cufd><codigoSucursal>0</codigoSucursal><direccion>AV. 20 de octubre 1589</direccion><codigoPuntoVenta>0</codigoPuntoVenta><fechaEmision>2024-11-18T20:44:39.706</fechaEmision><nombreRazonSocial>FARMACORP S.A.</nombreRazonSocial><codigoTipoDocumentoIdentidad>5</codigoTipoDocumentoIdentidad><numeroDocumento>1005447026</numeroDocumento><complemento xsi:nil=\"true\"/><codigoCliente>1005447026</codigoCliente><codigoMetodoPago>1</codigoMetodoPago><numeroTarjeta xsi:nil=\"true\"/><montoTotal>8.00</montoTotal><montoTotalSujetoIva>8.00</montoTotalSujetoIva><codigoMoneda>1</codigoMoneda><tipoCambio>1</tipoCambio><montoTotalMoneda>8.00</montoTotalMoneda><montoGiftCard xsi:nil=\"true\"/><descuentoAdicional>0.00</descuentoAdicional><codigoExcepcion>1</codigoExcepcion><cafc xsi:nil=\"true\"/><leyenda>Ley N° 453: El proveedor de servicios debe habilitar medios e instrumentos para efectuar consultas y reclamaciones.</leyenda><usuario>Administrador</usuario><codigoDocumentoSector>1</codigoDocumentoSector></cabecera><detalle><actividadEconomica>692000</actividadEconomica><codigoProductoSin>82310</codigoProductoSin><codigoProducto>AB-1</codigoProducto><descripcion>Arroz 1 Kilo</descripcion><cantidad>1.00</cantidad><unidadMedida>22</unidadMedida><precioUnitario>8.00</precioUnitario><montoDescuento>0.00</montoDescuento><subTotal>8.00</subTotal><numeroSerie xsi:nil=\"true\"/><numeroImei xsi:nil=\"true\"/></detalle></facturaComputarizadaCompraVenta>\n', '760d553b-a60f-11ef-a245-5bcbdc9b3bda', 1),
(3, 2, 13, '12297A48A81D2F8B40CE84CC4CF410CD66AAF98562724685D349039E74', '2024-11-18 20:57:30', 1, '8', '8.00', '0.00', '<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n<facturaComputarizadaCompraVenta xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"facturaComputarizadaCompraVenta.xsd\"><cabecera><nitEmisor>4247012018</nitEmisor><razonSocialEmisor>INDEX INGENIERIA</razonSocialEmisor><municipio>Santa Cruz</municipio><telefono>71536202</telefono><numeroFactura>13</numeroFactura><cuf>12297A48A81D2F8B40CE84CC4CF410CD66AAF98562724685D349039E74</cuf><cufd>BQT5CTcKhWUVBN0TE2RTE3QzFENzY=Q28nR01VVExZVUFM4QzU1MEJENjk5O</cufd><codigoSucursal>0</codigoSucursal><direccion>AV. 20 de octubre 1589</direccion><codigoPuntoVenta>0</codigoPuntoVenta><fechaEmision>2024-11-18T20:57:30.226</fechaEmision><nombreRazonSocial>FARMACORP S.A.</nombreRazonSocial><codigoTipoDocumentoIdentidad>1</codigoTipoDocumentoIdentidad><numeroDocumento>1005447026</numeroDocumento><complemento xsi:nil=\"true\"/><codigoCliente>1005447026</codigoCliente><codigoMetodoPago>1</codigoMetodoPago><numeroTarjeta xsi:nil=\"true\"/><montoTotal>8.00</montoTotal><montoTotalSujetoIva>8.00</montoTotalSujetoIva><codigoMoneda>1</codigoMoneda><tipoCambio>1</tipoCambio><montoTotalMoneda>8.00</montoTotalMoneda><montoGiftCard xsi:nil=\"true\"/><descuentoAdicional>0.00</descuentoAdicional><codigoExcepcion>0</codigoExcepcion><cafc xsi:nil=\"true\"/><leyenda>Ley N° 453: El proveedor de servicios debe habilitar medios e instrumentos para efectuar consultas y reclamaciones.</leyenda><usuario>Administrador</usuario><codigoDocumentoSector>1</codigoDocumentoSector></cabecera><detalle><actividadEconomica>692000</actividadEconomica><codigoProductoSin>82310</codigoProductoSin><codigoProducto>AB-1</codigoProducto><descripcion>Arroz 1 Kilo</descripcion><cantidad>1.00</cantidad><unidadMedida>22</unidadMedida><precioUnitario>8.00</precioUnitario><montoDescuento>0.00</montoDescuento><subTotal>8.00</subTotal><numeroSerie xsi:nil=\"true\"/><numeroImei xsi:nil=\"true\"/></detalle></facturaComputarizadaCompraVenta>\n', '4156d8a0-a611-11ef-917d-f7c7bbad4929', 1),
(4, 2, 13, '12297A48A81D2F8B40CF6415CA267003379EE98562524685D349039E74', '2024-11-18 20:57:34', 1, '8', '8.00', '0.00', '<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n<facturaComputarizadaCompraVenta xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"facturaComputarizadaCompraVenta.xsd\"><cabecera><nitEmisor>4247012018</nitEmisor><razonSocialEmisor>INDEX INGENIERIA</razonSocialEmisor><municipio>Santa Cruz</municipio><telefono>71536202</telefono><numeroFactura>13</numeroFactura><cuf>12297A48A81D2F8B40CF6415CA267003379EE98562524685D349039E74</cuf><cufd>BQT5CTcKhWUVBN0TE2RTE3QzFENzY=Q28nR01VVExZVUFM4QzU1MEJENjk5O</cufd><codigoSucursal>0</codigoSucursal><direccion>AV. 20 de octubre 1589</direccion><codigoPuntoVenta>0</codigoPuntoVenta><fechaEmision>2024-11-18T20:57:34.545</fechaEmision><nombreRazonSocial>FARMACORP S.A.</nombreRazonSocial><codigoTipoDocumentoIdentidad>1</codigoTipoDocumentoIdentidad><numeroDocumento>1005447026</numeroDocumento><complemento xsi:nil=\"true\"/><codigoCliente>1005447026</codigoCliente><codigoMetodoPago>1</codigoMetodoPago><numeroTarjeta xsi:nil=\"true\"/><montoTotal>8.00</montoTotal><montoTotalSujetoIva>8.00</montoTotalSujetoIva><codigoMoneda>1</codigoMoneda><tipoCambio>1</tipoCambio><montoTotalMoneda>8.00</montoTotalMoneda><montoGiftCard xsi:nil=\"true\"/><descuentoAdicional>0.00</descuentoAdicional><codigoExcepcion>0</codigoExcepcion><cafc xsi:nil=\"true\"/><leyenda>Ley N° 453: El proveedor de servicios debe habilitar medios e instrumentos para efectuar consultas y reclamaciones.</leyenda><usuario>Administrador</usuario><codigoDocumentoSector>1</codigoDocumentoSector></cabecera><detalle><actividadEconomica>692000</actividadEconomica><codigoProductoSin>82310</codigoProductoSin><codigoProducto>AB-1</codigoProducto><descripcion>Arroz 1 Kilo</descripcion><cantidad>1.00</cantidad><unidadMedida>22</unidadMedida><precioUnitario>8.00</precioUnitario><montoDescuento>0.00</montoDescuento><subTotal>8.00</subTotal><numeroSerie xsi:nil=\"true\"/><numeroImei xsi:nil=\"true\"/></detalle></facturaComputarizadaCompraVenta>\n', '43e01bbe-a611-11ef-a4be-218065ff3432', 1),
(5, 2, 13, '12297A48A81D2F8B40CFF6E8E06E5319FAC0698562824685D349039E74', '2024-11-18 20:57:37', 1, '8', '8.00', '0.00', '<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n<facturaComputarizadaCompraVenta xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"facturaComputarizadaCompraVenta.xsd\"><cabecera><nitEmisor>4247012018</nitEmisor><razonSocialEmisor>INDEX INGENIERIA</razonSocialEmisor><municipio>Santa Cruz</municipio><telefono>71536202</telefono><numeroFactura>13</numeroFactura><cuf>12297A48A81D2F8B40CFF6E8E06E5319FAC0698562824685D349039E74</cuf><cufd>BQT5CTcKhWUVBN0TE2RTE3QzFENzY=Q28nR01VVExZVUFM4QzU1MEJENjk5O</cufd><codigoSucursal>0</codigoSucursal><direccion>AV. 20 de octubre 1589</direccion><codigoPuntoVenta>0</codigoPuntoVenta><fechaEmision>2024-11-18T20:57:37.385</fechaEmision><nombreRazonSocial>FARMACORP S.A.</nombreRazonSocial><codigoTipoDocumentoIdentidad>1</codigoTipoDocumentoIdentidad><numeroDocumento>1005447026</numeroDocumento><complemento xsi:nil=\"true\"/><codigoCliente>1005447026</codigoCliente><codigoMetodoPago>1</codigoMetodoPago><numeroTarjeta xsi:nil=\"true\"/><montoTotal>8.00</montoTotal><montoTotalSujetoIva>8.00</montoTotalSujetoIva><codigoMoneda>1</codigoMoneda><tipoCambio>1</tipoCambio><montoTotalMoneda>8.00</montoTotalMoneda><montoGiftCard xsi:nil=\"true\"/><descuentoAdicional>0.00</descuentoAdicional><codigoExcepcion>0</codigoExcepcion><cafc xsi:nil=\"true\"/><leyenda>Ley N° 453: El proveedor de servicios debe habilitar medios e instrumentos para efectuar consultas y reclamaciones.</leyenda><usuario>Administrador</usuario><codigoDocumentoSector>1</codigoDocumentoSector></cabecera><detalle><actividadEconomica>692000</actividadEconomica><codigoProductoSin>82310</codigoProductoSin><codigoProducto>AB-1</codigoProducto><descripcion>Arroz 1 Kilo</descripcion><cantidad>1.00</cantidad><unidadMedida>22</unidadMedida><precioUnitario>8.00</precioUnitario><montoDescuento>0.00</montoDescuento><subTotal>8.00</subTotal><numeroSerie xsi:nil=\"true\"/><numeroImei xsi:nil=\"true\"/></detalle></facturaComputarizadaCompraVenta>\n', '4597b64b-a611-11ef-8ef2-0905fd039493', 1),
(6, 1, 15, '12297A48A81D2F8B40FCDA916AA01FFC552EF9B636924685D349039E74', '2024-11-18 20:59:59', 1, '48', '48.00', '0.00', '<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n<facturaComputarizadaCompraVenta xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"facturaComputarizadaCompraVenta.xsd\"><cabecera><nitEmisor>4247012018</nitEmisor><razonSocialEmisor>INDEX INGENIERIA</razonSocialEmisor><municipio>Santa Cruz</municipio><telefono>71536202</telefono><numeroFactura>15</numeroFactura><cuf>12297A48A81D2F8B40FCDA916AA01FFC552EF9B636924685D349039E74</cuf><cufd>BQT5CTcKhWUVBN0TE2RTE3QzFENzY=Q28nR01VVExZVUFM4QzU1MEJENjk5O</cufd><codigoSucursal>0</codigoSucursal><direccion>AV. 20 de octubre 1589</direccion><codigoPuntoVenta>0</codigoPuntoVenta><fechaEmision>2024-11-18T20:59:59.666</fechaEmision><nombreRazonSocial>Molina</nombreRazonSocial><codigoTipoDocumentoIdentidad>1</codigoTipoDocumentoIdentidad><numeroDocumento>456687</numeroDocumento><complemento>AE</complemento><codigoCliente>456687</codigoCliente><codigoMetodoPago>1</codigoMetodoPago><numeroTarjeta xsi:nil=\"true\"/><montoTotal>48.00</montoTotal><montoTotalSujetoIva>48.00</montoTotalSujetoIva><codigoMoneda>1</codigoMoneda><tipoCambio>1</tipoCambio><montoTotalMoneda>48.00</montoTotalMoneda><montoGiftCard xsi:nil=\"true\"/><descuentoAdicional>0.00</descuentoAdicional><codigoExcepcion>0</codigoExcepcion><cafc xsi:nil=\"true\"/><leyenda>Ley N° 453: El proveedor de servicios debe habilitar medios e instrumentos para efectuar consultas y reclamaciones.</leyenda><usuario>Administrador</usuario><codigoDocumentoSector>1</codigoDocumentoSector></cabecera><detalle><actividadEconomica>692000</actividadEconomica><codigoProductoSin>82310</codigoProductoSin><codigoProducto>ab-1</codigoProducto><descripcion>Arroz 1 Kilo</descripcion><cantidad>1.00</cantidad><unidadMedida>22</unidadMedida><precioUnitario>8.00</precioUnitario><montoDescuento>0.00</montoDescuento><subTotal>8.00</subTotal><numeroSerie xsi:nil=\"true\"/><numeroImei xsi:nil=\"true\"/></detalle><detalle><actividadEconomica>692000</actividadEconomica><codigoProductoSin>99100</codigoProductoSin><codigoProducto>HE-1</codigoProducto><descripcion>Alicate de punta</descripcion><cantidad>1.00</cantidad><unidadMedida>57</unidadMedida><precioUnitario>40.00</precioUnitario><montoDescuento>0.00</montoDescuento><subTotal>40.00</subTotal><numeroSerie xsi:nil=\"true\"/><numeroImei xsi:nil=\"true\"/></detalle></facturaComputarizadaCompraVenta>\n', '9a66fce8-a611-11ef-82f3-c96fb844b34a', 1),
(7, 1, 20, '12297A48A81D2F916DE946F0F3D73BB957F93A304859970B6BB0139E74', '2024-11-20 21:00:18', 1, '172', '171.70', '1.25', '<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n<facturaComputarizadaCompraVenta xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"facturaComputarizadaCompraVenta.xsd\"><cabecera><nitEmisor>4247012018</nitEmisor><razonSocialEmisor>INDEX INGENIERIA</razonSocialEmisor><municipio>Santa Cruz</municipio><telefono>71536202</telefono><numeroFactura>20</numeroFactura><cuf>12297A48A81D2F916DE946F0F3D73BB957F93A304859970B6BB0139E74</cuf><cufd>QUE+Qk3CoVlFQQ==OTE2RTE3QzFENzY=Q2XDjXY1VVZMWVVBN0M4QzU1MEJENjk5</cufd><codigoSucursal>0</codigoSucursal><direccion>AV. 20 de octubre 1589</direccion><codigoPuntoVenta>0</codigoPuntoVenta><fechaEmision>2024-11-20T21:00:18.326</fechaEmision><nombreRazonSocial>Molina</nombreRazonSocial><codigoTipoDocumentoIdentidad>1</codigoTipoDocumentoIdentidad><numeroDocumento>456687</numeroDocumento><complemento>AE</complemento><codigoCliente>456687</codigoCliente><codigoMetodoPago>1</codigoMetodoPago><numeroTarjeta xsi:nil=\"true\"/><montoTotal>171.70</montoTotal><montoTotalSujetoIva>171.70</montoTotalSujetoIva><codigoMoneda>1</codigoMoneda><tipoCambio>1</tipoCambio><montoTotalMoneda>171.70</montoTotalMoneda><montoGiftCard xsi:nil=\"true\"/><descuentoAdicional>1.25</descuentoAdicional><codigoExcepcion>0</codigoExcepcion><cafc xsi:nil=\"true\"/><leyenda>Ley N° 453: El proveedor de servicios debe habilitar medios e instrumentos para efectuar consultas y reclamaciones.</leyenda><usuario>Administrador</usuario><codigoDocumentoSector>1</codigoDocumentoSector></cabecera><detalle><actividadEconomica>692000</actividadEconomica><codigoProductoSin>82310</codigoProductoSin><codigoProducto>AB-1</codigoProducto><descripcion>Arroz 1 Kilo</descripcion><cantidad>3</cantidad><unidadMedida>22</unidadMedida><precioUnitario>8.00</precioUnitario><montoDescuento>1.5</montoDescuento><subTotal>22.50</subTotal><numeroSerie xsi:nil=\"true\"/><numeroImei xsi:nil=\"true\"/></detalle><detalle><actividadEconomica>692000</actividadEconomica><codigoProductoSin>99100</codigoProductoSin><codigoProducto>HE-1</codigoProducto><descripcion>Alicate de punta</descripcion><cantidad>3</cantidad><unidadMedida>57</unidadMedida><precioUnitario>40.00</precioUnitario><montoDescuento>2.3</montoDescuento><subTotal>117.70</subTotal><numeroSerie xsi:nil=\"true\"/><numeroImei xsi:nil=\"true\"/></detalle><detalle><actividadEconomica>692000</actividadEconomica><codigoProductoSin>82221</codigoProductoSin><codigoProducto>GA-1</codigoProducto><descripcion>Coca Cola 1 Litro</descripcion><cantidad>5</cantidad><unidadMedida>57</unidadMedida><precioUnitario>7.15</precioUnitario><montoDescuento>3</montoDescuento><subTotal>32.75</subTotal><numeroSerie xsi:nil=\"true\"/><numeroImei xsi:nil=\"true\"/></detalle></facturaComputarizadaCompraVenta>\n', 'fa5f92b6-a7a3-11ef-8ef2-0905fd039493', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE `medidas` (
  `id_medida` int(11) NOT NULL,
  `descripcion_medida` varchar(100) NOT NULL,
  `descripcion_corta` varchar(5) NOT NULL,
  `medidaSin` int(11) NOT NULL,
  `medida_estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `medidas`
--

INSERT INTO `medidas` (`id_medida`, `descripcion_medida`, `descripcion_corta`, `medidaSin`, `medida_estado`) VALUES
(1, 'Pieza', 'Pza', 47, 1),
(2, 'Unidad', 'U.', 57, 1),
(3, 'Kilo', 'K.', 22, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `codigo` varchar(30) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `costo_compra` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_medida` int(11) NOT NULL,
  `producto_estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `codigo`, `nombre_producto`, `costo_compra`, `precio_venta`, `cantidad`, `id_categoria`, `id_medida`, `producto_estado`) VALUES
(1, 'GA-1', 'Coca Cola 1 Litro', '5.00', '8.00', '20.00', 1, 2, 1),
(2, 'AB-1', 'Arroz 1 Kilo', '6.00', '8.00', '10.00', 2, 3, 1),
(3, 'HE-1', 'Alicate de punta', '25.00', '40.00', '10.00', 3, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nick` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `id_caja` int(11) NOT NULL,
  `usuario_estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nick`, `nombre`, `clave`, `id_caja`, `usuario_estado`) VALUES
(1, 'admin', 'Administrador', '0192023a7bbd73250516f069df18b500', 1, 1),
(2, 'ventas', 'JUAN', 'e10adc3949ba59abbe56e057f20f883e', 2, 1),
(3, 'ventas1', 'Juan Perez', 'e10adc3949ba59abbe56e057f20f883e', 2, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD PRIMARY KEY (`id_caja`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id_medida`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_medida` (`id_medida`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_caja` (`id_caja`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cajas`
--
ALTER TABLE `cajas`
  MODIFY `id_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `fk_factura_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_producto_medida` FOREIGN KEY (`id_medida`) REFERENCES `medidas` (`id_medida`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_caja_usuario` FOREIGN KEY (`id_caja`) REFERENCES `cajas` (`id_caja`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
