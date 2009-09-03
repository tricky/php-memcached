--TEST--
Libmemcached options
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php 
$m = new Libmemcached();
$m->setOption(Libmemcached::OPT_SERIALIZER, Libmemcached::SERIALIZER_PHP);

var_dump($m->getOption(Libmemcached::OPT_COMPRESSION));
var_dump($m->getOption(Libmemcached::OPT_SERIALIZER));
var_dump($m->getOption(Libmemcached::OPT_SOCKET_SEND_SIZE));

$m->setOption(Libmemcached::OPT_PREFIX_KEY, "\x01");

var_dump($m->getOption(Libmemcached::OPT_HASH) == Libmemcached::HASH_DEFAULT);
$m->setOption(Libmemcached::OPT_HASH, Libmemcached::HASH_MURMUR);
var_dump($m->getOption(Libmemcached::OPT_HASH) == Libmemcached::HASH_MURMUR);

?>
--EXPECTF--
bool(true)
int(1)

Warning: Libmemcached::getOption(): no servers defined in %s on line %d
NULL

Warning: Libmemcached::setOption(): bad key provided in %s on line %d
bool(true)
bool(true)
