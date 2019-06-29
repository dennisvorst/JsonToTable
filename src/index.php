<?php 
require_once "class/jsonElement.php";
?>
<!-- 
* a JSON structure is a key value pair
* the key kan be of type integer or type string 
* a value can be a string or an array (or a collection of key value pairs)


-->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Json Objects</title>
  </head>
  <body>
<?php

$url = 'api-docs.json'; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable


echo jsonToDebug($data);

function jsonToDebug($jsonText) : string
{
    $arr = json_decode($jsonText, true);
    $html = "";
    if ($arr && is_array($arr)) {
        $html .= createTable($arr, getHeaders($arr));
    }
    return $html;
}

function createTable(array $arr, array $headers) : string 
{
	/* init */
	$str = "";

	/* collect */

	/* create html */


	$str = "<!-- start table -->\n";
	$str .= "<table class='table'>\n";
	$str .= " <thead>\n";
	$str .= "  <tr>\n";
	foreach ($headers as $header)
	{
		$str .= "   <td>" . $header . "</td>\n";
	}
	$str .= "  </tr>\n";
	$str .= " </thead>\n";
	$str .= " <tbody>\n";

	foreach ($arr as $key => $val) {
		$str .= "  <tr>\n";
		$str .= "   <td>$key</td>\n";
		$str .= "   <td>";
		if (is_array($val)) {
			if (!empty($val)) {
				$str .= createTable($val, getHeaders($val));
			}
		} else {
			$str .= "<strong>$val</strong>";
		}
		$str .= "    </td>\n";
		$str .= "   </tr>\n";
	}
	$str .= " </tbody>\n";
	$str .= "</table>\n";
	$str .= "<!-- end table -->\n";

    return $str;
}

function getHeaders($arr)
{
	/**
	find if the properties of the values are the same
	*/
	$headers = [];
	if (is_array($arr))
	{
		foreach ($arr as $key => $val) {
			if (is_array($val) && count($val) > 0) 
			{
				$headers = array_keys($val);
				foreach ($val as $item)
				{
					if (is_array($item) && $headers !== array_keys($item))
					{
						$headers = null;
						break;
					}
				}
			}
		}
	}
	if (empty($headers)) 
	{
		$headers = ["Key", "Value"];
	}
	print_r($headers);
	print_r("</br>");
	return $headers;
}

?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
