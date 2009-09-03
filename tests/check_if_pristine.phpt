--TEST--
Check if persistent object is new or an old persistent one
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip";
?>
--FILE--
<?php 
$m1 = new Libmemcached('id1');
$m1->setOption(Libmemcached::OPT_PREFIX_KEY, "foo_");

var_dump($m1->isPristine());

$m1 = new Libmemcached('id1');
var_dump($m1->isPristine());

$m2 = new Libmemcached('id1');
var_dump($m2->isPristine());
// this change affects $m1
$m2->setOption(Libmemcached::OPT_PREFIX_KEY, "bar_");

$m3 = new Libmemcached('id2');
var_dump($m3->isPristine());

$m3 = new Libmemcached();
var_dump($m3->isPristine());
--EXPECT--
bool(true)
bool(false)
bool(false)
bool(true)
bool(true)
