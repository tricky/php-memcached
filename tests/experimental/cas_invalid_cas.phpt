--TEST--
Memcached::cas() CAS token validity
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php
$m = new Memcached();
$m->addServer('localhost', 11211, 1);

error_reporting(0);

$m->delete('foo');

$php_errormsg = 'Ok';
echo "zero CAS is invalid\n";
var_dump($m->cas("0", 'foo', 'the value', 10));
echo $php_errormsg, "\n";
echo $m->getResultMessage(), "\n";

$php_errormsg = 'Ok';
echo "max signed 64 bit CAS is valid\n";
var_dump($m->cas("9223372036854775807", 'foo', 'the value', 10));
echo $php_errormsg, "\n";
echo $m->getResultMessage(), "\n";

$php_errormsg = 'Ok';
echo "over signed 64 bit CAS is invalid\n";
var_dump($m->cas("9223372036854775808", 'foo', 'the value', 10));
echo $php_errormsg, "\n";
echo $m->getResultMessage(), "\n";

$php_errormsg = 'Ok';
echo "huge >64 bit CAS is invalid\n";
var_dump($m->cas("9999999999999999999999", 'foo', 'the value', 10));
echo $php_errormsg, "\n";
echo $m->getResultMessage(), "\n";

$php_errormsg = 'Ok';
echo "bad asdfasd CAS\n";
var_dump($m->cas("asdfasd", 'foo', 'the value', 10));
echo $php_errormsg, "\n";
echo $m->getResultMessage(), "\n";

$php_errormsg = 'Ok';
echo "empty string CAS\n";
var_dump($m->cas("", 'foo', 'the value', 10));
echo $php_errormsg, "\n";
echo $m->getResultMessage(), "\n";

$php_errormsg = 'Ok';
echo "123123asdf CAS should be all digits\n";
var_dump($m->cas("123123asdf", 'foo', 'the value', 10));
echo $php_errormsg, "\n";
echo $m->getResultMessage(), "\n";

$php_errormsg = 'Ok';
echo "-123 is valid\n";
var_dump($m->cas("-123", 'foo', true, 10));
echo $php_errormsg, "\n";
echo $m->getResultMessage(), "\n";

--EXPECTF--
zero CAS is invalid
bool(false)
Memcached::cas(): invalid%s
PROTOCOL ERROR
max signed 64 bit CAS is valid
bool(false)
Ok
NOT FOUND
over signed 64 bit CAS is invalid
bool(false)
Memcached::cas(): invalid%s
PROTOCOL ERROR
huge >64 bit CAS is invalid
bool(false)
Memcached::cas(): invalid%s
PROTOCOL ERROR
bad asdfasd CAS
bool(false)
Memcached::cas(): invalid%s
PROTOCOL ERROR
empty string CAS
bool(false)
Memcached::cas(): invalid%s
PROTOCOL ERROR
123123asdf CAS should be all digits
bool(false)
Memcached::cas(): invalid%s
PROTOCOL ERROR
-123 is valid
bool(false)
Ok
NOT FOUND
