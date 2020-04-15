<?php

namespace App\Http\Controllers;
use App\books;
use App\user_details;
use App\subscribers;
use DB;
use Session;

use Illuminate\Http\Request;

class userController extends Controller
{
  public function showuser(){
    $userCat=Session::get('user')['category'];
    $usermailid=Session::get('user')['mailid'];
    $booklist= books::all();
    $Bookcategory= books::select('bCategory')->distinct()->get();
    $userlist= user_details::where('emailID',$usermailid)->first();
    $bookscroll=array();
    $i=0;
    foreach($Bookcategory as $category){
      $cat=$category->bCategory;
      // $query="SELECT a.*,(select count(b.id) from subscribers b where b.Bookid = a.id and b.Userid='$userlist->id') as subt FROM `books` a WHERE a.bCategory='$cat'";
      $query="CALL subscribe_books($userlist->id,'$cat')";
      $s=DB::select($query);
       $bookscroll[$i]['category']= $category->bCategory;
       $bookscroll[$i]['dataset']=$s;
    $i++;
    }
    if (isset($userCat,$usermailid)) {
     return view('pages.showuser',compact('bookscroll','booklist','userlist','Bookcategory'));
    }
    else {
      return redirect('/');
    }
  }

  public function BookSub($userid,$bookid){
    $subTable= new subscribers;
    $subTable->Bookid = $bookid;
    $subTable->Userid = $userid;
    $subTable->save();
    return back()->with('response','Subscribed Successfully');

  }
    public function BookDeleteSub($userid,$bookid){
      echo $userid;
      echo $bookid;
      $subTable= subscribers::where('Bookid',$bookid)->where('Userid',$userid)->delete();
      return back()->with('response','Rejected Successfully');

    }
}
