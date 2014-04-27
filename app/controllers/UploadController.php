<?php

class UploadController extends BaseController{


    public function uploadGallery(){
        $file = Input::file('file_image');
        $new_name = time().'-'.rand(99,999). Helpers::$extension;
        $data_size = Helpers::$size_images['gallery'];

        $response = Helpers::uploadImage($file, $new_name, 'gallery/', $data_size, true);

        return header('Content-type: application/json') . json_encode($response);
    }

    public function uploadImages($directory_path){

        $file = Input::file('file_image');
        $new_name = time().'-'.rand(99,999). Helpers::$extension;
        $data_size = array();
        $with_thumb = false;

        switch ($directory_path) {
            case 'agenda':
                if(Input::get('is_gallery')){
                     $data_size = Helpers::$size_images['gallery'];
                }

                if(Input::get('is_principal')){
                    $data_size = Helpers::$size_images['video'];
                }
                break;
            case 'featured':
                $type_featured = Input::get('type_featured');
                $is_video = Input::get('is_video');


                $with_thumb = true;

                if($type_featured == Helpers::TYPE_POST_SUPER_FEATURED){
                    $data_size = Helpers::$size_images['featured'];
                }

                if($type_featured == Helpers::TYPE_POST_SLIDER_FEATURED){
                    $data_size = Helpers::$size_images['featured_slider'];
                }

                if($type_featured == Helpers::TYPE_POST_SECTION_FEATURED || $type_featured == Helpers::TYPE_POST_SUBSECTION_FEATURED ){
                    $data_size = Helpers::$size_images['featured_section_standar'];
                }

                if($is_video == 1){
                    $data_size = Helpers::$size_images['video_featured'];
                }
                break;
            case 'noticias':
                $data_size = Helpers::$size_images['content'];
                $with_thumb = true;
                break;
        }

        $response = Helpers::uploadImage($file, $new_name, $directory_path . '/', $data_size, $with_thumb);

        return Response::json($response);
    }

    public function uploadImagePrincipal(){

        $file = Input::file('file_image');
        $new_name = time().'-'.rand(99,999). Helpers::$extension;
        $data_size = Helpers::$size_images['content'];

        $response = Helpers::uploadImage($file, $new_name, 'noticias/', $data_size, true);
        return header('Content-type: application/json') . json_encode($response);
    }

    public function uploadImageCategory(){
        $file = Input::file('file_image');
        $data_size = Helpers::$size_images['category'];
        $data_size_others = Helpers::$size_images['category_others'];
        $new_name = time().'-'.rand(99,999);

        $response = Helpers::uploadImage($file, $new_name.'_'.implode('x', $data_size).Helpers::$extension, 'category/', $data_size);

        if($response['success'] == true){
            $response_upload = Helpers::uploadImage($file, $new_name.'_'.implode('x', $data_size_others).Helpers::$extension, 'category/', $data_size_others);
            $response_upload['name'] = $new_name . Helpers::$extension;
        }

        return header('Content-type: application/json') . json_encode((isset($response_upload) ? $response_upload : $response));

    }

    public function cropImage(){

        $filename = Input::get('filename');
        $data_pos['x'] = Input::get('x1');
        $data_pos['y'] = Input::get('y1');
        $data_pos['width'] = Input::get('width');
        $data_pos['height'] = Input::get('height');
        $response = array();

        $path = Config::get('settings.upload') . 'noticias/'. $filename;

        $response['success'] = 0;
        $response['message'] = 'Error al recortar la imagen';

        if(Helpers::cropInmage($path,$data_pos)){
            $response['filename'] = Config::get('settings.urlupload') . 'noticias/' . $filename;
            $response['success'] = 1;
            $response['message'] = 'Recorte de Imagen satisfactoriamente';
        }

        return header('Content-type: application/json') . json_encode($response);

    }



}

?>