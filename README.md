# JustSteveKing SDK Tools

A set of tools you can use to help make better SDKs.

## Installation

```bash
composer require juststeveking/sdk-tools
```

## Usage

There are many different components in this library, I will document these as best I can.

### HTTP Components

#### Request class

Using the request class, you can pass in the method and URI to build a request object, and turn it into a PSR-7 Request.

```php
use JustSteveKing\Tools\Http\Enums\Method;
use JustSteveKing\Tools\Http\Request;

$request = (new Request(
    method: Method::GET,
    uri: 'https://api.domain.com/resources',
))->toPsrRequest(); // Returns whichever PSR-7 implementation you have installed.
```

#### Payload class

Using the payload class, you can take a JSON string and build a HTTP Stream.

```php
use  JustSteveKing\Tools\Http\Payload;

$json = json_encode(
    value: ['foo' => 'bar'],
);

$payload = (new Payload(
    content: $json,
))->toStream(); // Returns whichever PSR-7 implementation you have installed.
```

#### Query Parameter class

Using the Query Parameter class, you can programmatically build up your request parameters.
You can pass either a `string`, `int`, or `bool` through to the value property.

```php
use JustSteveKing\Tools\Http\Uri\QueryParameter;

$queryParameter = (new QueryParameter(
    key: 'test',
    value: true,
))->toString(); // Returns `test=1`
```

#### Authorization class

Using the Authorization class, you can build the Authorization header you want or need to use.
The second parameter, type, defaults to a `Bearer` token, however you can override this.

```php
use JustSteveKing\Tools\Http\Headers\Authorization;

$header = (new Authorization(
    value: 'YOUR-API-TOKEN',
))->toHeader(); // ['Authorization' => 'Bearer YOUR_API_TOKEN'],
```

#### Token Header class

Using the Token Header class, you can build a custom token header you can use to attach to your request.
The second parameter `key` defaults to `X-API-TOKEN` which you can override.

```php
use JustSteveKing\Tools\Http\Headers\TokenHeader;

$header = (new TokenHeader(
    value: 'YOUR-API-KEY',
))->toHeader(); // ['X-API-TOKEN' => 'YOUR-API-TOKEN'],
```

#### Http Transporter class

Using the HTTP Transporter class, you can discover the installed PSR-18 client and return the PSR-18 implementation.

```php
use JustSteveKing\Tools\SDK\Transport\HttpTransport;

$client = HttpTransport::client(); // HttpClient PSR-18 implementation.
```

## Testing

To run the test:

```bash
composer run test
```

## Credits

- [Steve McDougall](https://github.com/JustSteveKing)
- [All Contributors](../../contributors)

## LICENSE

The MIT License (MIT). Please see [License File](./LICENSE) for more information.

