# helloprint

Distributed System Challenge

## Prerequisites

Composer - https://getcomposer.org/download/

Docker - https://www.docker.com/

## Setup

Run ```composer install``` inside both producer and consumer to download lib dependencies
Run ```docker-compose build``` to build the Dockerfile images
Run ```docker-compose up``` to bring the containers up

Visit http:localhost:8080/login to view the appl

### Launching the consumer script
To launch the consumer script access the consumer-server container and run the following command:

```php consumer.php <queue_name> <num_workers>```

where *<queue_name>* is the queue you will be consuming from and *num_workers* is the number of workers you want to launch. The arguments are optional. If no arguments are presented, the script will run the default queue with one worker. 

Since sending emails is a separate service from the password request, you will need two separate queues running - *rpassword* for processing password requests and *email* for sending emails (queue names are configurable).

## Authors

* **Filipe Mendonça** | [filipesm-7](https://github.com/filipesm-7)
