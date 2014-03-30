<?php 
class status {
	
	const STATUS_PUBLICADO = 'pbl';
	const STATUS_DESPUBLICADO = 'dpl';
	const STATUS_ACTIVO = 'act';
	const STATUS_INACTIVO = 'ina';
	const STATUS_SPAM = 'spm';

	public static $statuses = array(
		self::STATUS_PUBLICADO => 'Publicado',
		self::STATUS_DESPUBLICADO => 'Despublicado',
		self::STATUS_ACTIVO => 'Activo',
		self::STATUS_INACTIVO => 'Inactivo',
		self::STATUS_SPAM => 'Spam'
	);
	
}

?>