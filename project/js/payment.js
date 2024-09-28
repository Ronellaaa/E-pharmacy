//confirm button
function message(){
	var checkcash= document.getElementById("checkbox1");
	var checkonline= document.getElementById("checkbox");
	if (checkcash.checked == true){
		alert("Your choice is recorded..");
	}
	if (checkonline.checked == true){
		alert("Payment is completed..");
	}

    
}
//enableinputs to enter the card ddetails if the online transfer checkbox has selected
function enableinputs(){
    var checkbox= document.getElementById("checkbox");
	if (checkbox.checked == true)
	{
		document.getElementById("cname").disabled= false;
        document.getElementById("ccnum").disabled= false;
        document.getElementById("expmonth").disabled= false;
	}
	else{
		document.getElementById("cname").disabled= true;
        document.getElementById("ccnum").disabled= true;
        document.getElementById("expmonth").disabled= true;
	}
}