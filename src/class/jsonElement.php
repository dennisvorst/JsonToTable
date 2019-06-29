<?php
class jsonElement{
	var $_key;
	var $_value;

	var $_elementCollection = [];
	var $_headerCollection = ["Key", "Value"];

	function __construct(array $collection)
	{
		$this->_key = array_keys($collection)[0];

		if (is_array($collection[$this->_key])) 
		{
			foreach ($collection[$this->_key] as $item)
			{
				$this->_elementCollection[] = new jsonElement($item);
			}
		} else {
		}
	
//		print_r($collection[$this->_key]);
//		print_r("</br></br>");

	}

	function createTable() : string 
	{
		$html = "";
		if (!empty($this->_key))
		{
			$html = "<h1>" . $this->_key . "</h1>";
		}

		/* does the array contain any values? */
		if(count($this->_elementCollection) > 0)
		{
			$html = "<table class='table'>\n";
			$html .= " <thead>\n";
			$html .= "  <tr>\n";
			$headers = $this->_getHeaders();
			print_r($headers);
			foreach ($headers_headerCollection as $header)
			{
				$html .= "   <th>" . $header . "</th>\n";
			}
			$html .= "  </tr>\n";
			$html .= " </thead>\n";
			$html .= " <tbody>\n";	

			foreach ($this->_elementCollection as $item)
			{
				$html .= $item->_getTableRow();
			}

			$html .= " </tbody>\n";
			$html .= "</table>\n";
		}

		return $html;
	}

	function _getTableRow() : string
	{
		$html = "<tr>\n";
		$html .= "<td>" . $this->_key . "</td>";
		if (count($this->_elementCollection) > 0)
		{
			$html .= "<td>somevalue</td>\n";
		
		} else {
			$html .= "<td>" . $this->_value . "</td>\n";
		}
		$html .= "</tr>\n";

		return $html;
	}

	function _getHeaders() : array 
	{
		$headers = [];
		foreach ($this->_elementCollection as $element)
		{
			$headers[] = $element->getKey();
		}
		return $headers;
	}
	function getValue(){}
	function getKey() : string 
	{
		return $this->_key;
	}
}

?>