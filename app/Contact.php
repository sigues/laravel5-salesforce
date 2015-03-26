<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Phpforce\SoapClient\Result as Phpforce;

class Contact extends Model {
    private $salesforce;

	public function __construct(){
        $this->salesforce = new Salesforce();
        $this->client = $this->salesforce->client;
    }

    public function getContacts(){
         //dd($this->salesforce->describe('OpenActivity'));
         //dd($this->salesforce->describe('Contact'));

// SELECT Case.Postcode_and_number__c, (SELECT SocialPersona.Id FROM SocialPersonas) FROM Case


        $response = $this->salesforce->client->query('select Id, FirstName, LastName, Phone, Birthdate, 
            (select OpenActivity.Id, OpenActivity.CreatedDate, OpenActivity.Description, OpenActivity.ActivityType,
                    OpenActivity.Priority, OpenActivity.Status, OpenActivity.ActivityDate, OpenActivity.Subject 
                from OpenActivities) 
            from Contact');
        return $response->getQueryResult()->getRecords();
    }

    public function getContact($id){
        $result = $this->salesforce->client->query('select Id, FirstName, LastName, Phone, BirthDate,
        (select OpenActivity.Id, OpenActivity.CreatedDate, OpenActivity.Description, OpenActivity.ActivityType,
                    OpenActivity.Priority, OpenActivity.Status, OpenActivity.ActivityDate, OpenActivity.Subject 
                from OpenActivities) from Contact where Id = \''.$id.'\'');
        $response = $this->salesforce->prepareResponse($result);
        return $response;
    }

}
