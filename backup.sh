#!/bin/bash
echo "`date -u` run settlement: /usr/bin/curl -v -k https://www.9lp.com/settlement.php"
output=$(/usr/bin/curl -v -k https://www.9lp.com/settlement.php)
echo "`date -u` settlement output is $output"
echo "`date -u` settlement return is $?"

POSBACKUPSQL=pos-backup-$(date +%F).sql
echo "echo `date -u` sudo /usr/bin/mysqldump --defaults-extra-file=/home/ubuntu/.my.cnf --single-transaction --quick --lock-tables=false --all-databases > /home/ubuntu/workspace/kjwzh/backup/$POSBACKUPSQL"
output=$(sudo /usr/bin/mysqldump --defaults-extra-file=/home/ubuntu/.my.cnf --single-transaction --quick --lock-tables=false --all-databases > /home/ubuntu/workspace/kjwzh/backup/$POSBACKUPSQL)
echo "`date -u` backup return $output $?"

echo "`date -u` sudo /home/ubuntu/.local/bin/aws s3 cp /home/ubuntu/workspace/kjwzh/backup/$POSBACKUPSQL s3://elasticbeanstalk-us-west-2-551441213847/POSBackup/"
output=$(/home/ubuntu/.local/bin/aws s3 cp /home/ubuntu/workspace/kjwzh/backup/$POSBACKUPSQL s3://elasticbeanstalk-us-west-2-551441213847/POSBackup/)

echo "`date -u` upload return $output $?"
