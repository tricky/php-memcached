--TEST--
Memcached::getByKey() with CAS
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php
$m = new Memcached();
$m->addServer('localhost', 11211, 1);

function the_callback(Memcached $memc, $key, &$value) {
	echo "called\n";
	$value = "1234";
	return 1;
}

function print_cas($cas) {
	if (is_integer($cas) && $cas != 0) {
		echo $cas, "\n";
	} elseif (is_string($cas) && $cas != 0) {
		echo $cas, "\n";
	} else {
		var_dump($cas);
	}
}

$m->set('foo', 1, 10);

$cas = null;
var_dump($m->getByKey('foo', 'foo', null, $cas));
print_cas($cas);
echo $m->getResultMessage(), "\n";

$cas = null;
var_dump($m->getByKey('', 'foo', null, $cas));
print_cas($cas);
echo $m->getResultMessage(), "\n";

$m->set('bar', "asdf", 10);

$cas = null;
var_dump($m->getByKey('foo', 'bar', null, $cas));
print_cas($cas);
echo $m->getResultMessage(), "\n";

$m->delete('foo');
$cas = null;
var_dump($m->getByKey(' д foo jkh a s едц', 'foo', null, $cas));
print_cas($cas);
echo $m->getResultMessage(), "\n";

$cas = null;
var_dump($m->getByKey(' д foo jkh a s едц', '', null, $cas));
print_cas($cas);
echo $m->getResultMessage(), "\n";

$m->delete('foo');
$cas = null;
var_dump($m->getByKey('foo', 'foo', 'the_callback', $cas));
print_cas($cas);
var_dump($m->getByKey('foo', 'foo'));
--EXPECTF--
int(1)
%i
SUCCESS
int(1)
%i
SUCCESS
string(4) "asdf"
%i
SUCCESS
bool(false)
NULL
NOT FOUND
bool(false)
NULL
A BAD KEY WAS PROVIDED/CHARACTERS OUT OF RANGE
called
string(4) "1234"
NULL
string(4) "1234"
