<?php 

class FrontendUserToolsController extends BaseController {

	public function viewChangeColor(){
        if(Request::ajax()){
            return View::make('frontend.pages.partials.user_tools')->render();
        }
	}

	public function changeTypeModule($type_module = null){
		$type_module = (empty($type_module) ? Helpers::TYPE_MODULE_ESTANDAR : $type_module);

		if(Request::ajax()){
			return View::make('frontend.pages.partials.type_module',array('type_module'=>$type_module))->render();
		}

	}

	public function saveTypeModule($type_module){
		$type_module = (empty($type_module) ? Helpers::TYPE_MODULE_ESTANDAR : $type_module);
		$cookie = null;

		if(Auth::check()){
			$params['type_module'] = $type_module;
			$this->saveUserTool($dbr_user->id, $params);
		}else{
			if(Cookie::has('type_module')){
				Cookie::forget('type_module');
			}
			$cookie = Cookie::forever('type_module', $type_module);
		}

		$response['success'] = true;
		$response['type_module'] = $type_module;
		$response['message'] = 'Tus cambios se realizaron con éxito';

		return Response::json($response)->withCookie($cookie);
	}

	public function saveChangeColor(){
		if(Request::ajax()){
			if(Auth::check()){
				$dbr_user = Auth::user();

				try {
					$dbr_color = ColorPalette::where('color','=', Input::get('color'));

					$response = array();
					if(!$dbr_color){
						throw new Exception("Error al guardar el color");						
					}

					$params['color_palette_id'] = $dbr_color->id;
					$this->saveUserTool($dbr_user->id, $params);
					$response['success'] = true;
					$response['message'] = 'Cambio de colores guardados satisfactoriamente';
				} catch (Exception $e) {
					$response['success'] = false;
					$response['message'] = $e->getMessage();
				}				
			}

			return Response::json($response);			
		}

	}

	private function saveUserTool($user_id, $params = array()){
		$dbr_user_tool = UserTool::getToolByUserId($user_id);

		if(!$dbr_user_tool){
			$dbr_user_tool = new UserTool();
		}

		$dbr_user_tool->user_id = $dbr_user->id;

		if(isset($params['color_palette_id'])){
			$dbr_user_tool->color_palette_id = $params['color_palette_id'];
		}

		if(isset($params['type_module'])){
			$dbr_user_tool->color_palette_id = $params['type_module'];
		}
		
		$dbr_user_tool->save();
	}

}


?>