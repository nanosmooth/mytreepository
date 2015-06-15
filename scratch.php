<div class="row">
<div class="tile pad"></div>
<div class="tile connector"><div class="content"><img src="img_data/vconnect.png" class='bg'/></div></div>
</div>

<div class="row">
<div class="tile pad"></div>
<div class="tile connector"><div class="content"><img src="img_data/sconnect.png" class='bg'/></div></div>
<div class="tile person"><div class="content"><?php profile_image_128();?></div><div class="name">Tejus</div></div>
<div class="tile connector"><div class="content"><img src="img_data/hconnect.png" class='bg'/></div></div>
<div class="tile person"></div>
</div>

<div class="row">
<div class="tile pad"></div>
<div class="tile connector"><div class="content"><img src="img_data/vconnect.png" class='bg'/></div></div>
</div>

<div class="row">
<div class="tile pad"></div>
<div class="tile connector"><div class="content"><img src="img_data/lconnect.png" class='bg'/></div></div>
<div class="tile person"></div>
</div>
</div>
</div>

-------

<div class="row">
<div class="tile person"><div class="content" id="add_mother"><div class="table"><div class="table-cell">+ Mother</div></div></div></div>
<div class="tile connector"><div class="content"><img src="img_data/tconnectt.png" class='bg'/></div></div>
<div class="tile person"></div>
</div>

<div class="row">
<div class="tile pad"></div>
<div class="tile connector"></div>
</div>

<div class="row">
<div class="tile pad"></div>
<div class="tile connector"></div>
<div class="tile person"><div class="content"><div class="table"><div class="table-cell"><?php profile_image_128();?></div></div></div><div class="name"><?php print ucfirst($fname);?></div></div>
<div class="tile connector"></div>
<div class="tile person"></div>
</div>

<div class="row">
<div class="tile pad"></div>
<div class="tile connector"></div>
</div>

<div class="row">
<div class="tile pad"></div>
<div class="tile connector"></div>
<div class="tile person"></div>
</div>
</div>
</div>


------------

function Create_Family_Layout($ns,$sp,$nk)
{
	/*
	 ns:number of siblings
	 sp:spouse Y / N
	 nk:number of kids
	 */
	if($sp=='N')$nk=0;
	//nocr:no of "only connector rows"
	$nocr=max($ns,$nk)+2;
	$i=0;
	$vconnect_left=<<<EOD
<div class="row">
<div class="tile pad"></div>
<div class="tile connector"><div class="content"><img src="img_data/vconnectt.png" class='bg'/></div></div>
</div>
EOD;
	$vconnect_right=<<<EOD
<div class="row">
<div class="tile pad"></div>
<div class="tile pad"></div>
<div class="tile pad"></div>
<div class="tile connector"><div class="content"><img src="img_data/vconnectt.png" class='bg'/></div></div>
</div>
EOD;
	$vconnect_both=<<<EOD
<div class="row">
<div class="tile pad"></div>
<div class="tile connector"><div class="content"><img src="img_data/vconnectt.png" class='bg'/></div></div>
<div class="tile pad"></div>
<div class="tile connector"><div class="content"><img src="img_data/vconnectt.png" class='bg'/></div></div>
</div>
EOD;
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
			if($i<=$nk+1 && $i<=$ns+1){$o_c_row[$i]=$vconnect_both;}
			else if($i>$nk+1 && $ns>$nk){$o_c_row[$i]=$vconnect_right;}
			else if($i<=$nk+1 && $i>$ns+1){$o_c_row[$i]=$vconnect_right;}
			else if($i>$nk+1 && $i<=$ns+1){$o_c_row[$i]=$vconnect_left;}
		}
		$i++;
	}
for ($i=0;$i<$nocr;$i++)
{
	 print $o_c_row[$i];
}
}

------------

<div class="row">
<div class="tile person"><div class="content" id="add_mother"><div class="table"><div class="table-cell">+ Mother</div></div></div></div>
<div class="tile connector"><div class="content"><img src="img_data/tconnectt.png" class='bg'/></div></div>
<div class="tile person"></div>
</div>

<div class="row">
<div class="tile pad"></div>
<div class="tile connector"></div>
</div>

<div class="row">
<div class="tile pad"></div>
<div class="tile connector"></div>
<div class="tile person"><div class="content"><div class="table"><div class="table-cell"><?php profile_image_128();?></div></div></div><div class="name"><?php print ucfirst($fname);?></div></div>
<div class="tile connector"></div>
<div class="tile person"></div>
</div>

<div class="row">
<div class="tile pad"></div>
<div class="tile connector"></div>
</div>

<div class="row">
<div class="tile pad"></div>
<div class="tile connector"></div>
<div class="tile person"></div>
</div>