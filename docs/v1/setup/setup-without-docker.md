---
title: Setup without Docker
layout: default
---

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