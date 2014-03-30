<?php



class UserController extends BaseController {

   


    /**
     * Displays the login form
     *
     */
    public function login()
    {
        $user = Auth::user();

        if(!empty($user->id)){
            return Redirect::to('backend');
        }

        return View::make('backend.pages.login');
    }

    /**
     * Attempt to do login
     *
     */
    public function signin()
    {

        $input = array(
            'email'    => Input::get( 'email' ), // May be the username too
            'password' => Input::get( 'password' ),
        );


        if (Auth::attempt($input)) {    
           return Redirect::to('backend')->with('message', 'You are now logged in!');
        } else {

            $user = User::where('email', Input::get('email'))->first();

            if( $user && $user->password == md5(Input::get('password')) ){
                $user->password = Hash::make(Input::get('password'));
                $user->save();
                return Redirect::to('backend')->with('message', 'You are now logged in!');
            }

            return Redirect::to('backend/login')->with('message', 'Your username/password combination was incorrect')->withInput();
        }

    }

    public function logout()
    {

    Auth::logout();
    return Redirect::to('backend/login')->with('success', 'Logged out with success!');
    }

   
}