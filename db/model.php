<?php

function generarToken(){
    $token = md5(rand(4,99999999999). SALT_PKM .uniqid());
    return $token;
}

class Resultado{
    public $exito;
    public $datos;
    public $ms;

    public function __construct($data = null){
        $this->exito  = true;
        $this->datos  = [];
        $this->ms  = "";

        if($data != null){
            $this->datos = $data;
        }
    }

    public function __tostring(){
        return json_encode($this);
    }

    public function finalizar(){
        header('Content-Type: application/json');
        echo $this;
        exit;
    }

    public function verificar($campos){
        $campos = explode(',',$campos);
        $campos = array_map('trim',$campos);
        foreach($campos as $campo){
            if(!isset($_POST{$campo})){
                $this->exito  = true;
                $this->ms .= "El campo $campo es requerido";
                $this->finalizar();
            }

            if(!$_POST & isset($_GET['form'])) {
                echo "
                <div class='container'>
                <form method='post' action = '' ";
    
                foreach($campos as $campo) {
                    echo "<label for='$campo'>$campo</label>";
                    echo "<input type='text' name='$campo' id='$campo' value=''/> <br/>";
                }
    
                echo "<input type='submit' value='Enviar'/> <br/>";
                echo "</form>
                
                </div>";
    
                exit();
            }

            if(!$this->exito){
                $this->finalizar();
            }
        }
    }
}