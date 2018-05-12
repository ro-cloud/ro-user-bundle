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

## Create owner relationship (recommended)
With this bundle, you got the possibility to build an "owner" to "accounts" relationship. 
This means, you can assign multiple ragnarok accounts (accounts) to a single website user (owner).

Due to the fact, that rAthena currently does not support a technology like "oAuth2", i'd recommend you to use this kind of relationship for your website.
This'll most likely reduce the vulnerability, the MD5 "encryption" used by rAthena will open up on your website.

### How to implement this kind of relationship
First you need a User class, that's used to authenticate your websites users. When you're using the `Symfony framework`, the easiest way is to use the [friendsofsymfony/user-bundle](https://github.com/FriendsOfSymfony/FOSUserBundle).
After following their instructions, you have to add a new property to your `User` class.

Suppose you're using the FOS-Userbundle, Doctrine and PHP7.2 (also a recommendation, ditch PHP less dann version 7):
```php
// your-project/src/Model/User.php
namespace YourVendor\Model;

use \FOS\UserBundle\Model\User as BaseUser
use Doctrine\ORM\Mapping as ORM;

class User extends BaseUser {
    // ... your other properties
    /**
     * @var \RoCloud\UserBundle\Entity\IngameAccount
     *
     * @ORM\OneToMany(targetEntity="RoCloud\UserBundle\Entity\IngameAccount", mappedBy="owner")
     */
    protected $accounts;
    
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->accounts = new ArrayCollection();
    }
    
    /**
     * @return ArrayCollection
     */
    public function getAccounts(): ArrayCollection
    {
        return $this->accounts;
    }

    /**
     * @param ArrayCollection $accounts
     *
     * @return User
     */
    public function setAccounts(ArrayCollection $accounts): User
    {
        $this->accounts = $accounts;

        return $this;
    }

    /**
     * @param IngameAccount $account
     *
     * @return User
     */
    public function addAccount(IngameAccount $account): User
    {
        $this->accounts->add($account);

        return $this;
    }

    /**
     * @param IngameAccount $account
     *
     * @return User
     */
    public function removeAccount(IngameAccount $account): User
    {
        $this->accounts->remove($account);

        return $this;
    }
}
``` 

Now you need to tell Doctrine, that the `OwnerInterface` that's set as `owner` in the `IngameAccount` class is actually a `YourVendor\Model\User`.

```yaml
doctrine:
    orm:
        resolve_target_entities:
            RoCloud\UserBundle\Entity\OwnerInterface: YourVendor\Model\User
```

This should be enough to create a relationship between your `User` and RoClouds `IngameAccount` models.

Finally, update your `Doctrine` schema
```
// Be careful using this on your live website
./bin/console doctrine:schema:update --force
```
