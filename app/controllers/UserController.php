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
        $params_template['dbr_user_profile'] = $dbr_user_profile = ($dbr_user ? $dbr_user->userProfile()->first() : null);

        if($dbr_user_profile && $dbr_user_profile->image){
            $data_image = explode("-",$dbr_user_profile->image);
            $params_template['image_avatar'] = Helpers::getImage($data_image[1], 'user/'. $data_image[0]);
        }

        $params_template['dbl_country'] = UserHelper::getCountry();
        $country_current_user = null;

        if($dbr_user_profile){
            $country_current_user = $dbr_user_profile->country;
        }else{
            $dbr_country_data = Helpers::getCountryData();      
            $country_current_user = $dbr_country_data->country_name;
        }

        $params_template['country_current_user'] = (empty($country_current_user) ? 'Peru' : $country_current_user);
        $params_template['dbl_department'] = UserHelper::getDepartment();

        if($country_current_user == 'Peru'){
            $params_template['dbl_city'] = UserHelper::getProvinceByDepartment($dbr_user_profile->department);
        }else{
            $params_template['dbl_city'] = UserHelper::getCityByCountry($country_current_user);
        }

        return View::make('frontend.pages.user.user_register', $params_template);
    }


    public function saveUserProfile(){

        $is_new_user = (Auth::check() ? false: true);

        $rules = array(
            'first_name'=>'required|min:2',
            'last_name'=>'required|min:2',
            'password'=>'',
            'day'=>'required',
            'month'=>'required',
            'year'=>'required',
            'gender'=>'required',
            'country'=>'required',
            'city'=>'required'            
        );
        
        $params_form = Input::get('frm_user');

        if(isset($params_form['department'])){
            $rules['department'] = 'required';
        }

        if($is_new_user){
            $rules['password'] = 'required|alpha_num|between:6,12';
            $rules['email'] = 'required|email|unique:njv_user';
        }

        $validation = Validator::make($params_form, $rules);
        if ($validation->fails()) {
            return Redirect::route(Route::currentRouteName())->with('message', 'The following errors occurred')->withErrors($validation)->withInput();
        }

        $dbr_user = $is_new_user == false ? Auth::User() : new User() ;
        if($is_new_user == true){
            $dbr_user->user = uniqid();
            $dbr_user->email = $params_form['email'];
            $dbr_user->password = Hash::make($params_form['password']);
            $dbr_user->level = UserHelper::LEVEL_USER_NORMAL;
            $dbr_user->save();
        }

        $dbr_user_profile = (!$is_new_user ? Auth::User()->userProfile()->first() : new UserProfile()) ;
        $dbr_user_profile->first_name = $params_form['first_name'];
        $dbr_user_profile->last_name = $params_form['last_name'];
        $dbr_user_profile->gender = $params_form['gender'];
        $dbr_user_profile->country = $params_form['country'];
        $dbr_user_profile->department = $params_form['department'];
        $dbr_user_profile->city = $params_form['city'];
        $dbr_user_profile->image = $params_form['image'];
        $dbr_user_profile->birthday = $params_form['year'].'-'.$params_form['month'].'-'.$params_form['day'];

        if($is_new_user == true){
            $dbr_user->userProfile()->save($dbr_user_profile);    
        }else{
            $dbr_user_profile->save();
        }        

        return  Redirect::route('frontend.user.edit_perfil');
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

            $dbr_user = User::where('user', '=', $result['id']);
            $is_new_user_social = false;

            if(!$dbr_user){
                $dbr_user = new User();
                $dbr_user->user = $result['id'];
                $dbr_user->level = UserHelper::LEVEL_USER_NORMAL;
                $dbr_user->save();

                $dbr_user_profile = new UserProfile();
                $dbr_user_profile->first_name = $result['first_name'];
                $dbr_user_profile->last_name = $result['last_name'];
                $dbr_user_profile->gender = ($result['gender'] == 'male' ? 'M' : 'F' );
                $dbr_user_profile->save();
                $is_new_user_social = true;
            }

            Session::flush();
            Auth::login($dbr_user);

            Redirect::route('frontend.user.register');

        }
        // if not ask for permission first
        else {
            // get fb authorization
            $url = $fb->getAuthorizationUri();

            // return to facebook login url
             return Redirect::to( (string) $url );
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

            $dbr_user = Auth::User();

            if($dbr_user->level == UserHelper::LEVEL_USER_NORMAL){
                Auth::logout();
                return Redirect::to('backend/login')->with('message', 'Your username/password combination was incorrect')->withInput();
            }

           return Redirect::to('backend')->with('message', 'You are now logged in!');
        } else {

            $user = User::getAdmin()->where('email', Input::get('email'))->first();

            if( $user && $user->password == md5(Input::get('password')) ){
                $user->password = Hash::make(Input::get('password'));
                $user->save();
                return Redirect::to('backend')->with('message', 'You are now logged in!');
            }

            return Redirect::to('backend/login')->with('message', 'Your username/password combination was incorrect fff')->withInput();
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

    public function loadCity(){
        $name = Input::get('country_name', null);
        $data = array();

        if(Request::ajax()){
            if($name){
                $data = UserHelper::getCityByCountry($name);
            }
        }

        return Response::json($data);
    }

    public function loadProvince(){
        $name = Input::get('department_name', null);
        $data = array();
        
        if(Request::ajax()){
            if($name){
                $data = UserHelper::getProvinceByDepartment($name);
            }
        }

        return Response::json($data);
    }


}