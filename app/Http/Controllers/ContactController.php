<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index () {
        $data = Contact::all();
        return view('admin.mastercontact', compact('data'));
    }
    public function create(){
        
    }
    public function store(Request $request){
        Contact::create($request->all());

    }
    public function edit($id){
        $data = Contact::find($id);
        return $data;
    }
    public function update(Request $request, $id){
        Contact::find($id)->update($request->all());
    }
    public function delete($id){
        Contact::find($id)->delete();

    }
}
