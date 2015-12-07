# Wordpress bootstrap

Easy installation of a ready-to-use wordpress using composer and vagrant

## Prerequisites:

for this to work you need a working installation of

 * [composer](https://getcomposer.org)
 * [Vagrant](https://vagrant.com)

## Installation

1. Create a new Project: ```composer create-project org_heigl/wordpress_bootstrap my-wordpress-folder```
2. Answer some questions during the installation. You can press 'enter' for the default values.
3. ```cd``` into the new folder: ```cd my-wordpress-folder```
4. start the VM: ```vagrant up```
5. Point your browser to http://127.0.0.1:8080.
6. There is no step 6

You can use "wpadmin" and "password" to log into your fresh wordpress-installation.

## Plugin- and Theme-management

This installation contains a [plugin](https://github.com/heiglandreas/wp_talkToComposer)
that keeps activated plugins in sync with your ```composer.json```-file.

Tha tway you can use the wordpress-plugin and theme-repository to find your favourite plugins
abd themes but you can rest assured that those will be available in your composer.json-file as well

That way you can add this project to your VCS of choice and transfer minimal data
to any other machine and with a ```composer install``` you will have a copy of your
wordpress-installation.

For more informations on how the plugins and themes are added to the composer.json-file
and how to add your own stuff that is not hosted on the wordpress-repository have a look
at https://github.com/heiglandreas/wp_talkToComposer

Currently only the setup is automated. If you have further ideas or want to implement
something feel free to open an issue or pull-request.

## More details:

Wordpress is installed into a folder ```wp``` and the wp_content-folder is taken out
of that installation and put beside that wp-folder as ```wp-content```. If you want
to adapt those settings have a look at the ```wp-config.php``` right inside the main folder.