 <?php  
//REMOVE OS ACENTOS SEM PROBLEMAS DE ENCODES 
  //$enc pode ser [iso-8859-1/UTF-8/etc..] 
  function RemoveAcentos($str, $enc = 'iso-8859-1'){ 

    $acentos = array( 
        'A' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/', 
        'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/', 
        'C' => '/&Ccedil;/', 
        'c' => '/&ccedil;/', 
        'E' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/', 
        'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/', 
        'I' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/', 
        'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/', 
        'N' => '/&Ntilde;/', 
        'n' => '/&ntilde;/', 
        'O' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/', 
        'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/', 
        'U' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/', 
        'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/', 
        'Y' => '/&Yacute;/', 
        'y' => '/&yacute;|&yuml;/', 
        'a.' => '/&ordf;/', 
        'o.' => '/&ordm;/', 
    ); 
	$str = str_replace(" ","-",$str); // retira espaco
	$str = preg_replace('/\(|\)|/','',$str);
	 
	
      return preg_replace($acentos, array_keys($acentos), htmlentities($str,ENT_NOQUOTES, $enc)); 
  } 
 ?>
 
