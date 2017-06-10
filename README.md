## Address Book [![Travis](https://img.shields.io/travis/ankitpokhrel/address-book.svg?style=flat-square)](https://travis-ci.org/ankitpokhrel/address-book)
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
   "ankitpokhrel/address-book": "*"
 }
 ```
 
 Or, just load the autoloader.
 ```php
 include_once 'address-book/vendor/autoload.php';
 ```

### Usage
#### Add a person to the address book.
```php
$addressBook = new AddressBook('My Address Book');

$person  = new Person('firstname', 'lastname');
$person1 = new Person('one');
$person2 = new Person('two');
$person3 = new Person('three');

// add single contact
$addressBook->addContact($person);

// add multiple contacts
$addressBook->addContact($person1, $person2, $person3);
```

#### Add a group to the address book.
```php
$addressBook = new AddressBook('My Address Book');

$group  = new Group('public');
$group1 = new Group('private');
$group2 = new Group('only me');

// add single group
$addressBook->addGroup($group);

// add multiple groups
$addressBook->add($group1, $group2);
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
$person = new Person('Ankit', 'Pokhrel');

$group1 = new Group('public');
$group2 = new Group('private');

// add person to group1 and group2
$group1->add($person);
$group2->add($person);

// get groups for this person 
$person->groups();
```

#### Find person by name (can supply either first name, last name, or both).
```php
$addressBook->findByName(
    'name' // firstname, lastname or full name
)
```

#### Find person by email address (can supply either the exact string or a prefix string, ie. both "alexander@company.com" and "alex" should work).
```php
$addressBook->findByEmail(
    'email' // full email or a prefix string
)
```

### Design Question
#### Find person by email address (can supply any substring, ie. "comp" should work assuming "alexander@company.com" is an email address in the address book)
1. Validate search keyword and if its empty or its length is less than 3 we can return immediately with empty results.
2. Loop through all contacts in address book
    a. If search keyword is a valid email then check to see if hash of email is present in contacts email and store the result.
    b. If not, loop through the contact emails and use regex or string function to see if search keyword is present in email and store the result.
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
