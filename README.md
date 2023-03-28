# JustSteveKing SDK Tools

<!-- BADGES_START -->
[![Latest Version][badge-release]][packagist]
[![Software License][badge-license]][license]
[![Run Tests](https://github.com/JustSteveKing/sdk-tools/actions/workflows/tests.yml/badge.svg)](https://github.com/JustSteveKing/sdk-tools/actions/workflows/tests.yml)
[![PHP Version][badge-php]][php]
[![Total Downloads][badge-downloads]][downloads]

[badge-release]: https://img.shields.io/packagist/v/juststeveking/sdk-tools.svg?style=flat-square&label=release
[badge-license]: https://img.shields.io/packagist/l/juststeveking/sdk-tools.svg?style=flat-square
[badge-php]: https://img.shields.io/packagist/php-v/juststeveking/sdk-tools.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/juststeveking/sdk-tools.svg?style=flat-square&colorB=mediumvioletred

[packagist]: https://packagist.org/packages/juststeveking/sdk-tools
[license]: https://github.com/juststeveking/sdk-tools/blob/main/LICENSE.md
[php]: https://php.net
[downloads]: https://packagist.org/packages/juststeveking/sdk-tools
<!-- BADGES_END -->

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

#### Response class

Using the response class, you can turn a PSR response into a response class that has a slightly friendlier API to work with.

```php
use JustSteveKing\Tools\Http\Response;

$response = Response::fromPsrResponse(
    response: $response, // Add a PSR response here.
);

$response->status(); // Get the status code.
$response->headers(); // Get the headers from the response.
$response->json(); // Get the payload from the response as an array.
$response->protocol(); // Get the HTTP protocol from the response.
$response->reason(); // Get the Http reason phrase from the response.
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

#### Http Transport class

Using the HTTP Transport class, you can discover the installed PSR-18 client and return the PSR-18 implementation.

```php
use JustSteveKing\Tools\SDK\Transport\HttpTransport;

$client = HttpTransport::client(); // HttpClient PSR-18 implementation.
```

#### SDK class

The SDK class is designed for you to extend for your own SDKs, it accepts one property in its constructor which will be a PSR-18 compliant HTTP client.

```php
use JustSteveKing\Tools\SDK\SDK;
use JustSteveKing\Tools\SDK\Transport\HttpTransport;

$sdk = new SDK(
    client: HttpTransport::client(),
);

// Fetch the attached client:
$sdk->client();

// Replace the attached client
$sdk->setClient(
    client: new \Http\Mock\Client(),
);
```

#### Building your own SDK

To build your own SDK using these tools, you can easily scaffold it out using the components provided.
If you cannot quite scaffold it out, then please feel free to drop an Issue or PR so that I can build out better support for more use cases.

```php
use JustSteveKing\Tools\Http\Headers\Authorization;
use JustSteveKing\Tools\SDK\SDK;
use JustSteveKing\Tools\SDK\Transport\HttpTransport;

class Acme extends SDK
{
    public function __construct(
        protected HttpClient $client,
        private readonly Authorization $auth,    
    ) {}
    
    public static function build(string $apiToken): Acme
    {
        return new Acme(
            client: HttpTransport::client(),
            auth: (new Authorization(
                value: $apiToken,
            )),
        );
    }
}
```

From here, you can start to add your SDK logic within the `Acme` class.

```php
$acme = Acme::build(
    apiToken: 'YOUR-API-TOKEN',
);

// Then you can start to do things like:
$acme->projects()->list();
```

#### Resource class

You can use the Resource class to define the resources on your API, on your SDK.

```php
use JustSteveKing\Tools\Http\Enums\Method;
use JustSteveKing\Tools\Http\Request;
use JustSteveKing\Tools\SDK\Resource;
use JustSteveKing\Tools\SDK\SDK;
use JustSteveKing\Tools\SDK\Transport\HttpTransport;

$resource = new Resource(
    sdk: new SDK(
        client: HttpTransport::client(),
    ),
);

// Access the underlying SDK
$resource->sdk();

// Access the client from the resource
$resource->sdk()->client();

// Example of sending a request
$resource->sdk()->client()->sendRequest(
    request: new Request(
        method: Method::GET,
        uri: 'https://api.domain.com/resource',
    ),
);
```

Of course the above code is just an example of what you can do, you can abstract around this as much as you like.

#### Extending your SDK

You can use the Resource class to create your own resources, and start building implementations for your API:

```php
use JustSteveKing\Tools\SDK\Resource;
use Psr\Http\Message\ResponseInterface;

class Project extends Resource
{
    public function list(): ResponseInterface
    {
        try {
            $response = $this->sdk()->client()->sendRequest(
                request: new Request(
                    method: Method::GET,
                    uri: 'https://api.domain.com/resource',
                ),
            )
        } catch (Throwable $exception) {
            throw new AcmeRequestException(
                message: 'Failed to fetch projects from API',
                previous: $exception,
            );
        }
        
        return $response;
    }
}
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

