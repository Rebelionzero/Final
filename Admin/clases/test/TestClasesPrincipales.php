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
    		
    		// 4 & 5
    		$this->assertNotEquals($categoria->mensajeResultado,'La nueva categoria ha sido cargada con exito.');
    		$this->assertEquals($categoria->mensajeResultado,'Se creó una nueva categoria, pero le recomendamos agregarle una descripción en la seccion <strong>Editar Categoria</strong> en la <strong>Lista de Categorias</strong>.');

    		$consultas->query = "DELETE FROM categorias WHERE id=".$id;
    		$consultas->delete();

    		$consultas->query = "SELECT * FROM categorias WHERE id=".$id;
    		$consultas->select();

    		// 6
    		$this->assertFalse($consultas->resultado);

    	}

        function testMuseos(){
            $array = array('museo' => 'museo',
                            'direccion' => 'calle 123',
                            'mail' => 'museomail@museomail.com',
                            'imagen' => array('name' =>'imgName.jpg',                                              
                                              'error' => 1
                                             ),
                            'tipoForm' => 0,
                            'id' => null
                           );

            $museo = new Museo($array);
            $museo->insertarMuseo();

            // 7
            $this->assertEquals('El nuevo museo ha sido cargado con exito.',$museo->mensajeResultado);

            $queryForSelect = "SELECT MAX(id) FROM museos";
            $consultas = new Queries($queryForSelect);
            $consultas->select();

            $id = $consultas->resultado[0]['MAX(id)'];

            $museo->imagen['name'] = 'otraImagen.jpg';
            $museo->mail  = 'nuevomuseomail@museomail.com';
            $museo->id = $id;
            $museo->editarMuseo();

            // 8
            $this->assertEquals('El museo ha sido editado con exito',$museo->mensajeResultado);

            $consultas->query = 'DELETE FROM museos WHERE id='.$id;
            $consultas->delete();

            $consultas->query = 'SELECT * FROM museos WHERE id='.$id;
            $consultas->select();

            // 9
            $this->assertFalse($consultas->resultado);            

        }

        function testObras(){
            $array = array(
                'titulo' => 'titulo',
                'descripcion' => 'esta es una descripcion',
                'autor' => 'blanca_narfa',
                'anio' => 1999,
                'categoria' => 'esculturas',
                'museo' => 'gran_museo_de_hyrule',
                'imagen' => array('name' =>'imgName.jpg',
                                  'error' => 1),
                'mail' => 'autormail@mail.com',
                'seudonimo' => 0,
                'tipoForm' => 0,
                'id' => null
            );

            // para autor, categoria y museo se toman los valores de la insercion por defecto al crear la base de datos

            $queryForSelect = "SELECT MAX(id) FROM obras";
            $select = new Queries($queryForSelect);
            $select->select();            

            $obra = new Obra($array);
            $obra->insertarObra();

            $otherselect = new Queries("SELECT MAX(id) FROM obras");            
            $otherselect->select();
                        
            if($select->resultado != false){
                // 10
                $this->assertNotEquals($select->resultado[0]['MAX(id)'],$otherselect->resultado[0]['MAX(id)']);
            }

            $queryForSelectObras = "SELECT categoria,autor,museo FROM obras WHERE id=".$otherselect->resultado[0]['MAX(id)'];
            $otherselect->query = $queryForSelectObras;
            $otherselect->select();

            $queryForSelectData = "SELECT value FROM categorias WHERE id=".$otherselect->resultado[1]['categoria'];
            $dataSelect = new Queries($queryForSelectData);
            $dataSelect->select();

            // 11
            $this->assertEquals($dataSelect->resultado[0]['value'],'esculturas');

            $dataSelect->query = "SELECT value FROM museos WHERE id=".$otherselect->resultado[1]['museo'];;
            $dataSelect->select();

            // 12
            $this->assertEquals($dataSelect->resultado[1]['value'],'gran_museo_de_hyrule');

            $dataSelect->query = "SELECT value FROM autores WHERE id=".$otherselect->resultado[1]['autor'];;
            $dataSelect->select();

            // 13
            $this->assertEquals($dataSelect->resultado[2]['value'],'blanca_narfa');
            
            $delete = new Queries("DELETE FROM obras WHERE id=".$otherselect->resultado[0]['MAX(id)']);
            $delete->delete();
        }

    	
	}