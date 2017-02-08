---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://laravel.pres/docs/collection.json)
<!-- END_INFO -->

#general
<!-- START_57011a4e29c6bc1cfec9270de49657bf -->
## Authorize a client to access the user&#039;s account.

> Example request:

```bash
curl "http://global2.dk/mobileapi/public/oauth/authorize" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://global2.dk/mobileapi/public/oauth/authorize",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "unsupported_grant_type",
    "message": "The authorization grant type is not supported by the authorization server.",
    "hint": "Check the `grant_type` parameter"
}
```

### HTTP Request
`GET oauth/authorize`

`HEAD oauth/authorize`


<!-- END_57011a4e29c6bc1cfec9270de49657bf -->
<!-- START_e48cc6a0b45dd21b7076ab2c03908687 -->
## Approve the authorization request.

> Example request:

```bash
curl "http://global2.dk/mobileapi/public/oauth/authorize" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://global2.dk/mobileapi/public/oauth/authorize",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST oauth/authorize`


<!-- END_e48cc6a0b45dd21b7076ab2c03908687 -->
<!-- START_de5d7581ef1275fce2a229b6b6eaad9c -->
## Deny the authorization request.

> Example request:

```bash
curl "http://global2.dk/mobileapi/public/oauth/authorize" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://global2.dk/mobileapi/public/oauth/authorize",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE oauth/authorize`


<!-- END_de5d7581ef1275fce2a229b6b6eaad9c -->
<!-- START_a09d20357336aa979ecd8e3972ac9168 -->
## Authorize a client to access the user&#039;s account.

> Example request:

```bash
curl "http://global2.dk/mobileapi/public/oauth/token" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://global2.dk/mobileapi/public/oauth/token",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST oauth/token`


<!-- END_a09d20357336aa979ecd8e3972ac9168 -->
<!-- START_e96d5ebaecbbcd30089fa499c8d21792 -->
## Get all of the authorized tokens for the authenticated user.

> Example request:

```bash
curl "http://global2.dk/mobileapi/public/oauth/tokens" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://global2.dk/mobileapi/public/oauth/tokens",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET oauth/tokens`

`HEAD oauth/tokens`


<!-- END_e96d5ebaecbbcd30089fa499c8d21792 -->
<!-- START_a9a802c25737cca5324125e5f60b72a5 -->
## Delete the given token.

> Example request:

```bash
curl "http://global2.dk/mobileapi/public/oauth/tokens/{token_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://global2.dk/mobileapi/public/oauth/tokens/{token_id}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE oauth/tokens/{token_id}`


<!-- END_a9a802c25737cca5324125e5f60b72a5 -->
<!-- START_abe905e69f5d002aa7d26f433676d623 -->
## Get a fresh transient token cookie for the authenticated user.

> Example request:

```bash
curl "http://global2.dk/mobileapi/public/oauth/token/refresh" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://global2.dk/mobileapi/public/oauth/token/refresh",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST oauth/token/refresh`


<!-- END_abe905e69f5d002aa7d26f433676d623 -->
<!-- START_258e7e83c3ea28db7720e63d358b33ff -->
## Get all of the clients for the authenticated user.

> Example request:

```bash
curl "http://global2.dk/mobileapi/public/oauth/clients" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://global2.dk/mobileapi/public/oauth/clients",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET oauth/clients`

`HEAD oauth/clients`


<!-- END_258e7e83c3ea28db7720e63d358b33ff -->
<!-- START_9eabf8d6e4ab449c24c503fcb42fba82 -->
## Store a new client.

> Example request:

```bash
curl "http://global2.dk/mobileapi/public/oauth/clients" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://global2.dk/mobileapi/public/oauth/clients",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST oauth/clients`


<!-- END_9eabf8d6e4ab449c24c503fcb42fba82 -->
<!-- START_784aec390a455073fc7464335c1defa1 -->
## Update the given client.

> Example request:

```bash
curl "http://global2.dk/mobileapi/public/oauth/clients/{client_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://global2.dk/mobileapi/public/oauth/clients/{client_id}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT oauth/clients/{client_id}`


<!-- END_784aec390a455073fc7464335c1defa1 -->
<!-- START_1f65a511dd86ba0541d7ba13ca57e364 -->
## Delete the given client.

> Example request:

```bash
curl "http://global2.dk/mobileapi/public/oauth/clients/{client_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://global2.dk/mobileapi/public/oauth/clients/{client_id}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE oauth/clients/{client_id}`


<!-- END_1f65a511dd86ba0541d7ba13ca57e364 -->
<!-- START_6eec11382f34d0f08c826d2813b02d04 -->
## Get all of the available scopes for the application.

> Example request:

```bash
curl "http://global2.dk/mobileapi/public/oauth/scopes" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://global2.dk/mobileapi/public/oauth/scopes",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET oauth/scopes`

`HEAD oauth/scopes`


<!-- END_6eec11382f34d0f08c826d2813b02d04 -->
<!-- START_b4c3e68afae3c4de78758b62c49ac9a9 -->
## Get all of the personal access tokens for the authenticated user.

> Example request:

```bash
curl "http://global2.dk/mobileapi/public/oauth/personal-access-tokens" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://global2.dk/mobileapi/public/oauth/personal-access-tokens",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET oauth/personal-access-tokens`

`HEAD oauth/personal-access-tokens`


<!-- END_b4c3e68afae3c4de78758b62c49ac9a9 -->
<!-- START_a8dd9c0a5583742e671711f9bb3ee406 -->
## Create a new personal access token for the user.

> Example request:

```bash
curl "http://global2.dk/mobileapi/public/oauth/personal-access-tokens" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://global2.dk/mobileapi/public/oauth/personal-access-tokens",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST oauth/personal-access-tokens`


<!-- END_a8dd9c0a5583742e671711f9bb3ee406 -->
<!-- START_bae65df80fd9d72a01439241a9ea20d0 -->
## Delete the given token.

> Example request:

```bash
curl "http://global2.dk/mobileapi/public/oauth/personal-access-tokens/{token_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://global2.dk/mobileapi/public/oauth/personal-access-tokens/{token_id}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE oauth/personal-access-tokens/{token_id}`


<!-- END_bae65df80fd9d72a01439241a9ea20d0 -->
