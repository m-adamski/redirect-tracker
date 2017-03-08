# Redirect Tracker
The project was created to track all redirects and get the final URL. The structure of the project and assumptions are close to the Laravel framework.

### Installation
To run the project, you need to install a few dependencies:

#### Composer:
```ssh
$ cd /path/to/project
$ composer install
  or
$ php /path/to/project/composer.phar install
```

#### Bower
```ssh
$ cd /path/to/project
$ bower install
```

#### NPM
```ssh
$ cd /path/to/project
$ npm install
```

### Development
#### Docker
The project uses the Docker development platform. You can run environment with command:
```ssh
$ docker-compose build
$ docker-compose up -d
```

After starting the virtual server, the site is available at ``http://redirect-tracker.local``. To gain access to this address you need to add it to the hosts file:
```ssh
127.0.0.1       redirect-tracker.local
```

#### Gulp
Gulp is used to compile Sass into CSS styles:
```ssh
$ gulp
  or
$ gulp sass-watch
```