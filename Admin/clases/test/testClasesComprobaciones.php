<?php
	include_once(__DIR__.'/../../autoloader.php');
	class TestClasesComprobaciones extends PHPUnit_Framework_TestCase {

		function testComprobarAutores(){
			$array = array('nombre' => '',
						   'seudonimo' => 'seudonimoAutor',
						   'mail' => 'mailautor@mail.com',						   
						   'tipoForm' => 0,
						   'id' => null
			);

			$comprobacion = new ComprobarAutores($array);
			$comprobacion->verificar();

			// 1, 2 & 3
			$this->assertInternalType('string',$comprobacion->seudonimo);
			$this->assertStringEndsWith('autor@mail.com',$comprobacion->mail);
			$this->assertEquals('Error: Debe ingresar un nombre de autor (campo vacio).',$comprobacion->errores[0]);
		}

		function testComprobarMuseos(){
			$array = array('museo' => 'nombreMuseo',
						   'direccion' => 'direccionMuseo',
						   'mail' => 'mailmuseo@mail.com',
						   'imagen' => array('error' => 0,
						   					 'type' => 'image/reg',
						   					 'size' => 1024
						   					 ),
						   'tipoForm' => 0,
						   'id' => null
			);

			$comprobacion = new ComprobarMuseos($array);
			$comprobacion->verificar();

			// 1, 2 & 3
			$this->assertRegExp('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$comprobacion->mail);
			$this->assertCount(1,$comprobacion->errores);
			$this->assertEquals("Error en la carga de imagenes: Solo se permiten formatos jpg, jpeg, gif y png",$comprobacion->errores[0]);


		}

		function testComprobarCategorias(){
			$array = array('categoria' => 'nombreCategoria',
						   'descripcion' => 'descripcionCtaegoria',
						   'tipoForm' => 0,
						   'id' => null
			);

			$comprobacion = new ComprobarCategoria($array);
			$comprobacion->verificar();

			// 1, 2 & 3
			$this->assertCount(0,$comprobacion->errores);
			$this->assertNull($comprobacion->id);
			$this->assertObjectHasAttribute('form',$comprobacion);


		}

		function testComprobarObras(){
			$array = array('titulo' => 'tituloObra',
						   'descripcion' => 'descripcionObra',
						   'autor' => 'autorObra',
						   'anio' => 1995,
						   'categoria' => 'categoriaObra',
						   'museo' => 'museoObra',
						   'tipoForm' => 0,
						   'imagen' => array('error' => 0,
						   					 'type' => 'image/gif',
						   					 'size' => 1024
						   					 ),
						   'mail' => ''
			);

			$comprobacion = new ComprobarObra($array);
			$comprobacion->titulo = 'qwertyuiopasdfghjklzxcvbnm0123456789';
			$comprobacion->verificar();

			// 1, 2 & 3
			$this->assertEquals('Error: El titulo no debe tener mas de 30 caracteres',$comprobacion->validaciones['titulo']);
			$this->assertFalse($comprobacion->validaciones['categoria']);
			$this->assertEmpty($comprobacion->mail);
		}

	}