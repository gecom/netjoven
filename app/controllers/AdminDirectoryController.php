<?php

class AdminDirectoryController extends BaseController {


	public function listDirectoryPublications($dbr_directory, $slug = null){

		$params['id'] = $dbr_directory->id;
		$params_template['dbl_directory_publications'] = $dbr_directory->getPublications($params)->paginate();
		$params_template['dbr_directory'] = $dbr_directory;
		$params_template['title_directory'] = 'Listado de '.$dbr_directory->title;
		$params_template['name_button_add'] = 'Agregar '.$dbr_directory->title;

		return View::make('backend.pages.directory_publications_list', $params_template);
	}

	public function directoryPublicationEdit($directory, $slug = null, $directory_publication = null){
		$params_template['is_new'] = $is_new = false;
		$params_template['title'] = 'Editar ' . $directory->title;//($directory->id == 1 ? Lang::get('messages.backend.edit_title_pichanga') : Lang::get('messages.backend.edit_title_juerga'));
		$params_template['dbl_directory_publication'] = $directory_publication;
		$params_template['dbr_directory'] = $directory;

 		if(!$directory_publication){
			$params_template['title'] = 'Agregar ' . $directory->title;//($directory->id == 1 ? Lang::get('messages.backend.new_title_pichanga') : Lang::get('messages.backend.new_title_juerga'));
			$params_template['is_new'] = $is_new = true;
		}

		$params_template['type_binge'] = array(Helpers::TYPE_BINGE_BAR, Helpers::TYPE_BINGE_DISCOTECA, Helpers::TYPE_BINGE_LOUNGES);
		$params_template['dbl_district'] = Helpers::getDistrict();

		return View::make('backend.pages.directory_publication_register', $params_template);

	}

	public function directoryPublicationSave($directory, $slug = null, $directory_publication = null){

		$data_frm_directory_publication = Input::get('frm_directory');

		$is_new =  false;
		if($data_frm_directory_publication['is_new'] == 1){
			$is_new = true;
		}

		$rules = array(
			'title'  	=> 'required|min:3',
			'address'   => 'required|min:3',
			'district'	=> 'required',
			'web'		=> 'url'
		);

		if($directory->id == 2){
			$rules['type'] = 'required';
		}

		$dbr_directory_publication = ($is_new == true ? new DirectoryPublication() : $directory_publication);
		$dbr_directory = $directory;

		$validator = Validator::make($data_frm_directory_publication, $rules);
		$response = array();

        if ( $validator->fails() ){
			if(Request::ajax()){
				$response['success'] = false;
				$response['errors'] =  $validator->getMessageBag()->toArray();
			} else{
				return Redirect::back()->withInput()->withErrors($validator);
			}
        }else{

        	$place = $data_frm_directory_publication['latitude'] . ' '. $data_frm_directory_publication['longitude'];

			$dbr_directory_publication->title = $data_frm_directory_publication['title'];
			$dbr_directory_publication->slug = $data_frm_directory_publication['title'];

			if($directory->id == 2){
        		$dbr_directory_publication->type = $data_frm_directory_publication['type'];
			}

        	$dbr_directory_publication->address = $data_frm_directory_publication['address'];
        	$dbr_directory_publication->id_district = $data_frm_directory_publication['district'];
        	$dbr_directory_publication->web = $data_frm_directory_publication['web'];
        	$dbr_directory_publication->phone = $data_frm_directory_publication['phone'];
        	$dbr_directory_publication->observation = $data_frm_directory_publication['observation'];
        	$dbr_directory_publication->place = $place ;

        	if($is_new){
				$dbr_directory_publication->directory_id = $dbr_directory->id;
        	}

        	try {
				if($dbr_directory_publication->save()){
					$response['success'] = true;
					$response['message'] =  'Juerga registrada satisfactoriamente';
					if($is_new){
						$response['redirect'] =  route('backend.directory.edit', array($dbr_directory->id, $dbr_directory->slug, $dbr_directory_publication->id));
					}

				}else{
					$response['success'] = false;
					$response['errors'] =  ['Error al registrar Juerga'];
				}

        	} catch (Exception $e) {
        		$response['success'] = false;
        		$response['errors'] =  ['Error:' . $e->getMessage()];
        	}

        }

		return Response::json($response);
	}


	public function directoryPublicationImageSave($directory, $slug, $directory_publication){
		$data_frm_directory_publication = Input::get('frm_directory');

		$dbr_directory_publication = $directory_publication;
		$response = array();

		if($dbr_directory_publication && ($data_frm_directory_publication['image_principal'] || $data_frm_directory_publication['image_internal'] )){
			if($data_frm_directory_publication['image_principal']){
				$dbr_directory_publication->image = $data_frm_directory_publication['image_principal'];
			}

			if($data_frm_directory_publication['image_internal']){
				$dbr_directory_publication->banner = $data_frm_directory_publication['image_internal'];
			}

			try {
				$dbr_directory_publication->save();
				$response['success'] = true;
				$response['message'] =  'Imagenes guardadas satisfactoriamente';
			} catch (Exception $e) {
				$response['success'] = false;
				$response['errors'] =  ['Error:' . $e->getMessage()];
			}
		}

		return Response::json($response);

	}

}

?>