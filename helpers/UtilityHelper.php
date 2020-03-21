<?php

require_once('LoadChunk.php');

class UtilityHelper
{
	public function ErrorResponse($msg)
	{
		header('HTTP/1.1 400 Bad Request');
		print_r($msg);
		exit();
	}

	public function printResponse($type, $errMsg = '')
	{
		global $xpdo;

		$response = array('success' => $type, 'error' => $errMsg);
		$response = $xpdo->toJSON($response);
		header('Content-type: application/json');
		echo $response;
	}

	public static function Response($type, $message)
	{
		if (empty($type) || empty($message)) {
			header('HTTP/1.1 400 Request Error');
			exit('Empty argument(s) was/were provided.');
		}

		$type = strtolower($type);

		if ($type !== 'success' && $type !== 'error') {
			header('HTTP/1.1 400 Request Error');
			exit('Unknown message type was provided.');
		}

		$res = ($type == 'success') ? 1 : 0;

		return json_encode(array('res' => $res, 'message' => $message));
	}

	public function printJSONData($type, $data = array())
	{
		global $xpdo;
		
		$response = array('type' => $type, 'data' => $data);
		$response = $xpdo->toJSON($response);
		header('Content-type: application/json');
		echo $response;
	}

	public function collectionToJSON($collection)
	{
		/**
		 * [ denotes an array
		 * { denotes an object
		 *
		 */
		if (!empty($collection))
		{
			$o = '[';
			$c = 0;
			foreach ($collection as $obj)
			{
				$o .= ($c++ > 0) ? ', ' : '';
				$o .= $obj->toJSON();
			}
			$o .= ']';
		}
		return ($o) ? $o : 0;
	}

	public static function RedirectTo($url = '')
	{
		if (!empty($url))
		{
			header("Location: {$url}");
			exit();
		}
	}

	public function TimeDifference($time)
	{
		// Set SQL server time offset and Cairo time zone
		$sqlServerOffset   = -5;
		$sqlServerTimezone = timezone_name_from_abbr('', $sqlServerOffset * 3600, FALSE);
		$sqlTimezone       = new DateTimeZone($sqlServerTimezone);
		$currTimeZone      = new DateTimeZone('Africa/Cairo');

		// Specified time
		$timeObj = new DateTime($time, $sqlTimezone);
		$timeObj->setTimezone($currTimeZone);

		// Current time
		$now = new DateTime('now', $currTimeZone);

		// Time difference
		$difference = $now->diff($timeObj);

		// Format time difference
		$doPlural = function($nb, $str) { return $nb > 1 ? $str . 's' : $str; }; // adds plurals

		$format = array();

		if ($difference->y !== 0)
		{
			$format[] = "%y ".$doPlural($difference->y, "year"); 
		}

		if ($difference->m !== 0)
		{
			$format[] = "%m ".$doPlural($difference->m, "month");
		}

		if ($difference->d !== 0)
		{
			$format[] = "%d ".$doPlural($difference->d, "day");
		}

		if ($difference->h !== 0)
		{
			$format[] = "%h ".$doPlural($difference->h, "hour");
		}

		if ($difference->i !== 0)
		{
			$format[] = "%i ".$doPlural($difference->i, "minute");
	    }

	    if ($difference->s !== 0)
	    {
	    	if (!count($format))
	    	{
	    		return "less than a minute ago";
	    	}
	    	else
	    	{
	    		$format[] = "%s ".$doPlural($difference->s, "second");
	    	}
	    } 
		    
		// We use the two biggest parts 
		if (count($format) > 1)
		{
			$format = array_shift($format) . " and " . array_shift($format); 
		}
		else
		{
			$format = array_pop($format); 
		}

		// Prepend 'since ' or whatever you like 
		return $difference->format($format . ' ago');
	}
}