<?php



class UserController extends BaseController {

    public function login(){
        if(Request::ajax()){
            return View::make('frontend.pages.partials.login')->render();
        }
    }

    public function userRegister(){
        $params_template['meter_likebox'] = array(300, 286);
        return View::make('frontend.pages.user.user_register', $params_template);
    }

    public function loginWithFacebook() {

        // get data from input
        $code = Input::get( 'code' );

        // get fb service
        $fb = OAuth::consumer( 'Facebook' );

        // check if code is valid

        // if code is provided get user data and sign in
        if ( !empty( $code ) ) {

            // This was a callback request from facebook, get the token
            $token = $fb->requestAccessToken( $code );

            // Send a request with it
            $result = json_decode( $fb->request( '/me' ), true );

            $message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
            echo $message. "<br/>";

            //Var_dump
            //display whole array().
            dd($result);

        }
        // if not ask for permission first
        else {
            // get fb authorization
            $url = $fb->getAuthorizationUri();

            // return to facebook login url
             return Redirect::to( (string)$url );
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
        $http_referer = Request::server('HTTP_REFERER');

        if(Request::ajax()){
            if (Auth::attempt($input)) {                
                $response['success'] = true;
                $response['message'] =  'Usuario Logeado Satisfactoriamente';
                $response['redirect'] = ($http_referer ? $http_referer : route('home')) ;
            } else {
 
                $user = User::where('email', Input::get('email'))->first();

                if( $user && $user->password == md5(Input::get('password')) ){
                    $user->password = Hash::make(Input::get('password'));
                    $user->save();
                    $response['success'] = true;
                    $response['message'] =  'Usuario Logeado Satisfactoriamente';
                    $response['redirect'] = ($http_referer ? $http_referer : route('home')) ;
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