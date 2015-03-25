<?php namespace App\Http\Controllers;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Response;
use Request;

class ContactsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$salesforce = new App\Salesforce();
        $result = $salesforce->client->query('select Id, FirstName, LastName, Phone, BirthDate from Contact');
        return response()->json($result->getQueryResult()->getRecords());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$salesforce = new App\Salesforce();
		$contact = new \stdClass();
		foreach(Request::all() as $key => $attribute){
			$contact->$key = $attribute;
		}
		$contacts = array(0=>$contact);
        $result = $salesforce->client->create($contacts, 'Contact');
		return response()->json($contact);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$salesforce = new App\Salesforce();
		$response = $salesforce->client->delete(array(0=>$id));
	}

	public function contact($id)
	{
		$salesforce = new App\Salesforce();
        $result = $salesforce->client->query('select Id, FirstName, LastName, Phone, BirthDate from Contact where Id = \''.$id.'\'');
        return response()->json($result->getQueryResult()->getRecords());
	}

}
