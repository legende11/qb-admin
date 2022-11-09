### USAGE
Login with your login detail.

Use it.

Enjoy it.


### SETUP
Use my qb-api resource (github.com/legende11/qb-api/)

Host site on a server on path /qb-admin/

Edit api.php & database.php to match your database/server



Import SQL:

```sql
CREATE TABLE IF NOT EXISTS `admin-login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
```

Create a new user:

username: string

password: PHP password hash ([generator](https://freetools.dev/php-password) use default settings)

