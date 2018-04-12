<?php
//download json from reddit
function rip_sub($sub){
	$string = file_get_contents("http://www.reddit.com/r/" . $sub . "/.json");
	$subjson = json_decode($string, true);
	$len = sizeof($subjson['data']['children']);
	$shit = array();
	for($i = 0;$i < $len;$i++){
		$post = $subjson['data']['children'][$i];
		if($post['data']['score'] == 0 || $post['data']['over_18'] == true || $post['data']['thumbnail'] == "self")continue;
		$shit[$i]['score'] =  $post['data']['score'];
		$shit[$i]['thumbnail'] = $post['data']['thumbnail'];
	}
	return $shit;
}
function print_sub($sub){
	$data = rip_sub($sub);
	echo "<h2>" . $sub . "</h2>";
	foreach($data as $post){
		echo "<b>" . $post['score'] . "</b><br>";
		echo "<img src=\"" . $post['thumbnail'] . "\" style=\"width:75px;height:75px\">";
		echo "<br>";
	}
}
echo "<style> table, th, td { \n border: 1px solid black;padding:15px;text-align:center;\n}</style>";
echo "<table>";
echo "<tr><td>";
print_sub("dankmemes");
echo "</td>";
echo "<td>";
print_sub("deepfriedmemes");
echo "</td>";
echo "<td>";
print_sub("me_irl");
echo "</td>";
echo "<td>";
print_sub("2meirl4meirl");
echo "</td></tr>";
echo "</table>";
?>
