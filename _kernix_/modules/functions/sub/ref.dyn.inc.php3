<?php

function get_ref_output($str) {
	$params = explode("@@", $str);
	foreach ($params as $key => $value) {
		$pos = strpos($value, ":");
		$obj[substr($value, 0, $pos)] = substr($value, ($pos+1));
	}
	//print_r($obj);
	$out = $start = $end = '';
	if (isset($obj['type'])) {
		if (($obj['type']=='a' || $obj['type']=='img') || $obj['type']=='font') {
			// start -----------------------------------
			$start .= "<".$obj['type'];
			if ($obj['type']=='a') {
				if (isset($obj['url'])) {
					$start .= " href='".$obj['url']."'";
				}
				if (isset($obj['target'])) {
					$start .= " target='".$obj['target']."'";
				}
			}
			if ($obj['type']=='img') {
				if (isset($obj['src'])) {
					$start .= " src='".$obj['src']."'";
				}
				if (isset($obj['width'])) {
					$start .= " width='".$obj['width']."'";
				}
				if (isset($obj['height'])) {
					$start .= " height='".$obj['height']."'";
				}
				if (isset($obj['map'])) {
					$start .= " usemap='#".$obj['map']."'";
				}
			}
			if (isset($obj['alt'])) {
				$start .= " alt='".$obj['alt']."'";
			}
			if (isset($obj['title'])) {
				$start .= " title='".$obj['title']."'";
			}
			if (isset($obj['class'])) {
				$start .= " class='".$obj['class']."'";
			}
			if (isset($obj['style'])) {
				$start .= " style='".$obj['style']."'";
			}
			$start .= ">";
			// end -------------------------------------
			if ($obj['type']=='font' || $obj['type']=='a') {
				if (isset($obj['text'])) {
					$end = $obj['text']."</".$obj['type'].">";
				} else {
					print("error: element 'text' is not setted.\n");
				}
			}
			// -----------------------------------------
		} else {
			print("error: element 'type' is not valid.\n");
		}
	} else {
		print("error: element 'type' is not setted.\n");
	}
	$out = $start.$end;		
	return($out);
}

?>
