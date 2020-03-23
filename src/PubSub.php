<?php namespace LuqmanV1\PubSub;

use Google\Cloud\PubSub\PubSubClient;

// sample PubSub::publish(Config::get('pubsub.dataversion.topic'), ['data' => json_encode($messages)]);

class PubSub
{
    protected $configs = [];

    public function __construct()
    {
        $credential    = json_decode(base64_decode(env('GCP_CREDENTIALS')), true);
        $this->configs = [
            'projectId' => $credential['project_id'],
            'keyFile'   => $credential,
        ];
    }

    public function init()
    {
        return new PubSubClient($this->configs);
    }

    public static function publish($topic_name = "", $messages = [])
    {
        $class_pubsub = new self;
        try {
            $topic = $class_pubsub->init()->topic($topic_name);
            $topic->publish($messages);
        } catch (\Execption $e) {
            dd($e);
        }
    }

    public static function pull($subscription_name = "")
    {
        $class_pubsub = new self;
        $subscription = $class_pubsub->init()->subscription($subscription_name);
        return $subscription->pull();
    }
}
