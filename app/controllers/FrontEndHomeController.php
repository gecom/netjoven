<?php

class FrontEndHomeController extends BaseController {

	public function home(){

		return View::make('frontend.pages.home.home');
	}

}


?>