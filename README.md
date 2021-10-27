# Subscription Platform

### Setup

```
➜  git clone https://github.com/shahriyear/subscription-platform.git 

➜  cd subscription-platform
 
➜  composer install

```

**ENV Setup**

```
//db connection
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=subscription
DB_USERNAME=subscription_user
DB_PASSWORD=123456

//job queue type
QUEUE_CONNECTION=database

//smtp mail (set proper credential)
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=test@gmail.com
MAIL_PASSWORD=test@@
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=test@gmail.com
MAIL_FROM_NAME="${APP_NAME}"

```

```
➜  php artisan migrate

➜  php artisan db:seed

➜  php artisan serve

➜  php artisan queue:listen
```

### End points


**Post**

```
// website_id will be 1 to 10 for fresh migration
[POST] http://localhost:8000/api/post
```

```javascript
{
	"website_id":1,
	"title":"this is the title",
	"description":"this is the description"
}

```

**Subscriber**

```
[POST] http://localhost:8000/api/subscribe
```

```javascript
{
	"website_id":1,
	"email":"mail@test.com"
}

```

*https://documenter.getpostman.com/view/3225806/UV5deuSs#23f5d957-e240-4962-a389-abd2c3db14ad*

