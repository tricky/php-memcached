--TEST--
persistent memcached connection
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php 
$m1 = new Libmemcached('id1');
$m1->setOption(Libmemcached::OPT_PREFIX_KEY, 'php');
var_dump($m1->getOption(Libmemcached::OPT_PREFIX_KEY));

$m2 = new Libmemcached('id1');
var_dump($m1->getOption(Libmemcached::OPT_PREFIX_KEY));

$m3 = new Libmemcached();
var_dump($m3->getOption(Libmemcached::OPT_PREFIX_KEY));
?>
--EXPECT--
string(3) "php"
string(3) "php"
string(0) ""
