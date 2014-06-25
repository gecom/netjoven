<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
        'Facebook' => array(
            'client_id'     => '726280160751027',
            'client_secret' => 'd68863cb259cb63bd2ae581dca32060c',
            'scope'         => array(),
        ),

        'Twitter' => array(
            'client_id'     => 'KZNQ89WSldOSQqWrK2OiehKgq',
            'client_secret' => 'il0kA0dyibcmDDvUUHKzqqLyhpGHXUMhDQl863q8c4mcJWvYpK',
            'scope'         => array(),
        ),			

	)

);