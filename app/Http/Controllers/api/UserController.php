<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
// use Intervention\Image\Image;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>'required|string|max:191',
            'email' =>'required|string|email|max:191|unique:users',
            'password' =>'required|string|min:6',
            
        ]);
         $user=User::create([

            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'bio' => $request['bio'],
            'photo' => $request['photo'],
            'password' => Hash::make($request['password']),
        ]);
         return ['message'=>$user->name. ' created successfully'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::findOrFail($id);
        $this->validate($request,[
            'name' =>'required|string|max:191',
            'email' =>'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' =>'required|string|min:6',
            
        ]);
        $request['password']=Hash::make($request['password']);
       
       $user->update($request->all());

       return ['message',$user->name.' update Successfully'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $user->delete();

        return ['message'=>$user->name.' is Successfully Deleted'];
    }

    public function profile(){
        return auth('api')->user();
    }

    public function updateProfile(Request $request){
         $user=auth('api')->user();
         $this->validate($request,[
            'name' =>'required|string|max:191',
            'email' =>'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' =>'sometimes|required|string|min:6',
            
        ]);
        
        $currentPhoto=$user->photo;
        if($request->photo!=$currentPhoto){
            $name=time().'.'.explode('/',explode(':',substr($request->photo,0,strpos($request->photo,';')))[1])[1];
            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request['photo']=$name;


        }
        if($request['password']){
            $request['password']=Hash::make($request['password']);
        }

        $userPhoto=public_path('img/profile/').$currentPhoto;
        if(file_exists($userPhoto)){
            @unlink($userPhoto);
        }
        
        
        
        
        $user->update($request->all());


         return ['message'=>'Profile update successfully'];


    }
}
