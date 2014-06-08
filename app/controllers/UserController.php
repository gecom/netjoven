<?php



class UserController extends BaseController {

    public function login(){
        if(Request::ajax()){
            return View::make('frontend.pages.partials.login')->render();
        }
    }

    public function userRegister(){
        if(Auth::check()){
            return Redirect::route('frontend.user.edit_perfil');
        }

        $params_template['meter_likebox'] = array(300, 286);
        return View::make('frontend.pages.user.user_register', $params_template);
    }

    public function editPerfilUser(){
        if(!Auth::check()){
            return Redirect::route('home');
        }

        $dbr_user = Auth::user();

        $params_template['meter_likebox'] = array(300, 286);
        $params_template['dbr_user'] = ($dbr_user ? $dbr_user : null);
        $params_template['dbr_user_profile'] = ($dbr_user ? $dbr_user->userProfile()->first() : null);
        return View::make('frontend.pages.user.user_register', $params_template);
    }


    public function saveUserProfile(){

        $params_form = Input::all();
        $rules = array(
            'first_name'=>'required|alpha|min:2',
            'last_name'=>'required|alpha|min:2',
            'email'=>'required|email|unique:njv_user',
            'password'=>'required|alpha_num|between:6,12',
            'day'=>'required',
            'month'=>'required',
            'year'=>'required',
            'gender'=>'required',
        );
        $params_form = $params_form['frm_user'];

        $validation = Validator::make($params_form, $rules);
        if ($validation->fails()) {
            return Redirect::route('frontend.user.register')->with('message', 'The following errors occurred')->withErrors($validation)->withInput();
        }

        $dbr_user = new User();
        $dbr_user->user = uniqid();
        $dbr_user->email = $params_form['email'];
        $dbr_user->password = Hash::make($params_form['password']);
        $dbr_user->save();

        $dbr_user_profile = new UserProfile();
        $dbr_user_profile->first_name = $params_form['first_name'];
        $dbr_user_profile->last_name = $params_form['last_name'];
        $dbr_user_profile->gender = $params_form['gender'];
        $dbr_user_profile->birthday = $params_form['year'].'-'.$params_form['month'].'-'.$params_form['day'];

        $dbr_user->userProfile()->save($dbr_user_profile);

        return Redirect::route('home');

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

            $user = User::getAdmin()->where('email', Input::get('email'))->first();

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

        if(Request::segment(1) == 'backend'){
            return Redirect::to('backend/login')->with('success', 'Logged out with success!');
        }else{
            return Redirect::to('/');
        }

    }


}