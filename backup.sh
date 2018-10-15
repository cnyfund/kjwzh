#!/bin/bash
POSBACKUPSQL=pos-backup-$(date +%F).sql
/usr/bin/mysqldump --defaults-extra-file=/home/ubuntu/.my.cnf --single-transaction --quick --lock-tables=false --all-databases > /home/ubuntu/workspace/kjwzh/backup/$POSBACKUPSQL
/home/ubuntu/.local/bin/aws s3 cp /home/ubuntu/workspace/kjwzh/backup/$POSBACKUPSQL s3://elasticbeanstalk-us-west-2-551441213847/POSBackup/
