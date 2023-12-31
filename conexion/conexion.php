<?php 

class conexion{
    protected $conexion;

    function __construct(){
        $this->conexion = new mysqli("localhost", "root", "", "vetpet", "3306");
    }

    // Ejecuta la query y retorna un arreglo asociativo con los resultados.
    public function ejecutarQuery($query){
        $resultados = $this->conexion->query($query);
        $resultados = mysqli_fetch_array($resultados, MYSQLI_ASSOC);
        return $resultados;
    }

    // Ejecuta la query y retorna un arreglo de arreglos asociativos
    // (Para queries con multiples valores).
    public function ejecutarQueryMultiple($query){
        $resultados = $this->conexion->query($query);
        $arrayResultados = array();
        while($resultadosQuery = mysqli_fetch_array($resultados, MYSQLI_ASSOC)){
            $arrayResultados[] = $resultadosQuery;
        }
        return $arrayResultados;
    }

    public function nonQuery($query){
        $resultados = $this->conexion->query($query);
        //print_r($resultados);
    }

    public function contarResultadosQuery($query){
        $numResultados = $this->conexion->query($query);
        return $numResultados->num_rows;
    }

    public function encriptar($password){
        return md5($password);
    }
}

?>