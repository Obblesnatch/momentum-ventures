# Trip Builder

This app is built off of the [Nova Framework](https://github.com/nova-framework/framework)

## Demo

A live demo can be found at [tripbuilder.justinconabree.com](http://tripbuilder.justinconabree.com)

## Summary

This application can be used to find flights from one destination to another. Flights can then be added and removed from your trip.

I haven't worked with Nova Framework before this so there may be areas where more efficient ways of doing things could've been done.
The installation endpoint could be improved to look at versioning and only install versions that haven't been installed yet. I coded something for this in codeignighter but wanted to try a new, lighter framework for this project.

## Requirements

**In addition to [Nova Frameworks requirements](https://github.com/nova-framework/framework)**

- MySQL Database named momentum_ventures (or change the database name in app/Config/Database.php and app/Config.php)

## Installation

#### Setup

Once you've downloaded all the files or cloned the repo to the folder on your server, add the following to your **virtual host file**
```
<VirtualHost *:80>
    ServerAdmin justinconabree@justinconabree.com
    DocumentRoot "C:\wamp\www\momentum\public"
    ServerName momentum.venture

    <Directory "C:\wamp\www\momentum\public">
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```

And the following to your **host file**
```
127.0.0.1		momentum.ventures
```
> **Note any alterations to the paths or domain can be done in app/Config/App.php**

#### Setting up the base data
It's simple! Just head on over to the **/install** endpoint. The app takes care of the rest.

> **Note any alterations to the database configuration can be done in app/Config.php and app/Config/Database.php**

## Documentation
###### App sepcific documentation
API references can be found at [http://justinconabree.com/trip-builder-api](http://justinconabree.com/trip-builder-api)

###### Documentation for Nova Framework
Full docs & tutorials are available on [novaframework.com](http://novaframework.com) and the [Github Wiki](https://github.com/nova-framework/framework/wiki).

Offline docs are available in PDF, EPUB and MOBI formats on [Leanpub](https://leanpub.com/novaframeworkmanual22).

Screencasts are available on [Novacasts](http://novacasts.com).

## License

The Nova Framework is under the MIT License, you can view the license [here](https://github.com/nova-framework/framework/blob/master/LICENSE.txt).
