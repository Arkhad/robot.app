MY_USERNAME='root'
MY_PASSWORD=''
DBNAME='robot'
HOST='localhost'
CHARSET='utf8mb4'
COLLATE='utf8mb4_unicode_ci'

USER_USERNAME='tony'
USER_PASSWORD='tony'

ENV='.env'

sed -i "s/DB_DATABASE=homestead/DB_DATABASE=$DBNAME/g" $ENV
sed -i "s/DB_USERNAME=homestead/DB_USERNAME=$USER_USERNAME/g" $ENV
sed -i "s/DB_PASSWORD=secret/DB_PASSWORD=$USER_PASSWORD/g" $ENV


MySQL=$(cat <<EOF
DROP DATABASE IF EXISTS $DBNAME;
CREATE DATABASE $DBNAME DEFAULT CHARACTER SET $CHARSET COLLATE $COLLATE;
DELETE FROM mysql.user WHERE user='$USER_USERNAME' and host='$USER_PASSWORD';
GRANT ALL PRIVILEGES ON $DBNAME.* to '$USER_USERNAME'@'$HOST' IDENTIFIED BY '$USER_PASSWORD' WITH GRANT OPTION;
EOF
)

echo $MySQL | mysql --user=$MY_USERNAME --password=$MY_PASSWORD

php artisan migrate --seed