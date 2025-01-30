<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class Ejercicios extends Controller
{
    public function pruebas()
    {
        DB::enableQueryLog(); // Iniciar el log de consultas
        $articulos = DB::table('articulo')
            ->where('precio', '>', 10)
            ->get();
        foreach ($articulos as $articulo) {
            echo "<h1>$articulo->descripcion</h1>";
            echo "<p>$articulo->precio</p>";
        }
        $sqlArray = DB::getQueryLog(); // Obtener el log de consultas
        foreach ($sqlArray as $consulta) {
            echo "<pre>";
            var_dump($consulta);
            echo "</pre>";
        }
    }

    public function ej1()
    {
        /*
        En cualquiera de la base de datos que tengas crea la tabla Alumnos.
        CREATE TABLE alumnos (
            id INT NOT NULL AUTO_INCREMENT,
            nombre VARCHAR(45) NULL,
            fecha_nac DATE NULL,
            created_at DATETIME NULL,
            updated_at DATETIME NULL,
            PRIMARY KEY (id)
        );
        Inserta varios registros, añade al menos 5
        INSERT INTO alumnos (nombre, fecha_nac, created_at, updated_at)
        VALUES (‘Al1', '1985-12-14', '2019-05-30', '2019-08-24');
        
        
        DB::enableQueryLog();
        DB::statement("CREATE TABLE alumnos (
            id INT NOT NULL AUTO_INCREMENT,
            nombre VARCHAR(45) NULL,
            fecha_nac DATE NULL,
            created_at DATETIME NULL,
            updated_at DATETIME NULL,
            PRIMARY KEY (id)
        )");
        DB::table('alumnos')->insert([
            ['nombre' => 'Al1', 'fecha_nac' => '1985-12-14', 'created_at' => '2019-05-30', 'updated_at' => '2019-08-24'],
            ['nombre' => 'Al2', 'fecha_nac' => '1985-12-14', 'created_at' => '2019-05-30', 'updated_at' => '2019-08-24'],
            ['nombre' => 'Al3', 'fecha_nac' => '1985-12-14', 'created_at' => '2019-05-30', 'updated_at' => '2019-08-24'],
            ['nombre' => 'Al4', 'fecha_nac' => '1985-12-14', 'created_at' => '2019-05-30', 'updated_at' => '2019-08-24'],
            ['nombre' => 'Al5', 'fecha_nac' => '1985-12-14', 'created_at' => '2019-05-30', 'updated_at' => '2019-08-24']
        ]);
        $sqlArray = DB::getQueryLog(); // Obtener el log de consultas
        foreach ($sqlArray as $consulta) {
            echo "<pre>";
            var_dump($consulta);
            echo "</pre>";
        }
        */
    }

    public function ejModel(){
        $resultados = Country::where('Continent', 'Europe')->get();
        foreach($resultados as $resultado){
            echo $resultado->Code . " --- " . $resultado->Name . "<br>";
        }
        //return view('country', ['resultados' => $resultados]);
    }
    
}