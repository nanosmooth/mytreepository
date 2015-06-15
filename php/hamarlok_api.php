<?php
function profile_image_32()
{
	if(isset($_SESSION['fb_id']))
	{
		$fb_id=$_SESSION['fb_id'];
		echo "<img src='http://graph.facebook.com/$fb_id/picture?redirect=1&height=64&width=64' class='nav-pic'/>";
	}
	else
	{
		echo "<span class='glyphicon glyphicon-user nav-pic' aria-hidden='true'></span>";
	}  	
}	

function profile_image_128()
{
	if(isset($_SESSION['fb_id']))
	{
		$fb_id=$_SESSION['fb_id'];
		echo "<img src='http://graph.facebook.com/$fb_id/picture?redirect=1&height=200&width=200' class='rs'/>";
	}
	else
	{
		echo "<span class='glyphicon glyphicon-user' aria-hidden='true'></span>";
	}
}

function Create_Family_Layout($ns,$sp,$nk)
{
	/*
	 ns:number of siblings
	 sp:spouse Y / N
	 nk:number of kids
	 */
	if($sp=='N')$nk=0;
//nocr:no of "only connector rows"
//Family connector rows
	$nocr=max($ns,$nk)+2;
	$i=0;
$rowstart='<div class="row">';
$pad='<div class="tile pad"></div>';
$rowend='</div>';
$vconnect='<div class="tile connector"><div class="content"><img src="img_data/vconnectt.png" class="bg"/></div></div>';

//only connector definitions
$vconnect_left=$rowstart.$pad.$vconnect.$rowend;
$vconnect_right=$rowstart.$pad.$pad.$pad.$vconnect.$rowend;
$vconnect_both=$rowstart.$pad.$vconnect.$pad.$vconnect.$rowend;


	while($i<$nocr)
	{
		if($i==0)$o_c_row[$i]=$vconnect_left;
		else if($i==($nocr-1))
		{
			if($sp=='N')$o_c_row[$i]=$vconnect_left;
			else if($sp=='Y' && $nk==$ns)$o_c_row[$i]=$vconnect_both;
			else if($sp=='Y' && $nk>$ns)$o_c_row[$i]=$vconnect_right;
			else if($sp=='Y' && $ns>$nk)$o_c_row[$i]=$vconnect_left;
			break;
		}
		else
		{
			if($i<=$nk+1 && $i<=$ns+1 && $sp=='Y'){$o_c_row[$i]=$vconnect_both;}
			else if($i<=$nk+1 && $i<=$ns+1 && $sp=='N'){$o_c_row[$i]=$vconnect_left;}
			else if($i>$nk+1 && $ns>$nk){$o_c_row[$i]=$vconnect_left;}
			else if($i<=$nk+1 && $i>$ns+1){$o_c_row[$i]=$vconnect_right;}
			else if($i>$nk+1 && $i<=$ns+1){$o_c_row[$i]=$vconnect_left;}
		}
		$i++;
	}
	
//Family Person Rows
$person='<div class="tile person"></div>';
$mother='<div class="tile person"><div class="content" id="add_mother"><div class="table"><div class="table-cell">+ Mother</div></div></div></div>';
$tconnect='<div class="tile connector"><div class="content"><img src="img_data/tconnectt.png" class="bg"/></div></div>';
$sconnect='<div class="tile connector"><div class="content"><img src="img_data/sconnectt.png" class="bg"/></div></div>';
$hconnect='<div class="tile connector"><div class="content"><img src="img_data/hconnectt.png" class="bg"/></div></div>';
$lconnect='<div class="tile connector"><div class="content"><img src="img_data/lconnectt.png" class="bg"/></div></div>';

$parent_row=$rowstart.$mother.$tconnect.$person.$rowend;
$me_sp_kid_row=$rowstart.$pad.$sconnect.$person.$tconnect.$person.$rowend;
$me_sp_row=$rowstart.$pad.$sconnect.$person.$hconnect.$person.$rowend;
$last_only_sib_row=$rowstart.$pad.$lconnect.$person.$rowend;
$last_only_kid_row=$rowstart.$pad.$pad.$pad.$lconnect.$person.$rowend;
$last_both_row=$rowstart.$pad.$lconnect.$person.$lconnect.$rowend;
$im_more_kids_row=$rowstart.$pad.$lconnect.$person.$sconnect.$person.$rowend;
$im_both_row=$rowstart.$pad.$sconnect.$person.$sconnect.$person.$rowend;
$im_more_sibs_row=$rowstart.$pad.$sconnect.$person.$lconnect.$person.$rowend;
$im_only_kid_row=$rowstart.$pad.$pad.$pad.$sconnect.$person.$rowend;
$im_only_sib_row=$rowstart.$pad.$sconnect.$person.$rowend;
$i=0;
// layout logic
$nor=$nocr+1;
while($i<$nor)
{
	if($i==0)
	{
		$row[$i]=$parent_row;
	}
	else if($i==1)
	{
		if($sp=='N')$row[$i]=$me_sp_row;
		else $row[$i]=$me_sp_kid_row;
	}
	else if($i==$nor-1)
	{
		if($i==$ns+2 && $i==$nk+2 && $sp=='Y')
			$row[$i]=$last_both_row;
		else if($i==$ns+2)
			$row[$i]=$last_only_sib_row;
		else 
			$row[$i]=$last_only_kid_row;
	} 
	else 
	{
		if($i==$ns+2 && $nk>$ns)
			$row[$i]=$im_more_kids_row;
		else if($i==$nk+2 && $ns>$nk && $sp=='N')
			$row[$i]=$im_only_sib_row;
		else if($i==$nk+2 && $ns>$nk)
			$row[$i]=$im_more_sibs_row;
		else if($i<=$nk+1 && $i<=$ns+1)
			$row[$i]=$im_both_row;
		else if($nk > $ns)
			$row[$i]=$im_only_kid_row;
		else 
			$row[$i]=$im_only_sib_row;
	}
	$i++;
}

for ($i=0;$i<$nocr;$i++)
{
	 print $row[$i];
	 print $o_c_row[$i];
}  
print $row[$i];
}
?>