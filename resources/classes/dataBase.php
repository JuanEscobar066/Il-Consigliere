<?php
    class dataBase
    {
        var $host;
        var $bd;
        var $usuario;
        var $password;
        var $link;
        
        public function __construct()
        {
            $this->host='localhost';
            $this->bd='proyecto';
            $this->usuario='postgres';
            $this->password='2811';
        }
        
        public function consultar($sql)
        {
            $datos_bd = "host=$this->host port=5432 dbname=$this->bd user=$this->usuario password=$this->password";
            $link = pg_connect($datos_bd);
            $this->link = $link;
            $query = pg_query($link,$sql);
            if (!empty($query))
            {
                return $query;
            }
            else
            {
                echo "Error!!!";
            }
        }
        
        public function insertar($sql)
        {
            $datos_bd = "host=$this->host port=5432 dbname=$this->bd user=$this->usuario password=$this->password";
            $link = pg_connect($datos_bd);
            $this->link = $link;
            $query = pg_query($link,$sql);
            if (!empty($query))
            {
                echo "Se ha insertado correctamente";
                
            }
            else
            {
                echo "Error!!!";
            }
        }
        
        public function __destruct()
        {
            pg_close($this->link);
        }
        //Ejecuta cualquier consulta en la base de datos y tambien transacciones
    }

?>