Anonym-Security
================

these component will be used for framework security

TypeHint
--------


```php

TypeHint::boot();
TypeHint::handle();

```

Firewall
--------

```php


$allowed = [
  'allowedUserAgent' => 'mozilla',
  'allowedAccept' => '*',
  'allowedLanguage' => 'tr-TR',
  'allowedReferer' => 'www.google.com',
  'allowedMethod' => ['GET', 'POST'],
  'allowedConnection' => '*',
  'allowedEncoding' => 'utf-8'
];

$firewall = new Firewall($allowed);
$firewall->run();

```

Authentication
-------------

Login, Exit and more in this namespace

**Login:**


```php

use Anonym\Components\Security\Authentication\Login;
use Anonym\Components\Security\Authentication\AuthenticationLoginObject;
$login = new Login($db, $tables);

$remember = true; // giriş işlemi cookie 'e atanacakmı?
$login = login->login('username', 'password', $remember);

var_dump($login); // false or AuthenticationLoginObject
 
 if($login instanceof AuthenticationLoginObject){
  
   echo $login['username']; // arrayable class
 
 }
 
```


**Register:**

```php

use Anonym\Components\Security\Authentication\Register;

$register = new Register($db, $tables);
$register = register->register([
 'username' => 'test',
 'password' => 'test'
]);

var_dump($register); // true or false
```

**Exit:**

```php

use Anonym\Components\Security\Authentication\Logout;
$logout = new Logout();
$logout->logout(); // true

```


Security
--------


**xss protection:**

```php
$security = new Security();
$xss = $security->xssProtection($metin);
``,

CsrfToken
---------


```php

$csrf = new CsrfToken();
$token = $csrf->getToken(); // $csrf->token;

```

-----------
**check the csrf token**

```php

$csrf->run();

```
