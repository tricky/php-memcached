--TEST--
Memcached result codes.
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php
require('php_test_init.php');
$m = new $php_class_name();
echo $m->getResultString(), "\n";

$m->addServer('127.0.0.1', 11211, 1);
echo $m->getResultCode(), "\n";
echo $m->getResultString(), "\n";

$m->set('bar_foo', 10);
echo $m->getResultString(), "\n";

$m->delete('bar_foo');
echo $m->getResultString(), "\n";

$m->delete('bar_foo');
echo $m->getResultCode(), "\n";
echo $m->getResultString(), "\n";

$m->getMulti(array('asdf_a', 'jkhjkhjkb', 'nbahsdgc'));
echo $m->getResultString(), "\n";
$code = $m->getResultCode();

$m2 = new $php_class_name();
$m2->getMulti(array('asdf_a', 'jkhjkhjkb', 'nbahsdgc'));
echo $m2->getResultCode(), "\n";
echo $m2->getResultString(), "\n";

$m2->addServer('127.0.0.1', 7312, 1);
echo $m2->getResultCode(), "\n";
echo $m2->getResultString(), "\n";

$m2->delete('bar_foo');
echo $m2->getResultCode(), "\n";
echo $m2->getResultString(), "\n";

var_dump($m->getResultCode() == $code);
$m = new $php_class_name('test1');
$m->addServer('127.0.0.1', 11211);
$m2 = new $php_class_name('test1');

$m->delete('moikkamitakuuluu');
echo $m->getResultString(), "\n";
$m2->set('minapaasetannih', 10, 1);
echo $m->getResultString(), "\n";
echo $m2->getResultString(), "\n";


?>
--EXPECT--
SUCCESS
0
SUCCESS
SUCCESS
SUCCESS
16
NOT FOUND
SUCCESS
20
NO SERVERS DEFINED
0
SUCCESS
25
SYSTEM ERROR
bool(true)
NOT FOUND
SUCCESS
SUCCESS
