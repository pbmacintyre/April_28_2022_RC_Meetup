/**
 * Copyright (C) 2021 Paladin Business Solutions
 *
 */ 

function reveal_it() {
	var w = document.getElementById("myClientSecret");
	var x = document.getElementById("myRCPassword");    
	var y = document.getElementById("myGRCSite");    
    var z = document.getElementById("myGRCSecret");    
	
    if (w.type === "password") {
	  w.type = "text";
	} 
	if (x.type === "password") {
	  x.type = "text";
	}
	if (y.type === "password") {
	  y.type = "text";
	}
	if (z.type === "password") {
	  z.type = "text";
	}
}

function hide_it() {
	var w = document.getElementById("myClientSecret");
	var x = document.getElementById("myRCPassword");    
    var y = document.getElementById("myGRCSite");  
    var z = document.getElementById("myGRCSecret");
	
    if (w.type === "text") {	  
	  w.type = "password";
	}
	if (x.type === "text") {
	  x.type = "password";
	}
	if (y.type === "text") {
	  y.type = "password";
	}
	if (z.type === "text") {
	  z.type = "password";
	}
}