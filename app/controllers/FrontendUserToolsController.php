<?php 

class FrontendUserToolsController extends BaseController {

	public function viewChangeColor(){
        if(Request::ajax()){
            return View::make('frontend.pages.partials.user_tools')->render();
        }
	}

}


?>