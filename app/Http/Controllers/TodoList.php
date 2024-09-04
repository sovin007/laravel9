<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoList extends Controller
{
    
   public function __construct()
   {

   }

   public function home()
   {
       $data['allrecords'] = Todo::all();
       return view('home',$data);
   }


   public function submit(Request $request)
   {
       $name = $request->name;
       $records = Todo::where('name',$name)->get(); 
       if($records->count())
       {
        return response()->json(['status'=>0]);  
       }
       else
       {
        $record = new Todo();    
		$record->name = $name;
        $record->status = 'non completed';
		$record->save();
        $data['allrecords'] = Todo::all();
        return view('list_table',$data)->render();
        
       }
      
   }

   public function delete(Request $request)
   {
      
      $response = Todo::destroy($request->id);
      if($response)
      {
        $data['allrecords'] = Todo::all();
        return view('list_table',$data)->render();
      }
   }


   public function checkbox(Request $request)
   {
      
      $response = Todo::where('id',$request->id)->update(['status'=>'completed']);
      if($response)
      {
        $data['allrecords'] = Todo::all();
        return view('list_table',$data)->render();
      }
   }

}
