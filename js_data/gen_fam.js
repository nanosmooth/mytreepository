var famwidth=$('#familyfield').width();
$('#familyfield').css({'height':famwidth+'px'});


var mother=$('<div class="person"  id="mother"><div class="name"></div></div>')
var father=$('<div class="person"  id="father"><div class="name"></div></div>')
var user=$('<div class="person"    id="user"><div class="name"></div></div>')
var sibling=$('<div class="person" id="sibling"><div class="name"></div></div>')
var spouse=$('<div class="person"  id="spouse"><div class="name"></div></div>')
var kid=$('<div class="person"     id="kid"><div class="name"></div></div>')

var xf=20;

$('#familyfield').append(mother);
$('#familyfield').append(father);
$('#familyfield').append(user);
$('#familyfield').append(sibling);
$('#familyfield').append(spouse);
$('#familyfield').append(kid);

$('#mother').css({
	'top':0*xf+'%',
	'left':0*xf+'%',
	'width':'20%'
	});
var perwidth=$('#mother').width();
$('#mother').css({
	'height':perwidth+'px'
	});

$('#father').css({
	'top':0*xf+'%',
	'left':2*xf+'%',
	'width':perwidth+'px',
	'height':perwidth+'px'
	});

$('#user').css({
	'top':2*xf+'%',
	'left':2*xf+'%',
	'width':perwidth+'px',
	'height':perwidth+'px'
	});

$('#sibling').css({
	'top':4*xf+'%',
	'left':2*xf+'%',
	'width':perwidth+'px',
	'height':perwidth+'px'
	});

$('#spouse').css({
	'top':2*xf+'%',
	'left':4*xf+'%',
	'width':perwidth+'px',
	'height':perwidth+'px'
	});

$('#kid').css({
	'top':4*xf+'%',
	'left':4*xf+'%',
	'width':perwidth+'px',
	'height':perwidth+'px'
	});

jQuery(function($){
	var windowWidth = $(window).width();

	$(window).resize(function() {
	    if(windowWidth != $(window).width()){
	    //location.reload();
	    	
	    	
	    return;
	    }
	});
	});