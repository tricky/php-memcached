--TEST--
Memcached store & fetch expired key
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php
require('php_test_init.php');
$m = new $php_class_name();
$m->addServer('127.0.0.1', 11211, 1);

$set = $m->set('will_expire', "foo", 2);
$v = $m->get('will_expire');
if (!$set || $v != 'foo') {
	echo "Error setting will_expire to \"foo\" with 2s expiry.\n";
}
sleep(3);
$v = $m->get('will_expire');

if ($v !== $php_class_name_GET_ERROR_RETURN) {
	echo "Wanted a:\n";
	var_dump($php_class_name_GET_ERROR_RETURN);
	echo "from get of expired value. Got:\n";
	var_dump($v);
}
?>
--EXPECT--
