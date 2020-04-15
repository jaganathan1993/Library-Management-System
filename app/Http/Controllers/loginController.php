<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\login;
use App\user_details;
use Hash;
use Session;
use Cache;
use Response;
use Artisan;
class loginController extends Controller
{

    public function showlogin(){
      Artisan::call('cache:clear');
    	return view('pages.login');
    }

    public function checklogin(Request $request){
      $this->validate($request, [
           'category'=>'required',
           'userid'=>'required|email',
           'pw'=>'required|alphaNum'
       ]);

        $category=$request->post('category');
        $userid=$request->post('userid');
        $pw=$request->post('pw');


         $udetails= new login;
         $value= login::where([['category',$category],['userid',$userid]])->get();

         if (Hash::check($pw, $value[0]->pw))
         {

          Session::put('user', ['category' => $category, 'mailid' => $userid]);
          if($category == 'Admin'){

              return redirect('Admin');
          }
          if($category == 'User'){
             return redirect('User');
          }


        }
        else{
          return redirect('/')->with('response','Wrong Credentials');
        }
    }

    public function userEmailCheck(Request $request){
      $emailID = $request->post('emailID');
      $value= user_details::where('emailID',$emailID)->get();
      if($value->count() > 0){
        echo "Already Exists";
      }
      else{
        echo "Not Available";
      }
    }

    public function userRegStore(Request $request){
      $this->validate($request, [
           'username'=>'required',
           'gender'=>'required',
           'dob'=>'required|date',
           'phone'=>'required|max:11',
           'emailvalue'=>'required|email',
           'address'=>'required',
           'proffid'=>'required',
           'userpassword'=>'required',
       ]);

        $userDetail = new user_details;
        $userDetail->name=$request->post('username');
        $userDetail->gender=$request->post('gender');
        $userDetail->dob=$request->post('dob');
        $userDetail->phone=$request->post('phone');
        $userDetail->emailID=$request->post('emailvalue');
        $userDetail->Address=$request->post('address');
        $userDetail->ID_Proff=$request->post('proffid');
        if($request->hasfile('userimg')) {
          $userimage=$request->file('userimg');
          $extention=$userimage->getClientOriginalExtension();
          $filename=time()."UI.".$extention;
          $userimage->move('Images/User/',$filename);
          $userDetail->User_image=$filename;
        }
        else {

          $userDetail->User_image='';
        }
        if($request->hasfile('attachment')) {
          $useratt=$request->file('attachment');
          $extention=$useratt->getClientOriginalExtension();
          $filename=time()."Attachment.".$extention;
          $useratt->move('Images/User/',$filename);
          $userDetail->ID_Proff_Attachment=$filename;
        }
        else {

          $userDetail->ID_Proff_Attachment='';
        }
        $insertUserData = $userDetail->save();
        if($insertUserData){
            $logindetails= new login;
              $logindetails->category = 'User';
            $logindetails->userid = $request->post('emailvalue');
            $logindetails->pw = Hash::make($request->post('userpassword'));
            $logindetails->save();
        }
        return redirect('userRegistration')->with('response','Inserted successfully');
    }


    public function logout(){
      Session::forget('user');
      Cache::clear();
      return redirect('/') ;
    }

}
