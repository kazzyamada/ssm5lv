<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Validator;

define ("C", ':');
define ("LP", "(");
define ("RP", ")");

class UserController extends Controller
{
    // constructor
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Get a validator for an incoming registration request.
     * 
     * @param  array    $data
     * @param  integer  $uid
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $uid)
    {   
        return Validator::make($data, [
            'name' => 'required|max:255|unique:users,name,'.$uid.',id',
            # 自分以外でuniq
#            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$uid.',id',
#            'email' => 'required|email|max:255',
            'password' => 'min:6|confirmed',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
#        \Log::debug(LP.__LINE__.RP.C.__METHOD__);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        if ($validator->fails()){
            $this->throwValidationException($request, $validator);
        }

        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = bcrypt($request->input['password']);

        $user->save();

        return redirect()->route('users.index')->with('message', 'Item created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
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
#        \Log::debug(LP.__LINE__.RP.C.__METHOD__);
        $validator = $this->validator($request->all(), $id);
        if ($validator->fails()){
            $this->throwValidationException($request, $validator);
        }

        $user = User::findOrFail($id);

        $user->name = $request->input("name");
        $user->email = $request->input("email");

        if (!empty($request->input("password"))){
#            \Log::debug('password changed('.$request->input['password'].')');
            $user->password = bcrypt($request->input['password']);
        }

        $user->save();

        return redirect()->route('users.index')->with('message', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('message', 'Item deleted successfully.');
    }
}
