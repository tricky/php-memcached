--TEST--
Memcached constructor
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php 
require('php_test_init.php');
$m = new $php_class_name();
var_dump(get_class($m) == $php_class_name);
?>
--EXPECT--
bool(true)
