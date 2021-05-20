<?php
class conexion{
		//CREAR VARIABLES GLOBALES
		private static $_basedatos = "senatimarketdbs";
		private static $_servidor = "localhost";
		private static $_usuario = "root";
		private static $_clave = "";
		private static $_conexion = null;

		//MÉTODOS  PARA CONECTAR
		public static function conectar(){
			//try n catch
			try{
				self::$_conexion = new PDO("mysql:host=".self::$_servidor.";"."dbname=".self::$_basedatos,self::$_usuario, self::$_clave);

			}catch(PDOException $e){
				die($e->getMessage());
			}

			return self::$_conexion;
		}

		public static function desconectar(){
			self::$_conexion = null;
		}
	}