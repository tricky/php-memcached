--TEST--
Memcached store & fetch type correctness
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php
require('php_test_init.php');
$m = new $php_class_name();
$m->addServer('127.0.0.1', 11211, 1);

$m->set('eisaleeoo', "foo");
$m->delete('eisaleeoo');
$v = $m->get('eisaleeoo');

if ($v !== $php_class_name_GET_ERROR_RETURN) {
	echo "Wanted a false value from get. Got:\n";
	var_dump($v);
}
?>
--EXPECT--
