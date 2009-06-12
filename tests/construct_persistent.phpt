--TEST--
persistent memcached connection
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php 
require('php_test_init.php');
$m1 = new $php_class_name('id1');
$m1->setOption($php_class_name_OPT_PREFIX_KEY, 'php');
var_dump($m1->getOption($php_class_name_OPT_PREFIX_KEY));

$m2 = new $php_class_name('id1');
var_dump($m1->getOption($php_class_name_OPT_PREFIX_KEY));

$m3 = new $php_class_name();
var_dump($m3->getOption($php_class_name_OPT_PREFIX_KEY));
?>
--EXPECT--
string(3) "php"
string(3) "php"
string(0) ""
