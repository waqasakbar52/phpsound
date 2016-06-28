<?php
function PageMain() {
	global $TMPL, $LNG, $CONF, $db, $loggedIn, $settings;
	
	if(!$settings['paypalapp']) {
		header("Location: ".$CONF['url']."/index.php?a=welcome");
	}
	
	if(isset($_SESSION['username']) && isset($_SESSION['password']) || isset($_COOKIE['username']) && isset($_COOKIE['password'])) {	
		$verify = $loggedIn->verify();
		
		if(empty($verify['username'])) {
			// If fake cookies are set, or they are set wrong, delete everything and redirect to home-page
			$loggedIn->logOut();
			header("Location: ".$CONF['url']."/index.php?a=welcome");
		}
	}
	
	// Start the music feed
	$feed = new feed();
	$feed->db = $db;
	$feed->url = $CONF['url'];
	$feed->user = $verify;
	$feed->id = $verify['idu'];
	$feed->username = $verify['username'];
	$proAccount = $feed->getProStatus($feed->id, 0);
	
	$TMPL_old = $TMPL; $TMPL = array();
	
	// Get the PayPal settings
	$PayPalMode 			= ($settings['paypalsand'] ? '.sandbox' : ''); // Decide whether whether the request is for sandbox or live
	$PayPalCurrencyCode 	= $settings['currency']; // Paypal Currency Code
	$PayPalReturnURL 		= $CONF['url'].'/index.php?a=pro&type=successful'; // Show the newly created Pro Plan
	$PayPalCancelURL		= $CONF['url'].'/index.php?a=pro&type=canceled'; // Canceling URL if user clicks cancel
	$paypal = new paypalApi();
	$paypal->username = $settings['paypaluser']; // PayPal API Username
	$paypal->password = $settings['paypalpass']; // Paypal API password
	$paypal->signature = $settings['paypalsign']; // Paypal API Signature
	
	$skin = new skin('pro/gopro'); $rows = '';
	
	// If the user is logged-in
	if($feed->id) {
		if(isset($_POST['plan']) && !$proAccount) {
			$ItemName 		= ($_POST["plan"] == 1 ? sprintf($LNG['pro_year'], $settings['title']) : sprintf($LNG['pro_month'], $settings['title'])); //Item Name
			$ItemPrice 		= ($_POST["plan"] == 1 ? $settings['proyear'] : $settings['promonth']); //Item Price
			$ItemNumber 	= ($_POST["plan"] == 1 ? md5(1) : md5(0)); //Item Number
			$ItemDesc 		= ($_POST["plan"] == 1 ? sprintf($LNG['pro_year'], $settings['title']) : sprintf($LNG['pro_month'], $settings['title'])); //Item Number
			$ItemQty 		= 1; // Item Quantity
			$ItemTotalPrice = ($ItemPrice * $ItemQty); // (Item Price x Quantity = Total) Get total amount of product;
			
			// Parameters for SetExpressCheckout, which will be sent to PayPal
			$params = array(
				'METHOD' => 'SetExpressCheckout',
				'RETURNURL' => $PayPalReturnURL,
				'CANCELURL' => $PayPalCancelURL,
				'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE',
				
				'L_PAYMENTREQUEST_0_NAME0' => $ItemName,
				'L_PAYMENTREQUEST_0_NUMBER0' => $ItemNumber,
				'L_PAYMENTREQUEST_0_DESC0' => $ItemDesc,
				'L_PAYMENTREQUEST_0_AMT0' => $ItemPrice,
				'L_PAYMENTREQUEST_0_QTY0' => $ItemQty,
				
				'NOSHIPPING' => 0, // Don't require shipping address
				
				'PAYMENTREQUEST_0_ITEMAMT' => $ItemTotalPrice,
				'PAYMENTREQUEST_0_AMT' => $ItemPrice,
				'PAYMENTREQUEST_0_CURRENCYCODE' => $PayPalCurrencyCode,
				'PAYMENTREQUEST_0_ALLOWEDPAYMENTMETHOD' => 'InstantPaymentOnly',
				'LOCALECODE' => 'US', // PayPal pages to match the language on your website
				'LOGOIMG' => $CONF['url'].'/'.$CONF['theme_url'].'/images/logo_black.png', // Site logo
				'CARTBORDERCOLOR' => 'FFFFFF', //border color of cart
				'ALLOWNOTE' => 0
			);
						
			// Store the selected plan
			$_SESSION['SelectedPlan']		= $_POST['plan'];
			$_SESSION['ItemName'] 			= $ItemName; // Item Name
			$_SESSION['ItemPrice'] 			= $ItemPrice; // Item Price
			$_SESSION['ItemNumber'] 		= $ItemNumber; // Item Number
			$_SESSION['ItemDesc'] 			= $ItemDesc; // Item Number
			$_SESSION['ItemQty'] 			= $ItemQty; // Item Quantity
			$_SESSION['ItemTotalPrice'] 	= $ItemTotalPrice; // (Item Price x Quantity = Total) Get total amount of product;

			// Execute SetExpressCheckOut method to create the payment token and PayerID
			$paypalResponse = $paypal->post('SetExpressCheckout', $params, $PayPalMode);
			
			//Respond according to message we receive from Paypal
			if(strtoupper($paypalResponse["ACK"]) == "SUCCESS") {
				// Generat the PayPal payment url with the response Token
				$paypalurl = 'https://www'.$PayPalMode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$paypalResponse["TOKEN"].'';

				// Redirect to PayPal payment page
				header('Location: '.$paypalurl);
			} else {
				// If the payment is not successful
				$TMPL['error'] = notificationBox('error', '<strong>'.urldecode($paypalResponse['L_SHORTMESSAGE0'].'</strong>: '.$paypalResponse['L_LONGMESSAGE0']));
			}
		} elseif($_GET['type'] == 'canceled' && !$proAccount) {
			// If the payment has been canceled
			$TMPL['error'] = notificationBox('error', $LNG['payment_error_1']);
		} elseif($_GET['type'] == 'successful' && !$proAccount) {
			$skin = new skin('pro/gopro'); $rows = '';
			
			// If the token and PayerID has been returned by the Return URL
			if(isset($_GET["token"]) && isset($_GET["PayerID"])) {
				
				$token = $_GET["token"];
				$payer_id = $_GET["PayerID"];
				
				// Get the selected plan
				$ItemName 			= $_SESSION['ItemName']; // Item Name
				$ItemPrice 			= $_SESSION['ItemPrice'] ; // Item Price
				$ItemNumber 		= $_SESSION['ItemNumber']; // Item Number
				$ItemDesc 			= $_SESSION['ItemDesc']; // Item Number
				$ItemQty 			= $_SESSION['ItemQty']; // Item Quantity
				$ItemTotalPrice 	= $_SESSION['ItemTotalPrice'];

				$params = array(
					'TOKEN' => $token,
					'PAYERID' => $payer_id,
					'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
					
					//set item info here, otherwise we won't see product details later	
					'L_PAYMENTREQUEST_0_NAME0' => $ItemName,
					'L_PAYMENTREQUEST_0_NUMBER0' => $ItemNumber,
					'L_PAYMENTREQUEST_0_DESC0' => $ItemDesc,
					'L_PAYMENTREQUEST_0_AMT0' => $ItemPrice,
					'L_PAYMENTREQUEST_0_QTY0' => $ItemQty,

					'PAYMENTREQUEST_0_ITEMAMT' => $ItemTotalPrice,
					'PAYMENTREQUEST_0_AMT' => $ItemPrice,
					'PAYMENTREQUEST_0_CURRENCYCODE' => $PayPalCurrencyCode,
					'PAYMENTREQUEST_0_ALLOWEDPAYMENTMETHOD'	=> 'InstantPaymentOnly'
				);
				
				// Execute DoExpressCheckoutPayment to receive the payment from the user
				$paypalResponse = $paypal->post('DoExpressCheckoutPayment', $params, $PayPalMode);
				
				// Check if the payment was successful
				if(strtoupper($paypalResponse["ACK"]) == "SUCCESS") {
					
					
					// Verify if the payment is Completed
					if($paypalResponse["PAYMENTINFO_0_PAYMENTSTATUS"] == 'Completed') {
						// Execute GetExpressCheckoutDetails to retrieve the transaction details
						$params = array('TOKEN' => $token);

						$paypalResponse = $paypal->post('GetExpressCheckoutDetails', $params, $PayPalMode);
						
						// If the GetExpressCheckoutDetails was successful
						if(strtoupper($paypalResponse["ACK"]) == "SUCCESS") {
							$date = date("Y-m-d H:m:s", strtotime(($_SESSION['SelectedPlan'] == 1 ? "+1 year" : "+1 month")));
							
							$stmt = $db->prepare(sprintf("INSERT INTO `payments`
								(`by`, `payer_id`, `payer_first_name`, `payer_last_name`, `payer_email`, `payer_country`, `txn_id`, `amount`, `currency`, `type`, `status`, `valid`, `time`) VALUES 
								('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s', '%s', '%s', '%s')",
								$db->real_escape_string($feed->id), $db->real_escape_string($paypalResponse['PAYERID']), $db->real_escape_string($paypalResponse['FIRSTNAME']), $db->real_escape_string($paypalResponse['LASTNAME']), $db->real_escape_string($paypalResponse['EMAIL']), $db->real_escape_string($paypalResponse['SHIPTOCOUNTRYNAME']), $db->real_escape_string($paypalResponse['PAYMENTREQUEST_0_TRANSACTIONID']), $db->real_escape_string($paypalResponse['AMT']), $settings['currency'], $_SESSION['SelectedPlan'], 1, $date, date("Y-m-d H:m:s")));

							// Execute the statement
							$stmt->execute();
							
							// Check the affected rows
							$affected = $stmt->affected_rows;

							// Close the statement
							$stmt->close();
							
							// If the pro status has been added
							if($affected) {
								// Set the pro account to valid
								$proAccount = 2;
							}
						} else {
							$TMPL['error'] = notificationBox('error', '<strong>'.urldecode($paypalResponse['L_SHORTMESSAGE0'].'</strong>: '.$paypalResponse['L_LONGMESSAGE0']));
						}
					} else {
						$TMPL['error'] = notificationBox('error', '<strong>'.urldecode($paypalResponse['L_SHORTMESSAGE0'].'</strong>: '.$paypalResponse['L_LONGMESSAGE0']));
					}
				} else {
					$TMPL['error'] = notificationBox('error', '<strong>'.urldecode($paypalResponse['L_SHORTMESSAGE0'].'</strong>: '.$paypalResponse['L_LONGMESSAGE0']));
				}
			}
		}
		
		if($proAccount) {
			$skin = new skin('pro/successful'); $rows = '';
			$transaction = $feed->getProStatus($feed->id, 2);
			
			// If the proAccount was just created
			if($proAccount == 2) {
				$TMPL['pro_title'] = $LNG['congratulations'].'!';
				$TMPL['pro_title_desc'] = $LNG['go_pro_congrats'];
			} else {
				$TMPL['pro_title'] = $LNG['pro_plan'];
				$TMPL['pro_title_desc'] = $LNG['account_status'];
			}
			
			// Explode the date to display in a custom format
			$valid = explode('-', $transaction['valid']);
			$TMPL['validuntil'] = $valid[0].'-'.$valid[1].'-'.substr($valid[2], 0, 2);

			// Decide the plan type
			$TMPL['plan'] = ($transaction['type'] ? $LNG['yearly'] : $LNG['monthly']);
			
			// Days left of pro Plan
			$TMPL['daysleft'] = floor((strtotime($transaction['valid']) - strtotime(date("Y-m-d H:i:s")))/(60*60*24)).' '.$LNG['days_left'];
			
			// The Amount paid for the pro plan
			$TMPL['amount'] = $transaction['amount'].' '.$settings['currency'];
		}
		$TMPL['go_pro_action'] = 'formSubmit(\'gopro-form\')';
	} else {
		$TMPL['go_pro_action'] = 'connect_modal()';
	}
	
	$TMPL['history'] = $feed->proAccountHistory(null, 1, 1);
	
	$TMPL['protracksize'] = fsize($settings['protracksize']);
	$TMPL['protracktotal'] = fsize($settings['protracktotal']);
	$TMPL['tracksize'] = fsize($settings['tracksize']);
	$TMPL['tracksizetotal'] = fsize($settings['tracksizetotal']);
	$TMPL['promonth'] = $settings['promonth'];
	$TMPL['proyear'] = $settings['proyear'];
	$TMPL['currency'] = $settings['currency'];
	
	$rows = $skin->make();
	
	$TMPL = $TMPL_old; unset($TMPL_old);
	$TMPL['rows'] = $rows;

	$TMPL['url'] = $CONF['url'];
	$TMPL['title'] = $LNG['go_pro'].' - '.$settings['title'];
	$TMPL['meta_description'] = $settings['title'].' '.$LNG['go_pro'].' - '.$LNG['go_pro_desc'];

	$skin = new skin('pro/content');
	return $skin->make();
}
?>