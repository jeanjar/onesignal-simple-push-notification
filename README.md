# Simple PHP Implementation for send Push Notification with OneSignal Service

# Examples

### Initial Setup
```php
<?php
use JeanJar\OneSignal\PushNotification;

$api_id = 'API_ID';
$rest_api_key = 'REST_API_KEY';

$pushNotification = new PushNotification($api_id, $rest_api_key);
```
### Create notification
#### Send to all subscribers
```php
<?php
$pushNotification->setBody('English Message')
                 ->setSegments('All')
                 ->prepare()
                 ->send();
```
#### Send to a specific segment
```php
<?php
$pushNotification->setBody('English Message')
                 ->setSegments('Active Users')
                 ->prepare()
                 ->send();
```
#### Send based on filters/tags
```php
<?php
$pushNotification->setBody('English Message')
                 ->setFilter([
                     ['field' => 'tag', 'key' => 'level', 'relation' => '>', 'value' => '10'],
                     ['operator' => 'OR'],
                     ['field' => 'amount_spent', 'relation' => '>', 'value' => '0']
                 ])
                 ->prepare()
                 ->send();
```
#### Send based on OneSignal PlayerIds
```php
<?php
$pushNotification->setBody('English Message')
                 ->setPlayersId([
                    'PLAYER_ID',
                    'ANOTHER_PLAYER_ID' 
                 ])
                 ->prepare()
                 ->send();
```

## Reference guideline
[OneSignal API Reference](https://documentation.onesignal.com/reference)

## TODO list
 - [ ] Apply S.O.L.I.D concepts
 - [ ] Tests
 - [ ] Error Validations
 - [ ] OneSignal - Cancel Notification
 - [ ] OneSignal - View apps
 - [ ] OneSignal - View an app
 - [ ] OneSignal - Create an app
 - [ ] OneSignal - Update an app
 - [ ] OneSignal - View devices
 - [ ] OneSignal - View device
 - [ ] OneSignal - Add a device
 - [ ] OneSignal - Edit device
 - [ ] OneSignal - New session
 - [ ] OneSignal - New purchase
 - [ ] OneSignal - Increment session length
 - [ ] OneSignal - CSV export
 - [ ] OneSignal - View notification
 - [ ] OneSignal - View notifications
 - [ ] OneSignal - Track Open



## Enjoy!

[Wanna by me a coffee? :coffee:](https://www.patreon.com/join/jeanjar)
