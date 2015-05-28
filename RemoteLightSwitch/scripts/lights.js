
function lightOff() {
        var result = $.get("./scripts/lightOff.php");
//        alert("Light is Off!");

        return false;
} 

function lightOn() {
	var result = $.get("./scripts/lightOn.php");
//	alert("Light is On!");

        return false;
} 
