-- PostgreSQL SQL Dump
-- Version 15+
-- https://www.phpmyadmin.net/

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Base de datos: `ventas`
--

CREATE DATABASE ventas;

\c ventas;

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE caja (
  caja_id integer NOT NULL,
  caja_numero integer NOT NULL,
  caja_nombre varchar(100) NOT NULL,
  caja_efectivo numeric(30,2) NOT NULL
);

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO caja (caja_id, caja_numero, caja_nombre, caja_efectivo) VALUES
(1, 1, 'Caja Principal', '0.00');

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE categoria (
  categoria_id integer NOT NULL,
  categoria_nombre varchar(50) NOT NULL,
  categoria_ubicacion varchar(150) NOT NULL
);

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE cliente (
  cliente_id integer NOT NULL,
  cliente_tipo_documento varchar(20) NOT NULL,
  cliente_numero_documento varchar(35) NOT NULL,
  cliente_nombre varchar(50) NOT NULL,
  cliente_apellido varchar(50) NOT NULL,
  cliente_provincia varchar(30) NOT NULL,
  cliente_ciudad varchar(30) NOT NULL,
  cliente_direccion varchar(70) NOT NULL,
  cliente_telefono varchar(20) NOT NULL,
  cliente_email varchar(50) NOT NULL
);

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO cliente (cliente_id, cliente_tipo_documento, cliente_numero_documento, cliente_nombre, cliente_apellido, cliente_provincia, cliente_ciudad, cliente_direccion, cliente_telefono, cliente_email) VALUES
(1, 'Otro', 'N/A', 'Publico', 'General', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A');

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE empresa (
  empresa_id integer NOT NULL,
  empresa_nombre varchar(90) NOT NULL,
  empresa_telefono varchar(20) NOT NULL,
  empresa_email varchar(50) NOT NULL,
  empresa_direccion varchar(100) NOT NULL
);

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE producto (
  producto_id integer NOT NULL,
  producto_codigo varchar(77) NOT NULL,
  producto_nombre varchar(100) NOT NULL,
  producto_stock_total integer NOT NULL,
  producto_tipo_unidad varchar(20) NOT NULL,
  producto_precio_compra numeric(30,2) NOT NULL,
  producto_precio_venta numeric(30,2) NOT NULL,
  producto_marca varchar(35) NOT NULL,
  producto_modelo varchar(35) NOT NULL,
  producto_estado varchar(20) NOT NULL,
  producto_foto varchar(500) NOT NULL,
  categoria_id integer NOT NULL
);

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE usuario (
  usuario_id integer NOT NULL,
  usuario_nombre varchar(50) NOT NULL,
  usuario_apellido varchar(50) NOT NULL,
  usuario_email varchar(50) NOT NULL,
  usuario_usuario varchar(30) NOT NULL,
  usuario_clave varchar(535) NOT NULL,
  usuario_foto varchar(200) NOT NULL,
  caja_id integer NOT NULL
);

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO usuario (usuario_id, usuario_nombre, usuario_apellido, usuario_email, usuario_usuario, usuario_clave, usuario_foto, caja_id) VALUES
(1, 'Administrador', 'Principal', '', 'Administrador', '$2y$10$Jgm6xFb5Onz/BMdIkNK2Tur8yg/NYEMb/tdnhoV7kB1BwIG4R05D2', '', 1);

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE venta (
  venta_id integer NOT NULL,
  venta_codigo varchar(200) NOT NULL,
  venta_fecha date NOT NULL,
  venta_hora varchar(17) NOT NULL,
  venta_total numeric(30,2) NOT NULL,
  venta_pagado numeric(30,2) NOT NULL,
  venta_cambio numeric(30,2) NOT NULL,
  usuario_id integer NOT NULL,
  cliente_id integer NOT NULL,
  caja_id integer NOT NULL
);

--
-- Estructura de tabla para la tabla `venta_detalle`
--

CREATE TABLE venta_detalle (
  venta_detalle_id integer NOT NULL,
  venta_detalle_cantidad integer NOT NULL,
  venta_detalle_precio_compra numeric(30,2) NOT NULL,
  venta_detalle_precio_venta numeric(30,2) NOT NULL,
  venta_detalle_total numeric(30,2) NOT NULL,
  venta_detalle_descripcion varchar(200) NOT NULL,
  venta_codigo varchar(200) NOT NULL,
  producto_id integer NOT NULL
);

--
-- Índices para tablas volcadas
--

ALTER TABLE caja ADD PRIMARY KEY (caja_id);
ALTER TABLE categoria ADD PRIMARY KEY (categoria_id);
ALTER TABLE cliente ADD PRIMARY KEY (cliente_id);
ALTER TABLE empresa ADD PRIMARY KEY (empresa_id);
ALTER TABLE producto ADD PRIMARY KEY (producto_id);
ALTER TABLE usuario ADD PRIMARY KEY (usuario_id);
ALTER TABLE venta ADD PRIMARY KEY (venta_id);
ALTER TABLE venta_detalle ADD PRIMARY KEY (venta_detalle_id);

--
-- AUTO_INCREMENT (SERIAL) para PostgreSQL
--

ALTER TABLE caja ALTER COLUMN caja_id ADD GENERATED ALWAYS AS IDENTITY (INCREMENT 1 START 1);
ALTER TABLE categoria ALTER COLUMN categoria_id ADD GENERATED ALWAYS AS IDENTITY (INCREMENT 1 START 1);
ALTER TABLE cliente ALTER COLUMN cliente_id ADD GENERATED ALWAYS AS IDENTITY (INCREMENT 1 START 1);
ALTER TABLE empresa ALTER COLUMN empresa_id ADD GENERATED ALWAYS AS IDENTITY (INCREMENT 1 START 1);
ALTER TABLE producto ALTER COLUMN producto_id ADD GENERATED ALWAYS AS IDENTITY (INCREMENT 1 START 1);
ALTER TABLE usuario ALTER COLUMN usuario_id ADD GENERATED ALWAYS AS IDENTITY (INCREMENT 1 START 1);
ALTER TABLE venta ALTER COLUMN venta_id ADD GENERATED ALWAYS AS IDENTITY (INCREMENT 1 START 1);
ALTER TABLE venta_detalle ALTER COLUMN venta_detalle_id ADD GENERATED ALWAYS AS IDENTITY (INCREMENT 1 START 1);

--
-- Llaves foráneas
--

ALTER TABLE producto ADD CONSTRAINT producto_categoria_fk FOREIGN KEY (categoria_id) REFERENCES categoria (categoria_id);
ALTER TABLE usuario ADD CONSTRAINT usuario_caja_fk FOREIGN KEY (caja_id) REFERENCES caja (caja_id);
ALTER TABLE venta ADD CONSTRAINT venta_usuario_fk FOREIGN KEY (usuario_id) REFERENCES usuario (usuario_id);
ALTER TABLE venta ADD CONSTRAINT venta_cliente_fk FOREIGN KEY (cliente_id) REFERENCES cliente (cliente_id);
ALTER TABLE venta ADD CONSTRAINT venta_caja_fk FOREIGN KEY (caja_id) REFERENCES caja (caja_id);
ALTER TABLE venta_detalle ADD CONSTRAINT venta_detalle_producto_fk FOREIGN KEY (producto_id) REFERENCES producto (producto_id);
ALTER TABLE venta_detalle ADD CONSTRAINT venta_detalle_venta_fk FOREIGN KEY (venta_codigo) REFERENCES venta (venta_codigo);
