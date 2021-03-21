<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Dim\ContactFilters;

class ContactController extends Controller
{
  public function submit(ContactRequest $req)

  {
    $contact=new Contact();
    $contact->name=$req->input('name');
    $contact->email=$req->input('e-mail');
    $contact->subject=$req->input('subject');
    $contact->message=$req->input('message');

    $contact->save();

    return redirect()->route('home')->with('success','Сообщение было добавлено');
  }

  public function update($id,ContactRequest $req)

  {
    $contact=Contact::find($id);
    $contact->name=$req->input('name');
    $contact->email=$req->input('e-mail');
    $contact->subject=$req->input('subject');
    $contact->message=$req->input('message');

    $contact->save();

    return redirect()->route('one-message',$id)->with('success',"Сообщение номер {$id} было обновлено");
  }


public function filters(Request $req)
{
  $contact=Contact::orderBy('id');

  $contact=(new ContactFilters($contact,$req))->apply()->get();

  // // if ($req->has('email')){
  // //   $contact->where('email','like',"%$req->email%");
  // // }
  //
  // if ($req->has('is_archive')){
  //   $contact->where('is_archive',$req->is_archive);
  // }
  //
  // $contact=$contact->get();
  //dd($contact);
  return view('messages',['data'=>$contact])  ;
  }


public function allmessages()
  {
    $contact=Contact::all(); //  а было в дые строчки - $contact= new Contact; и  $contact=$contact->all();
    return view('messages',['data' => $contact]);
  }

  public function one_message($id)
  {
    $contact=new Contact;
    return view('one_message',['data' => $contact->find($id)]);
  }
  public function one_message_edit($id)
  {
    $contact=new Contact;
    return view('one_message_edit',['data' => $contact->find($id)]);
  }
  public function one_message_delete($id)
  {
  Contact::find($id)->delete();
    return redirect()->route('all_messages')->with('success',"Сообщение номер {$id} было удалено");
  }


}
