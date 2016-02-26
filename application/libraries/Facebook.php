<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/Facebook/autoload.php"; 

class Facebook extends Facebook { 
    public function __construct() { 
        parent::__construct(); 
    } 
}
