--TEST--
Memcached::get() UDP
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php
$m = new Memcached();
$m_udp = new Memcached();

$m_udp->setOption(Memcached::OPT_USE_UDP, true);

$m->addServer('127.0.0.1', 11211, 1);
var_dump($m_udp->addServer('127.0.0.2', 11211, 1));
echo $m_udp->getResultMessage(), "\n";

$m->delete('foo');

//error_reporting(0);
var_dump($m->get('foo'));
var_dump($m_udp->set('foo', "asdf", 10));
echo $m_udp->getResultMessage(), "\n";

var_dump($m->get('foo'));
echo $m->getResultMessage(), "\n";

--EXPECTF--
bool(true)
SUCCESS
NULL
bool(true)
SUCCESS
string(4) "asdf"
SUCCESS
