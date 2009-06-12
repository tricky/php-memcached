--TEST--
Memcached: Bug #16084 (Crash when addServers is called with an associative array)
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php 
require('php_test_init.php');
$servers = array ( 0 => array ( 'KEYHERE' => 'localhost', 11211, 3 ), );
$m = new $php_class_name();
$m->addServers($servers);
var_dump($m->getServerList());
?>
--EXPECT--
array(1) {
  [0]=>
  array(3) {
    ["host"]=>
    string(9) "localhost"
    ["port"]=>
    int(11211)
    ["weight"]=>
    int(3)
  }
}
