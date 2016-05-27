# push

*A websocket layer for realtime notifications and content updates*

## Installation

Install the plugin and its dependencies:

```bash
cd app/plugin/
git clone https://github.com/phproject-plugins/push.git
cd push/
composer install
```

Copy `config-sample.php` to `config.php` and edit the values to match your preferred setup.

## Usage

The Push plugin has two major components, the Phproject integration layer that's autoloaded automatically, and the websocket server for browser connections.

To start the websocket server, start `bin/push-server.php` as a background process. One way to do this would be using GNU screen:

```bash
screen -S push -d -m php .../app/plugin/push/bin/push-server.php
```
