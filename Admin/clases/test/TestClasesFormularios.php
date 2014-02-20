<?php
	include_once(__DIR__.'/../../autoloader.php');
	class TestClasesFormularios extends PHPUnit_Framework_TestCase {

		function testFormularioAutores(){
			$formularioAutores = new FormularioAutores('action',null,'clase',0,array('nombre'=>'','seudonimo'=>'','mail'=>''),1);

			// 1 & 2
			$this->assertClassHasAttribute('action','FormularioAutores');
			$this->assertInstanceOf('CrearFormulario',$formularioAutores);

			$formularioAutores->crearForm();

			// 3
			$this->assertInternalType('string',$formularioAutores->autorId);
		}

		function testFormularioCategorias(){
			$formularioCategorias = new formularioCategorias('action','categorias-form','',0,array('categoria'=>'','descripcion'=>''),false);
			$formularioCategorias->crearForm();

			// 1
			$this->assertFalse($formularioCategorias->cancelarButtons);

			$formularioCategorias->cancelBtns();

			// 2 & 3
			$this->assertTrue($formularioCategorias->cancelarButtons);
			$this->assertTag(array('id' => 'categorias-form'),$formularioCategorias->formulario);
			
		}

		function testFormularioObras(){
			$array_values = array('titulo'=>'','descripcion'=>'','autor'=>'seleccione','anio'=> 1995,'categoria'=>'seleccione','museo'=>'seleccione','imagen'=>'','mail'=>'','seudonimo'=>false);
			$requerimientosArray = array(
				'autores' => array(0 => array('autor' => 'nombre Autor','valor' => 'nombre_Autor','seud' => 'seud'),
								   1 => array('autor' => 'otro Autor','valor' => 'otro_Autor','seud' => '-No tiene-')
				),
				'categorias' => array(0 => array('categoria' => 'esculturas','valor' => 'esculturas')
				),
				'museos' => array(0 => array('museo' => 'nombre museo','valor' => 'nombre_museo'),
								  1 => array('museo' => 'otro museo','valor' => 'otro_museo')
				)
			);

			$formularioObras = new FormularioObras(null,null,null,0,$requerimientosArray,$array_values,false);
			$formularioObras->crearForm();

			// 1, 2 & 3
			$this->assertTag(array('tag' => 'option','attributes' => array('data-seudonimo' => 'seud')),$formularioObras->field_1);
			$this->assertCount(9,$formularioObras->values);
			$this->assertNotEmpty($formularioObras->requerimientos['categorias']);

		}

		function testFormularioMuseos(){
			$array = array('museo'=>'nombre Museo','direccion'=>'calle falsa 123','mail'=>'museomail@mail.com','imagen'=>'');
			$formularioMuseos = new FormularioMuseos('action.php','museos-form','museos',0,$array,'museoId');

			// 1
			$this->assertInstanceOf('CrearFormulario',$formularioMuseos);			
			
			$formularioMuseos->crearForm();

			// 2 & 3
			$this->assertThat($formularioMuseos->museoId,$this->logicalNot($this->equalTo('')));
			$this->assertTag(array('tag'=> 'input','attributes' => array('type'=> 'hidden')),$formularioMuseos->museoId);
			

		}

	}