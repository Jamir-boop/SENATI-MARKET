USE senatimarketdbs;

ALTER TABLE `carrito` CHANGE `cantidadProd` `cantidadProd` INT(11) NOT NULL DEFAULT 1;

DROP PRIMARY KEY

ALTER TABLE carrito
MODIFY COLUMN cantidadProd NOT NULL DEFAULT '10';

ALTER TABLE carrito
ADD COLUMN 	fechaCliente DATE;

ALTER TABLE carrito
DROP COLUMN fechaCliente DATE;

ALTER TABLE carrito
ADD FOREIGN KEY(codigoCliente) REFERENCES cliente(codigoCliente);


CREATE TABLE cliente(
	codigoCliente NCHAR(8) NOT NULL PRIMARY KEY,
	estadoCliente CHAR(1) NOT NULL,
	nombreCliente NVARCHAR (255) NOT NULL,
	correoCliente NVARCHAR (255) NOT NULL,
	claveCliente NVARCHAR (255) NOT NULL,
	fechaCliente DATE
)

CREATE TABLE producto(
	codigoProd NVARCHAR (8) NOT NULL PRIMARY KEY,
	categoriaProd NVARCHAR (30) NOT NULL,
	nombreProd NVARCHAR (255) NOT NULL,
	precioProd DOUBLE NOT NULL,
	descripcionProd NVARCHAR(2500) NULL,
	imgMainProd NVARCHAR(500) NOT NULL,
	imgSecProd NVARCHAR(500) NULL,
	unidadesProd INT(255)
)

CREATE TABLE carrito(
	codigoCompra NCHAR(8) NOT NULL PRIMARY KEY,
	estadoCompra CHAR(1) NOT NULL,
	codigoCliente NVARCHAR(8) NOT NULL,
	codigoProd NVARCHAR(8) NOT NULL,
	cantidadProd INT(11) NOT NULL DEFAULT 1
   FOREIGN KEY	(codigoCliente) REFERENCES cliente(codigoCliente),
   FOREIGN KEY	(codigoProd) REFERENCES producto(codigoProd)
)
	
CREATE TABLE boleta(
	codigoBoleta NCHAR(8) NOT NULL PRIMARY KEY,
	codigoCompra NCHAR(8) NOT NULL,
   nombreCliente NVARCHAR (255) NOT NULL,
   totalPago DOUBLE NOT NULL,
   descripcionCompra NVARCHAR (2500) NOT NULL,
   fechaPago DATE NOT NULL,
   FOREIGN KEY	(codigoCompra) REFERENCES carrito(codigoCompra)
)

-- TRIGGERS
-- DROP TRIGGER IF EXISTS tr_codigo_cliente;
DROP TRIGGER IF EXISTS tr_codigo_cliente;


CREATE TRIGGER tr_codigo_cliente
BEFORE INSERT ON cliente
FOR EACH ROW     -- por si se insertan multiples ROWS
	SET NEW.codigoCliente = OLD.codigoCliente
	
CREATE TRIGGER tr_codigo_cliente
BEFORE UPDATE ON cliente


-- FUNCIONES

CREATE FUNCTION gen_codigo_cliente(codigo_anterior NCHAR(8), tipo_codigo NCHAR(3))
RETURNS CHAR(8) DETERMINISTIC
BEGIN
	DECLARE @salida NCHAR(8);
	DECLARE @numero INT;
	DECLARE @ceros NCHAR;
	
	REPLACE(codigo_anterior, tipo_codigo,'') AS @numero;
	SET @numero = @numero + 1;
	CASE @numero
		WHEN 10 THEN 
			SET @ceros = @ceros - 1
		WHEN 100 THEN @ceros = @ceros - 1
		WHEN 1000 THEN @ceros = @ceros - 1
		WHEN 10000 THEN @Aceros = @ceros - 1
	ELSE NULL
	
	RETURN @salida
END;


SELECT * FROM producto WHERE codigoProd ='PRO00090'


-- suma total de precio por usuario
CREATE OR REPLACE PROCEDURE suma_total_from_cliente(IN cliente NCHAR(8))
BEGIN 
	SELECT SUM(precioProd)
	FROM producto WHERE codigoProd IN (
		SELECT codigoProd
		FROM carrito 
		WHERE codigoCliente=cliente AND estadoCompra='1'
	);
		
	SELECT cantidadProd
	FROM carrito 
	WHERE codigoCliente=cliente AND estadoCompra='1';
END;

CALL suma_total_from_cliente('CLI00001');






