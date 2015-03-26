<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesforce extends Model {
    public $client;

    public function __construct(){
        parent::__construct();
        ini_set("soap.wsdl_cache_enabled", "0");

        define("USERNAME", "svillegas2007@gmail.com");
        define("PASSWORD", "G3nerico01");
        define("SECURITY_TOKEN", "iasn4NGvfjPXesWZU9avYsu6");
        $wsdlPath = base_path()."/vendor/phpforce/soap-client/tests/Phpforce/SoapClient/Tests/Fixtures/sandbox.enterprise.wsdl.xml";

        $log = new \Monolog\Logger('name');  
        $log->pushHandler(new \Monolog\Handler\StreamHandler(base_path().'/storage/logs/wsdl.log'));


        $builder = new \Phpforce\SoapClient\ClientBuilder(
          $wsdlPath,
          "svillegas2007@gmail.com",
          "G3nerico01",
          "iasn4NGvfjPXesWZU9avYsu6"
        );
        $this->setClient($builder->withLog($log)->build());
        return $this;
    }

    private function setClient($client){
        $this->client = $client;
    }

    public function getUserInfo(){
        return $this->client->getUserInfo();
    }

    public function describe($object){
        
        return $this->client->describeSObjects(array($object))[0];
    }

}
