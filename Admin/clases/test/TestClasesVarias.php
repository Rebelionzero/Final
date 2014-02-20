<?php
	include_once(__DIR__.'/../../autoloader.php');
	class TestClasesVarias extends PHPUnit_Framework_TestCase {

		function testConexion(){
			$conexion = new Conexion();
			$conexion->conectar_bd();

			// 1, 2 & 3
			$this->assertEquals('localhost',$conexion->server);
			$this->assertNotInternalType('string',$conexion->conexion);
			$this->assertInternalType('resource',$conexion->conexion);
			
		}

		function testLogin(){
			$login = new Login('usuario','pass');

			// 1
			$this->assertNull($login->respuesta);

			$login->consultaUsuario();
			
			// 2 & 3
			$this->assertNotNull($login->usuario);
			$this->assertFalse($login->respuesta);
		}

		function testQueries(){
			$queries = new Queries("SELECT * FROM usuarios WHERE id < 2");
			$queries->select();

			// 1
			$this->assertCount(1,$queries->resultado);

			$queries->query = "INSERT INTO usuarios VALUES(null,'nuevoUsuario','password')";
			$queries->insert();

			// 2
			$this->assertTrue($queries->resultado);

			$queries->query = "UPDATE usuarios SET password='userpass' WHERE nombreDeUsuario='nuevoUsuario'";
			$queries->update();
			$queries->query = "SELECT password, id FROM usuarios WHERE nombreDeUsuario='nuevoUsuario'";
			$queries->resultado = false;
			$queries->select();

			// 3
			$this->assertEquals('userpass',$queries->resultado[0]['password']);
			
			$queries->query = "DELETE FROM usuarios WHERE id=".$queries->resultado[0]['id'];
			$queries->resultado = false;
			$queries->delete();

			// 4
			$this->assertTrue($queries->resultado);
		}

		function testMensajeHTML(){
			$mensaje = new MensajeHTML(array(0 => 'mensaje html 1',1 => 'mensaje html 2'));
			$mensaje->listaDeMensajesDeError();

			// 1
			$this->assertStringEndsWith("cerrar_error_msg'>x</a></div>",$mensaje->output);
			
			$mensaje->input = 'un nuevo mensaje';
			$mensaje->mensajeExito();

			// 2
			$this->assertTag(array("class" => "alert-success"),$mensaje->output);

			$mensaje->input = 'otro nuevo mensaje';
			$mensaje->mensajeAlert();

			// 3
			$this->assertTag(array("class" => "alert-info"),$mensaje->output);

			$mensaje->input = 'ultimo nuevo mensaje';
			$mensaje->mensajeDeError();

			// 4
			$this->assertTag(array("class" => "alert-error"),$mensaje->output);
		}

		function testRequerimientoObras(){
			$array = array(
				'autores' => array(
					0 => array('nombre' => 'autor'),
					1 => array('value' => 'valor'),
					2 => array('seudonimo' => 'seud')
				),
				'categorias' => array(
					0 => array('nombre' => 'categoria'),
					1 => array('value' => 'valor')
				),
				'museos' => array(
					0 => array('nombre' => 'museo'),
					1 => array('value' => 'valor')
				),
			);

			$requerimientos = new RequerimientosObras($array);

			// 1 & 2
			$this->assertCount(0,$requerimientos->arrayQuery);
			$this->assertFalse($requerimientos->resultadoVacio);

			$requerimientos->traer_requerimientos();

			// 3
			$this->assertArrayHasKey('autores', $requerimientos->arrayObjetos);
		}

	}