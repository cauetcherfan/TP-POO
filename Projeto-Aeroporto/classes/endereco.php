<?php
require_once('global.php');

class Endereco extends persist {
  
  protected string $endereco;
  protected float $longitude;
  protected float $latitude;
  protected static $local_filename = "endereco.txt";

  static public function getFilename() {
      return get_called_class()::$local_filename;
  }

