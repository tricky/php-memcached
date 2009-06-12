--TEST--
Memcached options
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php 
require('php_test_init.php');
$m = new $php_class_name();

$m->setOption($php_class_name_OPT_SERIALIZER, $php_class_name_SERIALIZER_PHP);

var_dump($m->getOption($php_class_name_OPT_COMPRESSION));
var_dump($m->getOption($php_class_name_OPT_SERIALIZER));
var_dump($m->getOption($php_class_name_OPT_SOCKET_SEND_SIZE));

$m->setOption($php_class_name_OPT_PREFIX_KEY, "\x01");

var_dump($m->getOption($php_class_name_OPT_HASH) == $php_class_name_HASH_DEFAULT);
$m->setOption($php_class_name_OPT_HASH, $php_class_name_HASH_MURMUR);
var_dump($m->getOption($php_class_name_OPT_HASH) == $php_class_name_HASH_MURMUR);
?>
--EXPECTF--
bool(true)
int(1)

Warning: %s::getOption(): no servers defined in %s on line %d
NULL

Warning: %s::setOption(): bad key provided in %s on line %d
bool(true)
bool(true)
