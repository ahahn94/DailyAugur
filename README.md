#  DailyAugur
## DailyAugur is a news paper / blogging software inspired by the news paper from Harry Potter.

#### DailyAugur is based on a simple docker-compose deployment of Apache2, PHP 7.0 and MySQL 5.5 (which is the latest version for ARM-based devices).
#### The apache2-php container is based on Debian.

## Getting Started With DailyAugur
- Install `docker` and `docker-compose`
- clone this repo to the computer you want to run DailyAugur on (or just download and unpack the zip file)
- run `fix_permissions.sh` (this is very important, if you run into trouble uploading images later you probably forgot this)
- modify `DAILYAUGUR_PATH` inside `DailyAugur.sh` to match your installation directory
- modify `COMPOSE_FILE` inside `DailyAugur.sh` to
    - amd64.yaml (AMD64)
    - armhf.yaml (ARM)
- change `AUTH_PASSWORD` inside your `.yaml` file to a strong password if you are using authentication
    - (optional) change `AUTH_USERNAME` too
- open your webbrowser and open the IP address of the computer running the DailyAugur installation at port 8082

## Server Control
- start the server by running `DailyAugur.sh` or `DailyAugur.sh start`
- to stop the server just run `DailyAugur.sh stop`
- to stop the server and delete the docker containers, run `DailyAugur.sh delete`.
- to rebuild the images and start the server, run `DailyAugur.sh build`.

## Server Autostart
If you want to automatically start DailyAugur when starting the computer, you can e.g. create a cron job that runs DailyAugur.sh.

## Backups
Your database will be stored in the `mysql-data` directory and your website data will be stored in `src`.  
You can easily make a backup of your server data by copying these directories to your backup target.

## Security
DailyAugur uses HTTP Basic Authentication to handle authorisation on the admin area.  
HTTP Basic Authentication does not provide ANY encryption, so you should make sure that you enforce TLS encryption of
the connection to prevent man-in-the-middle attacks.

## Touch Support
DailyAugur supports touch navigation. Just swipe left/right on an article to get to the next/previous one.

## Used Libraries And Fonts
DailyAugur makes use of several libraries:
- [Bootstrap 4](https://getbootstrap.com/) (admin area styling)
- [FontAwesome](https://fontawesome.com/) (icons)
- [jQuery](https://jquery.com/) (needed by Bootstrap)
- [Popper.JS](https://popper.js.org/) (needed by Bootstrap)

It also uses the [Mugglenews](https://www.deviantart.com/nathanthenerd/art/Mugglenews-244787497) font as the main font 
for the pages.

## Legacy Software
For compatibility reasons to ARMHF, this project uses MySQL 5.5.
This may change as newer versions become available as docker images for ARMHF.

## Copyright & License
Copyright (c) 2018 ahahn94.

DailyAugur is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.