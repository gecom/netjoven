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
            'client_id'     => 'uDFVcO19SyyopNeyDWFZswWg3',
            'client_secret' => 'iZsiGfqshR3dO34RWeM0D7vwNe9OnRE6QtcrPdGP65EA4StZAy',
            'scope'         => array(),
        ),			

	)

);