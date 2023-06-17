#!/bin/bash

supervisord -c /etc/supervisor/supervisord.conf
supervisorctl -c /etc/supervisor/supervisord.conf
supervisorctl reread
supervisorctl update
supervisorctl start listen-events-worker:*
