<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Modelo;


class Controlador extends Controller
{
    public function __construct()
    {
        helper(['form', 'url']); 
    }

    public function index()
    {
        $tablaa = new Modelo();
        
        $datosFutbolistas = $tablaa->orderBy('ID','ASC')->findAll();

        $datos['futbolistas'] = $datosFutbolistas;

        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');

        return view('futbol',$datos);
    }

    public function Agregar()
    {
        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');
        
        return view('vistas/Agregar', $datos);
    }

    public function guardar()
    { 
        $tablaa = new Modelo();
        
        $validacion = $this->validate([
            'nombre'   => 'required|min_length[3]',
            'edad'     => 'required|min_length[1]|is_natural_no_zero',
            'posicion' => 'required|min_length[3]',
            'dorsal'   => 'required|min_length[1]|is_natural|max_length[2]',
            'imagen'   => [
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'max_size[imagen,4096]',
            ]
        ]);
        
        if(!$validacion){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if($imagen = $this->request->getFile('imagen')){
            $nuevoNombre = $imagen->getRandomName();
            
            $imagen->move('./public/imagenes', $nuevoNombre); 
            
            $datos = [
                'nombre'   => $this->request->getVar('nombre'),
                'edad'     => $this->request->getVar('edad'),
                'posicion' => $this->request->getVar('posicion'),
                'dorsal'   => $this->request->getVar('dorsal'),
                'imagen'   => $nuevoNombre,
            ];

            $tablaa->insert($datos);
        }
        
        return redirect()->to(site_url('/lobby'))->with('mensaje','Jugador agregado con éxito!');
    }
    
    public function borrar($ID=null)
    {
        $tablaa = new Modelo();
        $datostablaa = $tablaa->where('ID',$ID)->first();

        if ($datostablaa && isset($datostablaa['imagen']) && $datostablaa['imagen']) {
            $ruta = ROOTPATH . 'public/imagenes/' . $datostablaa['imagen']; 
            
            if (file_exists($ruta) && !is_dir($ruta)) {
                unlink($ruta);
            }
        }

        $tablaa->where('ID',$ID)->delete($ID);
        
        return redirect()->to(site_url('/lobby'))->with('mensaje','Jugador eliminado con éxito!');
    }

    public function editar($ID=null)
    {
        $tablaa = new Modelo();
        $datos['futbolista'] = $tablaa->where('ID',$ID)->first();

        $datos['cabecera'] = view('template/cabecera');
        $datos['pie'] = view('template/piepagina');
        
        return view('vistas/editar',$datos);
    }

    public function actualizar()
    { 
        $tablaa = new Modelo();
        $ID = $this->request->getVar('ID'); 
        
        // 1. Validamos los campos de texto
        $validacion_texto = $this->validate([
            'nombre'   => 'required|min_length[3]',
            'edad'     => 'required|min_length[1]|is_natural_no_zero',
            'posicion' => 'required|min_length[3]',
            'dorsal'   => 'required|min_length[1]|is_natural|max_length[2]',
        ]);
        
        $imagen_subida = $this->request->getFile('imagen');
        $validacion_imagen = true;

        if ($imagen_subida->isValid() && !$imagen_subida->hasMoved()) {
            // 2. Si hay imagen, la validamos por separado
             $validacion_imagen = $this->validate([
                'imagen'   => [
                    'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                    'max_size[imagen,4096]',
                ] 
            ]);
        }
        
        // Si cualquiera de las validaciones falla (más simple de explicar)
        if(!$validacion_texto || !$validacion_imagen){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Obtenemos los datos de texto DE NUEVO (simulando un proceso menos eficiente)
        $datos_texto = [
            'nombre'   => $this->request->getVar('nombre'),
            'edad'     => $this->request->getVar('edad'),
            'posicion' => $this->request->getVar('posicion'),
            'dorsal'   => $this->request->getVar('dorsal'),
        ];
        
        $tablaa->update($ID, $datos_texto);

        // Verificamos si la imagen fue enviada y si es válida
        if($imagen_subida->isValid() && !$imagen_subida->hasMoved()){ 
            
            // Si la imagen actual es diferente, la borramos.
            $datos_actuales = $tablaa->where('ID', $ID)->first(); 
            if ($datos_actuales && isset($datos_actuales['imagen']) && $datos_actuales['imagen']) {
                $ruta = ROOTPATH . 'public/imagenes/' . $datos_actuales['imagen']; 
                if (file_exists($ruta) && !is_dir($ruta)) {
                    unlink($ruta);
                }
            }

            // Movemos la nueva imagen
            $nuevoNombre = $imagen_subida->getRandomName();
            $imagen_subida->move('./public/imagenes', $nuevoNombre); 
            
            // Creamos un array de datos solo para la imagen (actualización separada)
            $datos_imagen = ['imagen' => $nuevoNombre];
            $tablaa->update($ID, $datos_imagen);
        }

        return redirect()->to(site_url('/lobby'))->with('mensaje','Jugador actualizado con éxito!');
    }
}