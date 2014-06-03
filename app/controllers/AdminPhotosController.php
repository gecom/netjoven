<?php

class AdminPhotosController extends BaseController {

	public function listPhotosUser(){
		$dbl_photos = Photos::where('user_id', '=', Auth::User()->id)->limit(30)->get();
		return View::make('backend.pages.photos_post', array('dbl_photos' => $dbl_photos));
	}

	public function savePhoto(){
		if(Request::ajax()){
			$image = Input::get('image', null);
			if(!empty($image)){

				$response = array();
				$dbr_photos = new Photos();
				$dbr_photos->user_id = Auth::User()->id;
				$dbr_photos->image = $image;
				try {
					$dbr_photos->save();	
					$response['success'] = true;
					$response['message'] = 'Imagen subida satisfactoriamente';
				} catch (Exception $e) {
					$response['success'] = false;
					$response['message'] = 'Error: ' . $e->getMessage();
				}

				return json_encode($response);				
			}
		}
	}

}

?>