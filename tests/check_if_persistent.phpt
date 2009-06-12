--TEST--
Check if persistent object is new or an old persistent one
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php 
require('php_test_init.php');
$m1 = new $php_class_name('id1');
$m1->setOption($php_class_name_OPT_PREFIX_KEY, "foo_");

var_dump($m1->isPristine());
var_dump($m1->isPersistent());

$m1 = new $php_class_name('id1');
var_dump($m1->isPristine());
var_dump($m1->isPersistent());

$m2 = new $php_class_name('id1');
var_dump($m2->isPristine());
var_dump($m2->isPersistent());
// this change affects $m1
$m2->setOption($php_class_name_OPT_PREFIX_KEY, "bar_");

$m3 = new $php_class_name('id2');
var_dump($m3->isPristine());
var_dump($m3->isPersistent());

$m3 = new $php_class_name();
var_dump($m3->isPristine());
var_dump($m3->isPersistent());

// objects have the same resource, but they are not the same object.
var_dump($m1 === $m2);
var_dump($m1->getOption($php_class_name_OPT_PREFIX_KEY));
--EXPECT--
bool(true)
bool(true)
bool(false)
bool(true)
bool(false)
bool(true)
bool(true)
bool(true)
bool(true)
bool(false)
bool(false)
string(4) "bar_"
