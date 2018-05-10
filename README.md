# ROUserBundle
A Symfony bundle for managing ragnarok online accounts

## Installation
Before you're able to require this bundle via composer, you need to add some lines at the root level of your composer.json
```
// your-project/composer.json
{
    // ...
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/ro-cloud/ro-user-bundle"
        }
    ],
    // ...
}
```

To install this bundle to your symfony application, just require it via composer

```
composer require ro-cloud/ro-user-bundle
```
