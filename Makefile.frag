test: tests/php_class_name.php
tests/php_class_name.php: config.h
	@echo '<?php' > test/php_class_name.php
	@echo '	$$php_class_name = "$(PHP_MEMCACHED_CLASS_NAME)";' >> tests/php_class_name.php
	@echo '	$$php_exception_name = "$(PHP_MEMCACHED_EXCEPTION_NAME)";' >> tests/php_class_name.php
