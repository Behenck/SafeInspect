#!/bin/bash

sudo systemctl start docker
sudo docker-compose up -d
sudo docker-compose exec app bash 
