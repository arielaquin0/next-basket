#!/bin/bash

echo "Starting Docker containers..."

docker-compose up -d

read -p "Press any key to close this window"
