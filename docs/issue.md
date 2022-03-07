# Install problems and it solutions

## Bind address already in use

#### Error

``
Error starting userland proxy: listen tcp4 0.0.0.0:80: bind: address already in use
``

#### Solution
1) Try to find who take your port and kill this process ``
2) Run `service nginx stop` or `service apache2 stop`
3) Run `systemctl disable nginx` or `systemctl disable apache2`