<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Resources\Contact as ContactResource;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\User;
use App\Contact;
use GuzzleHttp\Client;


class ContactController extends Controller
{

    public function __construct(){

      return $this->middleware('auth:api');

    }

    public function index()
    {
        $contacts = request()->user()->contacts;
        return ContactResource::collection($contacts);
    }


    public function store(Request $request)
    {
        $contact = $request->user()->contacts()->create($request->all());
        return new ContactResource($contact);
    }


    public function show($id)
    {
      $contacts = Contact::findOrFail($id);
      return new ContactResource($contacts);
    }


    public function update(Request $request, $id)
    {
       $contact = Contact::findOrFail($id);
       if($request->user()->id !== $contact->user_id){
         return response()->json(['data'=>'Your Not Making This is Contact']);
       }
      $contact->update($request->all());
      return new ContactResource($contact);
    }

    public function destroy($id)
    {

      $contact = Contact::findOrFail($id);
      if(request()->user()->id !== $contact->user_id){
        return response()->json(['data'=>'Your Not Making This is Contact']);
      }
      $contact->delete();
      return response()->json(['data'=>'Null']);
    }
}
