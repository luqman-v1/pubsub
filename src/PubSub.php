<?php namespace LuqmanV1\PubSub;

use Exception;
use Google\Cloud\PubSub\PubSubClient;

class PubSub
{
    protected $configs = [];

    public function __construct()
    {
        $this->setConfig($this->checkCredential(env('GCP_CREDENTIALS')));
    }

    /**
     * this function for set config pubsub
     * @param array $decode_credential
     */
    public function setConfig($decode_credential = [])
    {
        $this->configs = [
            'projectId' => $decode_credential['project_id'],
            'keyFile'   => $decode_credential,
        ];
    }

    /**
     * this function for get config pubsub
     * @return array
     */
    public function getConfig()
    {
        return $this->configs;
    }

    /**
     * this function for initial pubsub client google cloud
     * @return PubSubClient
     */
    public function init()
    {
        return new PubSubClient($this->getConfig());
    }

    /**
     * this function for custome method, example create topic and subcriber etc
     * @return new PubSubClient
     */
    public static function pubsub()
    {
        $class_pubsub = new self;
        return $class_pubsub->init();
    }

    /**
     * this function for handling credential GCP valid
     * @param  string $gcp_credential_base64
     * @return array
     */
    public function checkCredential($gcp_credential_base64)
    {
        //check credential is not empty
        if (empty($gcp_credential_base64)) {
            throw new Exception("GCP_CREDENTIALS is empty");
        }
        //check format base64 valid
        if (!base64_decode($gcp_credential_base64)) {
            throw new Exception("Invalid format base64");
        }
        $decode_credential = json_decode(base64_decode($gcp_credential_base64), true);
        //check project id exist
        if (!isset($decode_credential['project_id'])) {
            throw new Exception("Project ID not found in credential gcp base64");
        }

        return $decode_credential;
    }

    /**
     * this function for publish message
     * @param  string $topic_name
     * @param  array  $messages
     * @return void
     */
    public static function publish($topic_name = "", $messages = [])
    {
        try {
            $topic = self::pubsub()->topic($topic_name);
            $topic->publish($messages);
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * this funciton for pull message base on subscription_name
     * @param  string $subscription_name
     * @return array
     */
    public static function pull($subscription_name = "")
    {
        $subscription = self::pubsub()->subscription($subscription_name);
        return $subscription->pull();
    }
}
