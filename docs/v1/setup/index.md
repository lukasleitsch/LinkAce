---
title: Setup
layout: default
---

## Setup with Docker

Working with Docker is pretty straight forward. The image available on Docker Hub contains the application code, any
precompiled assets as well as PHP installed. This means you can use any web server you want, any cache driver you want
and any database system you want.

To make things easier, we provide a Docker Compose file (docker-compose.production.yml) in the repository which
contains all needed services, perfectly configured to just run the application right away.

### 1. Copy all needed files

All files you need are `docker-compose.production.yml`, `.env.docker` and `nginx.conf`. Copy both to the directory you
want to use for the application.

### 2. Modify the .env.docker file

Now open the `.env.docker` file and follow the instructions inside the file. All needed variables you have to configure
are marked accordingly.

### 3. Modify the nginx.conf file (optional)

This step is optional but may depend on your setup. You probably want to run the app standalon on a server. For this I
highly recommend providing SSL certificates ([Let's Encrypt](https://letsencrypt.org/)) and change the `nginx.conf` as 
well as the `docker-compose.production.yml` file:

* In `nginx.conf`: replace `listen 0.0.0.0:8085` with `listen 0.0.0.0:8085 ssl;`
* In `nginx.conf`: uncomment the lines beginning with `ssl_certificate` and change the certificate file names
* In `docker-compose.production.yml`: replace `"127.0.0.1:80:8085"` with `"127.0.0.1:443:8085"`.
* In `docker-compose.production.yml`: uncommend the `/path/to/ssl/certificates:/bitnami/nginx/conf/bitnami/certs` line 
  and set the correct path to your certificates before the colon.

### 4. Run the application

After you completed the above steps, run the following command to start up the container setup:

```bash
docker-compose up -d --build
```


## Setup without Docker

The application was developed with being used with Docker in mind. All following steps will try to work around this but
cannot be guaranteed to work in every environment.

### Requirements

* PHP > 7.2
* MySQL compatible database server
* nginx / Apache web server

### 1. Get the .zip file

To make things easier I provide a .zip file that contains all precompiled assets and stuff like that so you can use
LinkAce right away. Download the package from the [latest release](https://github.com/Kovah/LinkAce/releases).

Extract all files and place them wherever you need them. This obviously depends on how and where you want to run the
app.

### 2. Edit the .env file

Make a copy of the `.env.example` file and name it `.env`. Open the file and follow all instructions inside the file. 
All needed variables you have to configure are marked accordingly.

### 3. Point your web server to /public

For security reasons the application won't run from the base filder where you extracted the files to. Instead, point
your web server to the `/public` directory in your linkace folder.

If you are using Apache, LinkAce already ships with a proper .htaccess file.

If you are using nginx, please add the following lines to your nginx configuration file:

```
add_header X-Frame-Options "SAMEORIGIN";
add_header X-XSS-Protection "1; mode=block";
add_header X-Content-Type-Options "nosniff";

location / {
  try_files $uri $uri/ /index.php?$query_string;
}

location ~* \.(?:css|js|map|scss)$ {
  expires 7d;
  access_log off;
  add_header Cache-Control "public";
  try_files $uri @fallback;
}

error_page 404 /index.php;
```

### 4. Import a database dump to your Database

To be able to run the app you need to import a database dump into your database.
> @TODO