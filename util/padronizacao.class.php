<?php
class Padronizacao {

  public static function padronizarMaiMin($v){
    return ucwords(strtolower($v));
  }

  public static function antiXSS($v){
    return htmlspecialchars($v);
  }
  public static function juntarData($d, $m, $a){
    $array = array($d,$m,$a);
    $data = implode("/",$array);
    return $data;
  }
}
