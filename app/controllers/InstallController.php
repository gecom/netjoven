<?php 

class InstallController extends BaseController {

	public function getGenerate(){
		set_time_limit(0);

		/*$dbl_category = DB::select('SELECT id, name, description FROM njv_category');
		$num_categories_update = 0;

		foreach ($dbl_category as $dbr_category) {
			$num_categories_update += DB::update("UPDATE njv_category SET slug = ? WHERE id = ? ", array(Helpers::generateSlug($dbr_category->description), $dbr_category->id));
		}

		return $num_categories_update;*/


		//return $this->migrateTags();

		 $this->migrateNews();
	}

	public function migrateUser(){
		$dbl_users = DB::select("SELECT id, usuario, passwd, IF(level = 'desahabilitado','ina','act') status ,IF(level = 'desahabilitado' , 'usuario', level) as level, email, email_register,usuariosocial, foto, NOW() as created_at FROM users");

		foreach ($dbl_users as $dbr_user) {

			echo $dbr_user->id."<br>";
			//DB::insert('INSERT INTO njv_user (id, user, password, status, level, email, email_register, user_social, image, created_at) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', array($dbr_user->id, $dbr_user->usuario, $dbr_user->passwd, $dbr_user->status, $dbr_user->level, $dbr_user->email, $dbr_user->email_register, $dbr_user->usuariosocial, $dbr_user->foto, $dbr_user->created_at));
		}

	}

	public function migrateNews(){

		DB::update("UPDATE njv_news SET slug =  Helpers::generateSlug(`title`)");

		/*$dbl_news = DB::select("SELECT id, title FROM njv_news where title <> ''");

		foreach ($dbl_news as $dbr_news) {
			$slug = Helpers::generateSlug($dbr_news->title);
			DB::update("UPDATE njv_news SET slug = ?  WHERE id = ?  ", array($slug, $dbr_news->id) );
		}*/	
		
	}


	public function migrateTags(){
		$dbl_tags = DB:: select("SELECT id, tag FROM njv_tag WHERE tag <> ''");
		$num_total_tags = 0;

		foreach ($dbl_tags as $dbr_tag) {
			$slug = Helpers::generateSlug($dbr_tag->tag);
			$dbr_tag_verify = DB:: select("SELECT id, tag FROM njv_tag WHERE slug = ? ", array($slug));

			if($dbr_tag_verify){
				$slug = $slug . '_' . uniqid();
			}

			$num_total_tags += DB::update("UPDATE njv_tag SET slug = ? WHERE id = ? ", array($slug, $dbr_tag->id));
		}

		return $num_total_tags;

	}

}
