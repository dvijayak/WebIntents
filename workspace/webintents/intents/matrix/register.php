<?php

	// header('Content-Type: application/json');

	// From the PHP manual: php://input is a read-only stream that allows you to read raw data from the request body.
	// Thus, we have to manually read it from the stream
	$intentObject = json_decode(file_get_contents("php://input"));

	// Post to CouchDB
	// echo $intentObject->action;

	// Update indents entries	
	$doc = new DOMDocument();
	$html = $intentObject->_attachments;
	$doc->loadHTML($html);

	$head = $doc->getElementsByTagName('head');	

	// Create the intent DOM element and append it to the HEAD element
	foreach ($head as $element) {
		$intentElement = $doc->createElement('intent');

		$intentElement->setAttribute('action', $intentObject->action);
		$intentElement->setAttribute('type', $intentObject->type);
		$intentElement->setAttribute('href', $intentObject->href);
		$intentElement->setAttribute('title', $intentObject->title);
		$intentElement->setAttribute('disposition', $intentObject->disposition);

		$element->appendChild($intentElement);

		// Should be only done one as there is only one HEAD element
		break;
	}

	$doc->saveHTMLFile('test'.'.html');

?>