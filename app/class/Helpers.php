<?php 

class Helpers {

	public static function generateSlug($s)
	{
		$s = trim($s);
		$s = preg_replace('`\[.*\]`U','',$s);
		$s = str_replace( array('!','¿','?','ç', 'Ç','.','(',')','$',',',';','\'',':','_'),'', $s );
		$s = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$s);
		$s = htmlentities($s, ENT_COMPAT, "UTF-8");
		$s = preg_replace( '`&([a-z]+)(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i',"\\1", $s );
		$s = preg_replace( array('`[^a-z0-9_]`i','`[-]+`') , ' ',$s);
		$s = trim($s);
		$s = str_replace(" ","-",$s);
		return $s;
	}


}

?>