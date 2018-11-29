<?php

/**
 * class clsAuthorizeUtils
 *
 * Description for class clsAuthorizeUtils
 *
 * @author:
*/
class clsAuthorizeUtils  {

	/**
	 * clsAuthorizeUtils constructor
	 *
	 * @param 
	 */
	function __construct() {

	}
	
	function xml2array ( $xmlObject, $out = array () ){
		foreach ( (array) $xmlObject as $index => $node )
			$out[$index] = ( is_object ( $node ) ) ? $this->xml2array ( $node ) : $node;

		return $out;
	}
}

?>