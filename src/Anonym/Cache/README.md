Anonym-Cache
=============

Önbellekleme işlemlerinin yapılacağı sınıf

Sürücü Seçimi
-------------

```php

$cache = new Cache($options);
$driver = $cache->driver('file');

```

>**Desteklenenler**: zend, xcache, memcache, redis, predis, file, apc, array

Kullanım
--------

Aşağıdaki kullanımlar tüm sınıflarda aynıdır, eğer değilse bile size bir exception oluşturur

**Veri Önbellekleme**

```php

$driver->set('test', 'value', 3600); // 3600 = 1 saat

```

------------------

**Veri Çekme**

```php

$get = $driver->get('test');

```

-------------

**Veri Silme**

```php

$driver->delete('test');

```

--------------

**Tüm Verileri Silme**

```php

$driver->flush();

```
