Anonym-Http
================

Bu açıklamada http client de sahip olunan sınıfların nasıl kullanıldığını açıklıyorum.

Response
----------------


```php

$response = new Response('İçerik', 200); // durum kodu
// $response = Response::make('Hello World', 200);
// $response->setCharset('UTF-8');
$response->send();

```


**getCookies:**

```php
$cookies = $response->getCookies();
```


Başlık Eklemek
-------------

```php

$respone->header('baslik:deger');

```

JsonResponse
-----------

```php

$json = $response->jsonResponse($json, 200);

```

XmlResponse
---------------

```php

$xml= $reponse->xmlResponse($xml, 200);

```
Yönlendirme
-----------

```php

$redirect = new RedirectResponse('url', $time); // yönlendirilecek adres ve süre, süre öntanımlı olarak 0 dır
$redirect->send();

```
