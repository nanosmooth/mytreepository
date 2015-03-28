window.onload = function(){
    var select_month = document.getElementById("dob_month");
	var options = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    for (var i = 0; i < options.length; i++) {
        var opt = options[i];
        var el = document.createElement("option");
        el.innerText = opt;
		el.text=opt;
        el.value = i+1;
        select_month.appendChild(el);
    }
	var select_day = document.getElementById("dob_day");
	var options = ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"];
	for (var i = 0; i < options.length; i++) {
        var opt = options[i];
        var el = document.createElement("option");
        el.innerText = opt;
		el.text = opt;
        el.value = opt;
        select_day.appendChild(el);
    }
	var select_year = document.getElementById("dob_year");
	var curr_year=new Date();
	curr_year=curr_year.getFullYear();
	old_year=curr_year-109;
	for(var i=curr_year;i>=old_year;i--){
		var opt=i;
		var el=document.createElement("option");
		el.innerText=opt;
		el.text = opt;
		el.value=opt;
		select_year.appendChild(el);
	}
}