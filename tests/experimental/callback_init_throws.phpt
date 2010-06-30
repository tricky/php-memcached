--TEST--
Callback initializer throws and dies
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php 

$arg = 'callback_arg';
$id = 'my_persistent_id';

function init_cb($m, $id, $arg) {
	var_dump($m->isPersistent());
	throw new RuntimeException('Cb exception');
}

function init_cb_die($m, $id) {
	die("quit in cb");
}

error_reporting(0);

echo "cb with exception\n";
try {
	$m1 = new Memcached(null, 'init_cb', array(1 => 'foo'));
} catch (RuntimeException $e) {
	echo $e->getMessage(), "\n";
}

echo "cb persistent with exception\n";
try {
	$m2 = new Memcached('foo', 'init_cb', array(1 => 'foo'));
} catch (RuntimeException $e) {
	echo $e->getMessage(), "\n";
}

echo "cb persistent dies\n";
try {
	$m3 = new Memcached('bar', 'init_cb_die', array(1 => 'foo'));
} catch (RuntimeException $e) {
	echo $e->getMessage(), "\n";
}
echo "not run\n";

--EXPECT--
cb with exception
bool(false)
Cb exception
cb persistent with exception
bool(true)
Cb exception
cb persistent dies
quit in cb
