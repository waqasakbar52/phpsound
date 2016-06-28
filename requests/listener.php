<?phpinclude("../includes/config.php");session_start();if($_POST['token_id'] != $_SESSION['token_id']) {	return false;}include("../includes/classes.php");include(getLanguage(null, (!empty($_GET['lang']) ? $_GET['lang'] : $_COOKIE['lang']), 2));$db = new mysqli($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);if ($db->connect_errno) {    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;}$db->set_charset("utf8");$resultSettings = $db->query(getSettings());$settings = $resultSettings->fetch_assoc();// Turn on or off the debugging$debug = 0; // // Define the sandbox$sandbox = ($settings['paypalsand'] ? 1 : 0);// IPN log file$logfile = './ipn.log';// PayPal request urlif($sandbox) {	$paypalurl = "https://www.sandbox.paypal.com/cgi-bin/webscr";} else {	$paypalurl = "https://www.paypal.com/cgi-bin/webscr";}
if($_POST) {
	$req = 'cmd='.urlencode('_notify-validate');
	foreach($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$req .= "&$key=$value";
	}
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $paypalurl);	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_HEADER, 0);	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);	if($debug) {		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 	} else {
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	}	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www'.$sandbox.'.sandbox.paypal.com'));
	$res = curl_exec($ch);
		// cURL error	if(curl_errno($ch) != 0) {		if($debug) {				error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, $logfile);		}		curl_close($ch);	} else {		// Log the entire HTTP response if debug is switched on.		if($debug) {			error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, $logfile);			error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, $logfile);			// Split response headers and payload			list($headers, $res) = explode("\r\n\r\n", $res, 2);		}		curl_close($ch);	}	
	if(strcmp($res, "VERIFIED") == 0) {
		$transaction_id = $_POST['txn_id'];
		$payerid = $_POST['payer_id'];
		$firstname = $_POST['first_name'];
		$lastname = $_POST['last_name'];
		$payeremail = $_POST['payer_email'];
		$paymentdate = $_POST['payment_date'];
		$paymentstatus = $_POST['payment_status'];		$parent_txn_id = $_POST['parent_txn_id'];
		$mdate= date('Y-m-d h:i:s',strtotime($paymentdate));				$managePayments = new managePayments();		$managePayments->db = $db;		$managePayments->url = $CONF['url'];		$managePayments->per_page = $settings['rperpage'];				// Payment Status Codes: https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNandPDTVariables/#id091EB04C0HS__id0913D0E0UQU		// Set the new Payment Status whenever it changes		if($paymentstatus == 'Canceled_Reversal') {			$managePayments->updatePayment($parent_txn_id, 1);		} elseif($paymentstatus == 'Reversed') {			$managePayments->updatePayment($parent_txn_id, 2);		} elseif($paymentstatus == 'Refunded') {			$managePayments->updatePayment($parent_txn_id, 3);		} elseif($paymentstatus == 'Pending') {			$managePayments->updatePayment($parent_txn_id, 4);		} elseif($paymentstatus == 'Failed') {			$managePayments->updatePayment($parent_txn_id, 5);		} elseif($paymentstatus == 'Denied') {			$managePayments->updatePayment($parent_txn_id, 6);		}				if($debug) {			$res = print_r($_POST, true);			error_log(date('[Y-m-d H:i e] '). "Verified IPN: $res ". PHP_EOL, 3, $logfile);		}	} elseif(strcmp($res, "INVALID") == 0) {		// log for manual investigation		// Add business logic here which deals with invalid IPN messages		if($debug) {			error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, $logfile);		}	}
}mysqli_close($db);
?>