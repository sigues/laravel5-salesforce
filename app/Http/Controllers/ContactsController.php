<?php namespace App\Http\Controllers;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Response;
use Request;

class ContactsController extends Controller {
	private $contactModel;

	public function __construct(){
		$this->contactModel = new App\Contact();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $result = $this->contactModel->getContacts();
        return response()->json($result);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$contact = new \stdClass();
		foreach(Request::all() as $key => $attribute){
			$contact->$key = $attribute;
		}
		$contacts = array(0=>$contact);
        $result = $this->contactModel->client->create($contacts, 'Contact');
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
		$response = $this->contactModel->client->delete(array(0=>$id));
	}

	public function contact($id)
	{
        //$result = $this->contactModel
        $result = $this->contactModel->getContact($id);
        return response()->json($result->getQueryResult()->getRecords());
	}

}
