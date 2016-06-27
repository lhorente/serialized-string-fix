<?php
	// error_reporting(E_ALL);
	// ini_set('display_errors', 1);
	// echo "<pre>";
	
	if (isset($_GET['corrupted']) && $_GET['corrupted']){
		$new_string = "";
		$find_clean = "http://novosite";
		$find = str_replace("/","\\/",$find_clean);
		$replace_clean = "http://www.sitetestelocal.com.br";
		$replace = str_replace("/","\\/",$replace_clean);

		$qtds = array();
		$string = $_GET['corrupted'];
		$patt = '/s:([0-9]*):\"(.*?)"/';
		preg_match_all($patt,$string,$matches);
		if ($matches && $matches[2]){
			foreach ($matches[2] as $i=>$m){
				$qtd = strlen($m);
				$qtds[] = $qtd;
				
				$patt_replace = 's:%s:"$2"';
				
				$new_string = preg_replace($patt,$patt_replace,$string);
			}
		}
		
		$new_string = vsprintf($new_string,$qtds);
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Fix Corruped String Count in Serialized Data</title>
	</head>
	<body>
		<form method="get">
			<label>Corrupted</label>
			<textarea name="corrupted" style="width:600px;height:300px;"><?php echo $string ?></textarea>
			<br />
			<label>Fixed</label>
			<textarea name="fixed" style="width:600px;height:300px;"><?php echo $new_string ?></textarea>
			<button type="submit">Send</button>
		</form>
	</body>
</html>