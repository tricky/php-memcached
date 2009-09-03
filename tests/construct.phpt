--TEST--
Libmemcached constructor
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php 
$m = new Libmemcached();
echo get_class($m);
?>
--EXPECT--
Libmemcached
