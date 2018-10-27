var button = document.getElementById("button");
var red_btn = "data/img/red/red.jpg";
var green_btn = "data/img/green/green.jpg";

function change_pin(gpio_pin) {
	if (!button.src.includes(green_btn)) {
		console.log("Ne pritisci kad sam crven!");
		return;
	}
	if (confirm('Sigurno ?')) {		
		button.src = red_btn;		
		send_req(gpio_pin);
	}

	return 0;
}

function send_req(gpio_pin) {
	var request = new XMLHttpRequest();
	request.open("GET", "gpio.php?pic=" + gpio_pin, true);
	request.send(null);
	//receiving informations
	request.onreadystatechange = function () {
		if (request.readyState == 4 && request.status == 200) {
			data = request.responseText;
			//update the index pic
			if ( data == "1" || data == "0") {							
				button.src = green_btn;
				document.body.style.background = 'gray';	
			}
			else if (!(data.localeCompare("fail"))) {
				alert("Something went wrong!");
				return ("fail");
			}
			else {
				alert("Something went wrong!");
				return ("fail");
			}
		}
		//test if fail
		else if (request.readyState == 4 && request.status == 500) {
			alert("server error");
			return ("fail");
		}
		//else 
		else if (request.readyState == 4 && request.status != 200 && request.status != 500) {
			alert("Something went wrong!");
			return ("fail");
		}
	}
}