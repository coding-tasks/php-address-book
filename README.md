## PHP Address Book [![Travis](https://img.shields.io/travis/ankitpokhrel/php-address-book.svg?style=flat-square)](https://travis-ci.org/ankitpokhrel/php-address-book)
_A very simple address book implementation_

### Requirements
- PHP 7 or later

### Installation
Since the project is not in packagist.org, you need to require it locally.
You can do so by using `repositories` field in your composer file.
 
 ```json
 "repositories": [
   {
     "type": "path",
     "url": "/full/or/relative/path/to/the/package"
   }
 ],
 "require": {
   "ankitpokhrel/php-address-book": "@dev"
 }
 ```
 
 Or, just load the autoloader.
 ```php
 include_once '/path/to/php-address-book/vendor/autoload.php';
 ```

### Usage
#### Add a person to the address book.
```php
$addressBook = new App\AddressBook('My Address Book');

$person  = new App\Person('firstname', 'lastname');
$person1 = new App\Person('one');
$person2 = new App\Person('two');
$person3 = new App\Person('three');

// add single contact
$addressBook->addContact($person);

// add multiple contacts
$addressBook->addContact($person1, $person2, $person3);
```

#### Add a group to the address book.
```php
$addressBook = new App\AddressBook('My Address Book');

$group  = new App\Group('public');
$group1 = new App\Group('private');
$group2 = new App\Group('only me');

// add single group
$addressBook->addGroup($group);

// add multiple groups
$addressBook->addGroup($group1, $group2);
```

#### Given a group we want to easily find its members.
```php
// get all members of a group
$group->members();

// find member by name
$group->findByName(
    'name' // firstname, lastname or full name
);
```

#### Given a person we want to easily find the groups the person belongs to.
```php
$person = new App\Person('Ankit', 'Pokhrel');

$group1 = new App\Group('public');
$group2 = new App\Group('private');

// add person to group1 and group2
$group1->add($person);
$group2->add($person);

// get groups for this person 
$person->groups();
```

#### Find person by name (can supply either first name, last name, or both).
```php
$addressBook = new App\AddressBook('My Address Book');
$person      = new App\Person('firstname', 'lastname');

$addressBook->addContact($person);

$addressBook->findByName(
    'name' // firstname, lastname or full name
)
```

#### Find person by email address (can supply either the exact string or a prefix string, ie. both "alexander@company.com" and "alex" should work).
```php
$person = new App\Person('firstname', 'lastname');
$email1 = new App\Email('alexander@company.com');
$email2 = new App\Email('info@ankitpokhrel.com');

$person->addEmail($email1)->addEmail($email2);

$addressBook = new App\AddressBook('My Address Book');
$addressBook->addContact($person);

$addressBook->findByEmail(
    'email' // full email or a prefix string
)
```

### Design Question
#### Find person by email address (can supply any substring, ie. "comp" should work assuming "alexander@company.com" is an email address in the address book)
1. Validate search keyword and if its empty or its length is less than 3 we can return immediately with empty results.
2. For all contacts in address book:
    - If search keyword is a valid email then check to see if hash of email is present in contacts email and store the result.
    - If not, loop through the contact emails and use regex or string function to see if search keyword is present in email and store the result.
3. Return results.

### Development
Install dev dependencies
```shell
$ composer install --dev
```

Run the tests
```
$ ./vendor/bin/phpunit
```
