--TEST--
Conf settings persist.
--SKIPIF--
<?php if (!extension_loaded("memcached")) print "skip"; ?>
--FILE--
<?php 
$m1 = new Libmemcached('id1');
$m1->setOption(Libmemcached::OPT_PREFIX_KEY, 'php');
$m1->addServer('localhost', 11211);
$m1->set('foo', 'bar');

for ($i = 1000; $i > 0; $i--) {
	$m1 = new Libmemcached('id1');
	$rv = $m1->get('foo');
	if ($rv !== 'bar') {
		echo "Expected bar got:";
		var_dump($rv);
		die();
	}

	$prefix = $m1->getOption(Libmemcached::OPT_PREFIX_KEY);
	if ($prefix !== 'php') {
		echo "Expected prefix php got:";
		var_dump($prefix);
		die();
	}
}

?>
--EXPECT--
