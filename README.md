# helloprint

Distributed System Challenge

## Prerequisites

Composer - https://getcomposer.org/download/
RabbitMQ server - https://www.rabbitmq.com/download.html

##Configuration

Configuration is split between the three different components: webserver, producer and consumer.

###Webserver

Open *main.js* located at /webserver/assets/js/ . Notice the following properties and change according to your personal setup.

**helloprint.PRODUCER_SERVER** - API server location
**helloprint.PRODUCER_ROOT_PATH** - API server root directory location

###Producer

- Install lib dependencies and generate autoloader through ```composer install``` .
- On .htaccess file, change RewriteBase to match your API server root directory.
- On /producer/src/Configuration.php, set up your database, queue and routing settings as needed.

###Consumer
- Install lib dependencies and generate autoloader through ```composer install``` .
- On /consumer/src/Configuration.php, set up your database and queue settings as needed.
- Configure sendmail service with your email server credentials.

##Usage

Simply access login.html on your webserver to test it out. Don't forget to have your RabbitMQ service running.

## Authors

* **Filipe Mendonça** - *Initial work* - [filipesm-7](https://github.com/filipesm-7)
