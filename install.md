# SEOfy

# Installation

The below installation steps are for Ubuntu OS only. Refer to other guides for installation on different OS.

### Dependencies

### APT Update

```bash
apt-get update && apt-get -y upgrade
```

### Curl (used in several places during installation)

```bash
apt-get -y install curl
```

### Installed apt-add-repository

```bash
apt -y install software-properties-common curl apt-transport-https ca-certificates gnupg
```

### Add Ondřej Surý PPA repository

```bash
LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php
```

### Add Chris-lea redis server repository

```bash
add-apt-repository -y ppa:chris-lea/redis-server
```

### Download mariadb setup and install it

```bash
curl -sS https://downloads.mariadb.com/MariaDB/mariadb_repo_setup | sudo bash
```

### Install Dependencies

```bash
apt -y install php8.0 php8.0-{cli,gd,mysql,pdo,mbstring,tokenizer,bcmath,xml,fpm,curl,zip} mariadb-server nginx tar unzip git redis-server npm
```

### Composer

```bash
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
```

### Downloading files

```bash
mkdir -p /var/www/seofy
cd /var/www/seofy
git clone https://github.com/RyderAsKing/SEOfy.git ./
chmod -R 755 storage/* bootstrap/cache/
```

### Storage setup, Key setup, Packages install using composer and NPM

```bash
# Copy .env.example to .env
cp .env.example .env

# Composer install
composer install --no-dev --optimize-autoloader

# NPM install
npm install

# building assets
npm run build

# Only run the command below if you are installing this Panel for the first time
php artisan key:generate --force

# You should create a symbolic link from public/storage to storage/app/public
php artisan storage:link
```

### Database Setup

#### Login as root

```bash
mysql -u root -p
```

#### Create database, user and grant all privileges

```bash
CREATE DATABASE seofy;
CREATE USER 'seofy'@'127.0.0.1' IDENTIFIED BY 'seofy';
GRANT ALL PRIVILEGES ON *.* TO 'seofy'@'127.0.0.1' WITH GRANT OPTION;
FLUSH PRIVILEGES;
```

### Configuration

```bash
nano .env
#Example .env vars
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seofy
DB_USERNAME=seofy
DB_PASSWORD=seofy
```

### Installing tables and setting up permission

```bash
php artisan migrate --seed --force
chown -R www-data:www-data /var/www/seofy/*
```

# Example NGINX Config

```bash
nano /etc/nginx/sites-available/seofy.conf
# Paste the code below in the file and then save and exit
server {
        listen 80;
        root /var/www/seofy/public;
        index index.php index.html index.htm index.nginx-debian.html;
        server_name yourdomain.com; # Change this

        location / {
                try_files $uri $uri/ /index.php?$query_string;
        }

        location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        }

        location ~ /\.ht {
                deny all;
        }
}

# Enable NGINX Config
# You do not need to symlink this file if you are using CentOS.
sudo ln -s /etc/nginx/sites-available/seofy.conf /etc/nginx/sites-enabled/seofy.conf

# Check for nginx errors
sudo nginx -t

# You need to restart nginx regardless of OS. only do this you haven't received any errors
systemctl restart nginx
```

### SSL (Optional but recommended)

```bash
# Make sure you have python3 installed
sudo add-apt-repository ppa:certbot/certbot
sudo apt-get update
sudo apt-get install python3-certbot-nginx
sudo certbot --nginx -d yourdomain.com
```

## Finishing up

# Updating

### Enable Maintenance Mode

```bash
cd /var/www/seofy
sudo php artisan down
```

### Downloading new files

```bash
sudo git stash
sudo git pull
sudo chmod -R 755 /var/www/seofy
```

### Updating database

```bash
sudo php artisan migrate --seed --force
```

### Clear cache

```bash
sudo php artisan view:clear
sudo php artisan config:clear
```

### Updating dependencies

```bash
sudo composer install --no-dev --optimize-autoloader
```

```bash
npm install express express-ws ws axios
```

### Updating permissions

```bash
sudo chown -R www-data:www-data /var/www/seofy/*
```

### Restarting queue workers

```bash
sudo php artisan queue:restart
```

### Disable maintenance mode

```bash
sudo php artisan up
```

# Debugging

Get the past 100 logs

```bash
tail -n 100 /var/www/seofy/storage/logs/laravel.log | nc termbin.com 9999
```
