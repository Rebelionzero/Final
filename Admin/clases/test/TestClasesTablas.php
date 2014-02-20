<?php
	include_once(__DIR__.'/../../autoloader.php');
	class TestClasesTablas extends PHPUnit_Framework_TestCase {	

		 function testTablaAutores(){
            $array = array(array('autor' => 'nombreAutor',
                                 'seudonimo' => 'seudonimoAutor',
                                 'mail' => 'autorMail',
                                 'id' => null)
            );

            $tabla = new TablaAutores($array);
            $tabla->crearTabla();

            // 1, 2 & 3
            $this->assertInstanceOf("DibujarTabla",$tabla);
            $this->assertInstanceOf("TablaAutores",$tabla);
            $this->assertTag(array('class' => 'lista_autores'),$tabla->table);
            
         }

         function testTablaMuseos(){
            $array = array(array('museo' => 'nombreMuseo',
                                 'direccion' => 'direccionMuseo',
                                 'mail' => 'museoMail',
                                 'src' => 'museoImagenSrc.jpg',
                                 'imagen' => 'museoImagen',
                                 'id' => null)
            );

            $tabla = new TablaMuseos($array);

            // 1 & 2
            $this->assertEmpty($tabla->table);
            $this->assertInstanceOf("TablaMuseos",$tabla);

            $tabla->crearTabla();

            // 3
            $this->assertStringStartsWith('<table class=\'lista_museos\'',$tabla->table);

         }

         function testTablaCategorias(){
            $array = array(array('categoria' => 'categoriaNombre',
                                 'descripcion' => 'categoriaDescripcion',                                 
                                 'id' => null)
            );

            $tabla = new TablaCategorias($array);
            $tabla->crearTabla();

            // 1, 2 & 3
            $this->assertNotEmpty($tabla->table);
            $this->assertInstanceOf("TablaCategorias",$tabla);
            $this->assertContains('Editar Categoria-',$tabla->table);


         }

         function testTablaObras(){
            $array = array(array('obra' => 'nombreObra',
                                 'autor' => 'autorObra',
                                 'descripcion' => 'descripcionObra',
                                 'anio' => 1995,
                                 'seudonimo' => 'No',
                                 'categoria' => 'obraCategoria',
                                 'museo' => 'obraMuseo',
                                 'mail' => 'mailAusar',
                                 'src' => 'obraImagenSrc.jpg',
                                 'alt' => 'obraImagenAlt',
                                 'id' => null)
            );

            $tabla = new TablaObras($array);
            $tabla->crearTabla();

            // 1, 2 & 3
            $this->assertInstanceOf("TablaObras",$tabla);
            $this->assertContains('nombreObra',$tabla->table);
            $this->assertStringStartsWith('<table class=\'lista_obras\'',$tabla->table);
            
         }

	}
