#!/bin/bash

echo "Running user service tests..."

docker-compose exec user_service bash -c '
    cd user &&
    echo "Unit test" &&
    php bin/phpunit tests/Unit/UserControllerTest.php &&
    echo "Functional test" &&
    php bin/phpunit tests/Functional/UserControllerTest.php &&
    echo "Integration test" &&
    php bin/phpunit tests/Integration/UserControllerTest.php
	  echo ""
	  sleep 5
'