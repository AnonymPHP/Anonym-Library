Anonym-Database-Tools
======================


Burada Migration ve backup araçlarını bulacaksınız, bu araçlar normal kullanım için değil, konsol uygulamaları ile kullanılmak
için tasarlanmıştır.

Kullanım için

```php

define('MIGRATION', 'migrationDosyalarınınbuluanacağıkonum');
define('MIGRATION_NAMESPACE', 'MIGRATION\SAHIP\OLACAĞI\NAMESPACE\\');
define('BACKUP', 'yedeklemeDosyalarınızınBulunacağıKonum');

```

// yaptıktan sonra composer.json dosyasına

```json

"MIGRATION\SAHIP\OLACAĞI\NAMESPACE\\":"migrationDosyalarınınbuluanacağıkonum";

```


eklemeniz gerek.
