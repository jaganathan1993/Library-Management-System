<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\books;
use App\user_details;
use App\Imports\BookImport;
use App\Imports\TestImport;
use Session;
use Alert;
use Response;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class adminController extends Controller
{
  public function showpage(){
      $booklist= books::all();
      $userlist= user_details::all();
      $userCat=Session::get('user')['category'];
      $usermailid=Session::get('user')['mailid'];
      if (isset($userCat,$usermailid))
      {
        return view('pages.showadmin',compact('booklist','userlist','userCat'));
      }else{
        return redirect('/');
      }
  }

  public function Bookadd(Request $request){
    $this->validate($request, [
      'bookid'=>'required',
      'bname'=>'required',
      'author'=>'required',
      'price'=>'required',
      'publisher'=>'required',
      'totalbooks'=>'required',
      'description'=>'required',
      'category'=>'required'
     ]);
      $bookdetail= new books;
      $bookdetail->bookID=$request->post('bookid');
      $bookdetail->bname=$request->post('bname');
      $bookdetail->author=$request->post('author');
      $bookdetail->price=$request->post('price');
      $bookdetail->description=$request->post('description');
      $bookdetail->publisher=$request->post('publisher');
      $bookdetail->bcount=$request->post('totalbooks');
      $bookdetail->bCategory=$request->post('category');
      if($request->post('totalbooks') > 0){
        $bookdetail->status='Available';
      }
      else{
          $bookdetail->status='Not Available';
      }

      if($request->hasfile('bookimg')) {
        $useratt=$request->file('bookimg');
        $extention=$useratt->getClientOriginalExtension();
        $filename=time().".".$extention;
        $useratt->move('Images/Book/',$filename);
        $bookdetail->bImage=$filename;
      }
      else {

        $bookdetail->bImage='';
      }
      $bookdetail->save();
      return redirect('/Admin')->with('response','Inserted Successfully');

  }

  public function Bookupdate(Request $request){
    $this->validate($request, [
      'Updatebookid'=>'required',
      'Updatebname'=>'required',
      'Updateauthor'=>'required',
      'Updateprice'=>'required',
      'Updatepublisher'=>'required',
      'Updatecategory'=>'required',
      'Updatedescription'=>'required',
      'Updatebcount'=>'required'
     ]);
     $bookid=$request->post('Updatebookid');
      $bookdetail= books::where('bookID',$bookid)->first();
      $bookdetail->bookID=$request->post('Updatebookid');
      $bookdetail->bname=$request->post('Updatebname');
      $bookdetail->author=$request->post('Updateauthor');
      $bookdetail->price=$request->post('Updateprice');
      $bookdetail->description=$request->post('Updatedescription');
      $bookdetail->publisher=$request->post('Updatepublisher');
      $bookdetail->bcount=$request->post('Updatebcount');
      $bookdetail->bCategory=$request->post('Updatecategory');
      if($request->post('Updatebcount') > 0){
        $bookdetail->status='Available';
      }
      else{
          $bookdetail->status='Not Available';
      }

      if($request->hasfile('bookImagefileUpload')) {
        $useratt=$request->file('bookImagefileUpload');
        $extention=$useratt->getClientOriginalExtension();
        $filename=time().".".$extention;
        $useratt->move('Images/Book/',$filename);
        $bookdetail->bImage=$filename;
      }
      else {

        $bookdetail->bImage='';
      }
      $bookdetail->save();
      return redirect('/Admin')->with('response','Updated Successfully');

  }


  public function Bookremove(Request $request){
      $id=$request->get('removeid');
      $bookdetail= books::where('id',$id)->delete();
      if($bookdetail){
          return redirect('/Admin')->with('response','Deleted Successfully');
      }else{
        return redirect('/Admin')->with('response','Deleted UnSuccessfully');
      }
  }

  public function Book(Request $request){
      $idBookval=$request->get('idBook');
      $booklist= books::where('id',$idBookval)->get();
       return Response::json($booklist);
  }

  public function importBooks(Request $request){
    $request->validate([
      'file' => 'required'
    ]);
    //print(books::all());
    $path = $request->file('file');
     $getdatacheck = Excel::toArray(new TestImport,$path);

    if(sizeof($getdatacheck) > 0){
      $i=1;
      $bookdata=books::all();
      foreach($getdatacheck as $data){
        $id=$data[$i][0];
        if($bookdata->where('bookID',$id)->count() > 0){
        //  echo $data[$i][0];
          return back()->with('response','User id already exists');
        }else{
        }
        $i++;
      }
     $res = Excel::import(new BookImport,request()->file('file'));
     return redirect('/Admin')->with('response','Successfully Uploaded');
    }else{
      return redirect('/Admin')->with('response','No Record Available');
    }
  }

  public function subChart(Request $request){
    $query="CALL CategorywiseSubscribe()";
    $s=DB::select($query);
    return Response::json(array("catList"=>$s));
  }

  public function subscriberSB(Request $request){
    $idBookval=$request->get('idBook');
    $selectUser = DB::select("select b.* from subscribers a,user_details b where a.Userid = b.id and a.Bookid =$idBookval");
    return Response::json($selectUser);
  }

  public function Bookidavailable(Request $request){
    $bookid = $request->post('bookid');
    $value= books::where('bookID',$bookid)->get();
    if($value->count() > 0){
      echo "Already Exists";
    }
    else{
      echo "Not Available";
    }
  }
}
