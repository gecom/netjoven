<?php



class UserController extends BaseController {




    /**
     * Displays the login form
     *
     */


    public function login(){

        if(Request::ajax()){
            return View::make('frontend.pages.partials.login')->render();
        }

    }

    public function loginBackend()
    {
        $user = Auth::user();

        if(!empty($user->id)){
            return Redirect::to('backend');
        }

        return View::make('backend.pages.login');
    }

    public function signin(){
                $input = array(
            'email'    => Input::get( 'email' ), // May be the username too
            'password' => Input::get( 'password' ),
        );

        $response = array();

        if(Request::ajax()){
            if (Auth::attempt($input)) {                
                $response['success'] = true;
                $response['message'] =  'Usuario Logeado Satisfactoriamente';
            } else {
 
                $user = User::where('email', Input::get('email'))->first();

                if( $user && $user->password == md5(Input::get('password')) ){
                    $user->password = Hash::make(Input::get('password'));
                    $user->save();
                    $response['success'] = true;
                    $response['message'] =  'Usuario Logeado Satisfactoriamente';
                    return Response::json($response);
                }
                
                $response['success'] = false;
                $response['message'] =  'Correo o contraseña no es correcta';
            }

            return Response::json($response);
        }

    }

    /**
     * Attempt to do login
     *
     */
    public function signinBackend()
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