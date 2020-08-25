<?
	$sector=array(162,18,73,107);
	$img=imagecreatetruecolor(200,200);
	if (!$img) exit();
	$white=imagecolorallocate($img,255,255,255);
	imagefill($img,1,1,$white);
	$background=imagecolorallocate($img,255,255,255);
	$cx=$cy=100;
	$w=$h=150;
	imagefilledellipse($img,$cx,$cy,$w,$h,$background);
	$start=0;
	foreach($sector as $value)
	{
		$angle_sector=$start+$value;
		$color=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
		$start+=$value;
	}
	imagepng($img);
?>