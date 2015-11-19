# -*- mode: ruby -*-
# vi: set ft=ruby :

$install = <<SCRIPT
export DEBIAN_FRONTEND=noninteractive
apt-get -yq update
apt-get -yq --no-install-suggests --no-install-recommends --force-yes install apache2 mysql-server-5.6 php5 php5-mysqlnd apparmor-utils
SCRIPT

$configure = <<SCRIPT
cat > /etc/apache2/conf-available/wpcomposer.conf << "EOF"
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /vagrant
    DirectoryIndex index.php
    ErrorLog ${APACHE_LOG_DIR}/wpcomposer-error.log
    CustomLog ${APACHE_LOG_DIR}/wpcomposer-access.log combined
</VirtualHost>
<Directory "/vagrant">
    Options Indexes FollowSymLinks Includes ExecCGI
    AllowOverride All
    Require all granted
</Directory>
EOF
a2enconf wpcomposer > /dev/null 2>&1
apachectl graceful
SCRIPT

$mysql = <<SCRIPT
mysql -u root -e 'CREATE DATABASE wordpress CHARACTER SET utf8 COLLATE utf8_bin;'
mysql -u root -e 'GRANT ALL PRIVILEGES ON wordpress.* TO wpuser@localhost IDENTIFIED BY "wppass";'
wget -O /tmp/wordpress.dump.sql.tgz  http://dev.abenteuer-reisen.de/wordpress.dump.sql.tgz
tar xzf /tmp/wordpress.dump.sql.tgz -C /tmp
mysql -u root -D wordpress < /tmp/wordpress.dump.sql;
SCRIPT

Vagrant.configure(2) do |config|
  config.vm.box = 'chef/ubuntu-14.04'

  # LDAP port
  config.vm.network 'forwarded_port', guest: 80, host: 8080

  config.vm.provision 'shell', inline: $install
  config.vm.provision 'shell', inline: $configure
  config.vm.provision 'shell', inline: $mysql
end