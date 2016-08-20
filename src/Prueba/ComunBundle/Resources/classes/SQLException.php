<?php

namespace Prueba\ComunBundle\Resources\classes;

class SQLException
{
    function getSQLState($cadena, $line)
    {
        $error1 = substr($cadena, strpos($cadena, 'SQLSTATE'),40);
        $error2 = substr($error1, strpos($error1, '[')+1);
        $error = substr($error2, 0, strpos($error2, ']'));
        switch($error)
        {
            case '23503':
            {
                return 'No se puede eliminar el registro ya que este está relacionado con un registro en otra tabla';
            }
            case '23505':
            {
                return 'El registro que intenta ingresar ya existe en la Base de Datos';
            }
            default:
            {
                //return 'Error no identificado: Por favor comuniquese con el departamento de Desarrollo e informe de este error.  '.$cadena.'<br>'.$line;
                return 'Error no identificado: Por favor comuniquese con el departamento de Desarrollo e informe de este error.  '.$cadena.'<br> error='.$error.'<br>linea='.$line;

            }
        }
    }
}
?>
