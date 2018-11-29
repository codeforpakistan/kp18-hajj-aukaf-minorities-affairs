<?php

/**
 * class clsAuthorizeCIMProfiles
 *
 * Description for class clsAuthorizeCIMProfiles
 *
 * @author:
*/
require 'configAuthNet.php';
require 'clsAuthorizeUtils.php';
require 'anet_php_sdk-master/AuthorizeNet.php';

class clsAuthorizeCIMProfiles  {

	/**
	 * clsAuthorizeCIMProfiles constructor
	 *
	 * @param 
	 */
	function __construct() {

		$oConfig = new configAuthNet();
	}
	
	public function createCustomerProfile($customerProfile) {
		
		$oUtils = new clsAuthorizeUtils();
		
		// Create new customer profile (fields in exact order
		$request = new AuthorizeNetCIM;
		$mProfile = new AuthorizeNetCustomer;
		$mProfile->description = $customerProfile->description;
		$mProfile->merchantCustomerId = $customerProfile->merchantCustomerId;
		$mProfile->email = $customerProfile->email;
		
		$response = $request->createCustomerProfile($mProfile);
		$response = $oUtils->xml2array($response);
		
		return $response['xml'];
		
	}
        
        public function createCustomerPaymentProfile($customerProfile,$customerProfileId) {
                 $oUtils = new clsAuthorizeUtils();
                 $request = new AuthorizeNetCIM;
                 $paymentProfile->customerType = $customerProfile->customerType;
                 $paymentProfile->billTo->firstName = $customerProfile->firstName;
                 $paymentProfile->billTo->lastName = $customerProfile->lastName;
                 $paymentProfile->billTo->company = $customerProfile->company;
                 $paymentProfile->billTo->address = $customerProfile->address;
                 $paymentProfile->billTo->city = $customerProfile->city;
                 $paymentProfile->billTo->state = $customerProfile->state;
                 $paymentProfile->billTo->zip = $customerProfile->zip;
                 $paymentProfile->billTo->country = $customerProfile->country;
                 $paymentProfile->billTo->phoneNumber = $customerProfile->phone;
                 $paymentProfile->payment->creditCard->cardNumber = $customerProfile->cardNumber;
                 $paymentProfile->payment->creditCard->expirationDate = $customerProfile->expirationDate;
                 //debug($paymentProfile);
                 $response = $request->createCustomerPaymentProfile($customerProfileId, $paymentProfile);
                 $response = $oUtils->xml2array($response);
                 return $response['xml'];   
}

        public function updateCustomerProfile($profileId, $customerProfile) {
		
		//profile fields need to be in exact order
		$mProfile->merchantCustomerId = $customerProfile->merchantCustomerId;
		$mProfile->description = $customerProfile->description;
		$mProfile->email = $customerProfile->email;
		$mProfile->customerProfileId = $customerProfile->customerProfileId;
		//$mProfile->merchantCustomerId = $customerProfile->merchantCustomerId; //test out-of-order
		
		
		$authNetCIM = new AuthorizeNetCIM();
		$oUtils = new clsAuthorizeUtils();
		
		$result = $authNetCIM->updateCustomerProfile($profileId, $mProfile);
		$result = $oUtils->xml2array($result);
		
		return $result['xpath_xml'];
		
	}
	
        public function updateCustomerPaymentProfile($customerProfileId, $customerPaymentProfileId, $customerProfile) {
		
		//profile fields need to be in exact order
		$paymentProfile->customerType = $customerProfile->customerType;
                 $paymentProfile->billTo->firstName = $customerProfile->firstName;
                 $paymentProfile->billTo->lastName = $customerProfile->lastName;
                 $paymentProfile->billTo->company = $customerProfile->company;
                 $paymentProfile->billTo->address = $customerProfile->address;
                 $paymentProfile->billTo->city = $customerProfile->city;
                 $paymentProfile->billTo->state = $customerProfile->state;
                 $paymentProfile->billTo->zip = $customerProfile->zip;
                 $paymentProfile->billTo->country = $customerProfile->country;
                 $paymentProfile->billTo->phoneNumber = $customerProfile->phoneNumber;
                 $paymentProfile->payment->creditCard->cardNumber = $customerProfile->cardNumber;
                 $paymentProfile->payment->creditCard->expirationDate = $customerProfile->expirationDate;
                 //$mProfile->merchantCustomerId = $customerProfile->merchantCustomerId; //test out-of-order
		//debug($customerProfileId);exit();
		
		$authNetCIM = new AuthorizeNetCIM();
		$oUtils = new clsAuthorizeUtils();
		
		$result = $authNetCIM->updateCustomerPaymentProfile($customerProfileId, $customerPaymentProfileId, $paymentProfile);
		$result = $oUtils->xml2array($result);
		return $result['xpath_xml'];
		
	}
        
	public function getCustomerProfile($profileId) {
		$authNetCIM = new AuthorizeNetCIM();
		$oUtils = new clsAuthorizeUtils();
		$profile = $authNetCIM->getCustomerProfile($profileId);
		$profile = $oUtils->xml2array($profile);
		
		return $profile['xpath_xml'];
	}
        
        public function getCustomerPaymentProfile($profileId,$paymentProfileId) {
		$authNetCIM = new AuthorizeNetCIM();
		$oUtils = new clsAuthorizeUtils();
		$profile = $authNetCIM->getCustomerPaymentProfile($profileId,$paymentProfileId);
		$profile = $oUtils->xml2array($profile);
		
		return $profile['xpath_xml'];
	}
        
        public function deleteCustomerProfile($profileId) {
		$authNetCIM = new AuthorizeNetCIM();
		$oUtils = new clsAuthorizeUtils();
		$profile = $authNetCIM->deleteCustomerProfile($profileId);
		$profile = $oUtils->xml2array($profile);
		
		return $profile['xpath_xml'];
	}
        
        public function deleteCustomerPaymentProfile($custId, $pmtId) {
		$authNetCIM = new AuthorizeNetCIM();
		$oUtils = new clsAuthorizeUtils();
		$profile = $authNetCIM->deleteCustomerPaymentProfile($custId, $pmtId);
		$profile = $oUtils->xml2array($profile);
		
		return $profile['xpath_xml'];
	}
        
        public function CustomerProfileTransaction($customerProfileId,$customerPaymentProfileId,$amount) {
        
    // Create Auth & Capture Transaction 
    $request = new AuthorizeNetCIM;
        $transaction = new AuthorizeNetTransaction;
            $transaction->amount = $amount;
            $transaction->customerProfileId = $customerProfileId;
            $transaction->customerPaymentProfileId = $customerPaymentProfileId;
         
        $oUtils = new clsAuthorizeUtils();
        $response = $request->createCustomerProfileTransaction("AuthCapture", $transaction);
        $response = $oUtils->xml2array($response);
		
        return $response['xpath_xml'];
        }
        
}

?>