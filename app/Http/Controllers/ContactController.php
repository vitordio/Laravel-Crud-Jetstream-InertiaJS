<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Contacts/Index', ['contacts' => Contact::orderBy('id', 'desc')->paginate()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  app\Http\Requests\ContactRequest.php  $ContactRequest
     * @return \Illuminate\Http\Response
     */
    public function store(ContactStoreRequest $request)
    {
        Contact::create($request->all());
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        $contact->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back();
    }
}
