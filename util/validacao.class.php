<?php
class Validacao{
    public static function validarNome($v){
        $exp = "/^[A-z  ]{2,30}$/";
        return preg_match($exp, $v);
    }
    public static function validarSexo($v){
        $exp = "/^(Masculino|Feminino|Outro)$/";
        return preg_match($exp, $v);
    }
    public static function validarDatanasc($d, $m, $a){
        return checkdate($m, $d, $a);
    }
    public static function validarCpf($v){
        $exp = "/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/";
        return preg_match($exp, $v);
    }
}
