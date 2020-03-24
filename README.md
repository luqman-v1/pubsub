# Laravel PubSub

Simple package Laravel 5.2 for using Google Cloud PubSub


[![Author](http://img.shields.io/badge/author-@luqmenul-blue.svg?style=flat-square)](https://twitter.com/luqmenul)
[![Total Downloads](https://poser.pugx.org/luqman-v1/pubsub/downloads)](https://packagist.org/packages/luqman-v1/pubsub)
[![License](https://poser.pugx.org/luqman-v1/pubsub/license)](https://packagist.org/packages/luqman-v1/pubsub)


# Installation


```
composer require luqman-v1/pubsub
```

Register the service provider in app.php

```
'providers' => [
    // ...
    LuqmanV1\PubSub\PubSubServiceProvider::class,
]
```
Register the facade in app.php
```
'aliases' => [
    // ...
    'PubSub' => LuqmanV1\PubSub\Facade::class,
]
```
First convert the credential.json file to base64 https://www.base64decode.org/

The package has a default configuration which uses the following environment variables.
```
GCP_CREDENTIALS=SomeAwesomeBase64
```

# Usage

```
    //for publish message
    $message = [
            'data'       => 'My new message.',
            'attributes' => [
                'location' => 'Detroit',
            ],
        ];
    PubSub::publish("someTopicName", $message);
    
    //for pull message 
     $messages = PubSub::pull("someSubcriberName");
     foreach($messages as $message){
        echo $message->data() . "\n";
        echo $message->attribute('location');
     }
     
     //for another function like create topic or etc 
     call function :  PubSub::pubsub()->methodYouWantUse();
     example :
     PubSub::pubsub()->createTopic('someNewTopicName');
```

License
----

MIT

