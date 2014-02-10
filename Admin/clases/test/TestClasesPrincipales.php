<?php
	include_once(__DIR__.'/../../autoloader.php');
	class TestClasesPrincipales extends PHPUnit_Framework_TestCase {	

		 function testAutores() {
		 	$array = array('nombre' => 'nombre',
		 				    'seudonimo' => '',
		 				    'mail' => 'mdaaddtamaail@mail.com',
		 				    'tipoForm' => 0,
		 				    'id' => null);

        	$autor = new Autor($array);
        	$autor->insertarAutor();

        	// 1
        	$this->assertEquals( $autor->seudonimo,'-No tiene-');

        	$queryForSelect = 'SELECT id FROM autores WHERE nombre="'.$array['nombre'].'" AND seudonimo="-No tiene-" AND mail="'.$array['mail'].'"';
        	$consultas = new Queries($queryForSelect);
        	$consultas->select();

        	//2
        	$this->assertTrue(is_numeric(intval($consultas->resultado[0]['id'])));
        	
        	$id = $consultas->resultado[0]['id'];

        	$consultas->query = 'DELETE FROM autores WHERE id='.$consultas->resultado[0]['id'];
        	$consultas->delete();
        	     	
        	$consultas->query = 'SELECT * FROM autores WHERE id='.$id;
			$consultas->select();
        	
        	// 3
        	$this->assertFalse($consultas->resultado);
        	
    	}

    	function testCategorias(){
    		$array = array('categoria' => 'categoria',
		 				    'descripcion' => '',
		 				    'tipoForm' => 0,
		 				    'id' => null);

    		$categoria = new Categoria($array);
    		$categoria->insertarCategoria();

    		$queryForSelect = "SELECT MAX(id) FROM categorias";
    		$consultas = new Queries($queryForSelect);
    		$consultas->select();

    		$id = $consultas->resultado[0]['MAX(id)'];
    		
    		// 5 & 6
    		$this->assertNotEquals($categoria->mensajeResultado,'La nueva categoria ha sido cargada con exito.');
    		$this->assertEquals($categoria->mensajeResultado,'Se creó una nueva categoria, pero le recomendamos agregarle una descripción en la seccion <strong>Editar Categoria</strong> en la <strong>Lista de Categorias</strong>.');

    		$consultas->query = "DELETE FROM categorias WHERE id=".$id;
    		$consultas->delete();

    		$consultas->query = "SELECT * FROM categorias WHERE id=".$id;
    		$consultas->select();

    		// 7
    		$this->assertFalse($consultas->resultado);

    	}

    	
	}
