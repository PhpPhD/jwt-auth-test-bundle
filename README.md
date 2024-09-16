PhdApiTestingBundle
--------------------

🧰 Provides lightweight jwt authorization utilities for Api Testing in Symfony applications. In essence, this package
integrates [Lexik JWT Authentication Bundle](https://github.com/lexik/LexikJWTAuthenticationBundle) into your Api Test
Cases.

[![Build Status](https://img.shields.io/github/actions/workflow/status/phphd/api-testing/ci.yaml?branch=main)](https://github.com/phphd/api-testing/actions?query=branch%3Amain)
[![Codecov](https://codecov.io/gh/phphd/api-testing/graph/badge.svg?token=GZRXWYT55Z)](https://codecov.io/gh/phphd/api-testing)
[![Psalm coverage](https://shepherd.dev/github/phphd/api-testing/coverage.svg)](https://shepherd.dev/github/phphd/api-testing)
[![Psalm level](https://shepherd.dev/github/phphd/api-testing/level.svg)](https://shepherd.dev/github/phphd/api-testing)
[![Total Downloads](https://img.shields.io/packagist/dt/phphd/api-testing.svg?style=flat-square)](https://packagist.org/packages/phphd/api-testing)
[![Licence](https://img.shields.io/github/license/phphd/api-testing.svg)](https://github.com/phphd/api-testing/blob/main/LICENSE)

## Quick Start

### Installation 📥

1. Install via composer

    ```sh
    composer require --dev phphd/api-testing
    ```

2. Enable the bundle in the `bundles.php`

    ```php
    PhPhD\ApiTestingBundle\PhdApiTestingBundle::class => ['test' => true],
    ```

### Configuration ⚒️

Create `phd_api_testing.yaml` configuration file under `config/packages/test` directory. It's necessary to specify
service id of application [user provider](https://symfony.com/doc/current/security/user_providers.html) here. If you
have only one authenticated user entity (hence, one provider), use current default configuration.

```yaml
phd_api_testing:
    jwt_authenticators:
        -   name: default
            user_provider: security.user_providers
```

### Usage 🚀

In your Api Test class use `JwtLoginTrait` and `login` method to handle authentication:

```php
use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Symfony\Bundle\Test\Client;
use PhPhD\ApiTesting\JwtLoginTrait;

final class ExampleProtectedApiTest extends ApiTestCase
{
    use JwtLoginTrait;
    
    // ...

    public function testAccessFeatureWithoutPassword(): void
    {
        $token = $this->login('username');

        $this->client->request('GET', '/api/protected-route', [
            'auth_bearer' => $token,
        ]);

        self::assertResponseStatusCodeSame(200);
    }
}
```

In this example, `login` is used to generate jwt token for `username` user so that api request will be sent on his
behalf.

## Advanced Configuration ⚙️

### Multiple Authenticators

It is possible to use multiple authenticators for your specific needs. For instance if you have admin panel alongside
your main authenticated application, you may want to use the dedicated authenticator.

In essence, if you're utilizing `security.user_providers`, additional configuration is typically unnecessary,
since `security.user_providers` acts as a chain user provider, meaning that first found user from any subordinate
providers will be used.

Nonetheless, in case of conflicting usernames or any other specific reason, you may register an additional authenticator
in the same configuration file by different name:

```yaml
phd_api_testing:
    jwt_authenticators:
        -   name: admin
            user_provider: security.user.provider.concrete.api_admin_user_provider
```

In this config, `api_admin_user_provider` is the name of user provider from `security.yaml` and `admin` - just an alias
for our usage in tests.

Having registered authenticator, we may use its alias as a second parameter of `login` method:

```php
public function testDedicatedAdminAuthenticator(): void
{
    $token = $this->login('admin@test.com', authenticator: 'admin');

    $this->client->request('GET', '/api/admin/protected-route', [
        'auth_bearer' => $token,
    ]);

    self::assertResponseStatusCodeSame(200);
}
```
