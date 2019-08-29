# Symfony Security component in examples

Code for the workshop "Symfony security component in examples" at WebSummerCamp 2019

## Requirements

PHP 7.1+, MySQL 5.7  
Symfony local server

## Installation

```
composer install
bin/console doctrine:migrations:migrate
bin/console doctrine:fixtures:load
```

## Testing

```
cp .env.local .env.test.local
bin/phpunit
```

## Code snippets

Guard `AuthenticatorInterface`:
[https://gist.github.com/romaricdrigon/5c6f438afb2715357464d06241addf03](https://gist.github.com/romaricdrigon/5c6f438afb2715357464d06241addf03)

Doctrine filter:
[https://gist.github.com/romaricdrigon/88cc8c9f5cb20e84c0ebc8c472bd5b7e](https://gist.github.com/romaricdrigon/88cc8c9f5cb20e84c0ebc8c472bd5b7e)

## Code kata resources

[UserChecker documentation](https://symfony.com/doc/current/security/user_checkers.html)

[Event dispatching documentation](https://symfony.com/doc/current/components/event_dispatcher.html#creating-and-dispatching-an-event)

[Validator usage](https://symfony.com/doc/current/components/validator.html#usage)

[NotCompromisedValidator constraint documentation](https://symfony.com/doc/current/reference/constraints/NotCompromisedPassword.html)
[The validator code](https://github.com/symfony/symfony/blob/4.4/src/Symfony/Component/Validator/Constraints/NotCompromisedPasswordValidator.php)

