<html>

	<head>
		<meta charset="utf8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<link rel="stylesheet" href="index.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans|Open+Sans+Condensed:300|Roboto" rel="stylesheet"> 
		<link href='https://fonts.googleapis.com/css?family=Ek+Mukta:300' rel='stylesheet' type='text/css'>

		<script type="text/javascript">
			var totalTouchDuration = 0;

var tapCounter=0;
var startTap=0, endTap=0;
var tapLogsArray=[];

var tapLimit = 50;
var uniqueIdentifier=0;
var d;
var dependentVariable="";

var showFeedback = false;
var interfaceVariations = 2;
var interfaceSequence = 1;

function onLoad(){
    var el = document.getElementById('tapHere');
    d = new Date();

    if(d.getTime()%2 ==0){
        showFeedback=true;
    }

    uniqueIdentifier = d.getTime() + "" + Math.floor(Math.random() * 42);

    ["mouseup","mousedown","touchstart","touchend"].forEach(function(te) {
        el.addEventListener(te, tapityTap);
    });
}

function saveDependentVariable(dVariable){
    dependentVariable = dVariable;
    document.getElementById("buttoncontainer").style.display = "none";
    document.getElementById("container").style.display = "inline-block";
}

function syncToServer(){

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            console.log("Server response:", this.responseText);

            if (this.status == 200 && this.responseText === "Data saved successfully") {
                document.getElementById("counter").innerHTML += "<br>✅ Data saved!";
            } else {
                document.getElementById("container").innerHTML =
                    '<span class="spanWhite">❌ Error saving data</span>';
            }
        }
    };

    var params = "id=" + encodeURIComponent(uniqueIdentifier) +
                 "&var=" + encodeURIComponent(dependentVariable) +
                 "&taps=" + encodeURIComponent(JSON.stringify(tapLogsArray));

    xmlhttp.open("POST", "saveTaps.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xmlhttp.send(params);
}

function tapityTap(tep){

    d = new Date();
    var te = tep.type;

    switch(te){

        case "touchstart":
        case "mousedown":
            startTap = d.getTime();
            break;

        case "touchend":
        case "mouseup":
            endTap = d.getTime();

            if(startTap > 0 && endTap > startTap){

                var tap = {
                    tapSequenceNumber: ++tapCounter,
                    startTimestamp: startTap,
                    endTimestamp: endTap,
                    interfaceSequence: interfaceSequence,
                    interface: showFeedback ? "feedbackshown" : "nofeedback"
                };

                tapLogsArray.push(tap);

                console.log("Tap:", tap);

                if(tapCounter >= tapLimit){

                    interfaceSequence++;

                    if(interfaceSequence <= interfaceVariations){

                        document.getElementById("continue").style.display="block";
                        document.getElementById("tapHere").style.display="none";

                    } else {
                        document.getElementById("tapHere").style.display="none";
                        syncToServer(); // ✅ NOW IT WILL ACTUALLY RUN
                    }
                    return;
                }
            }

            startTap = 0;
            endTap = 0;
            break;
    }
}

function startNext(){
     startTap = 0;
    endTap = 0;
    tapCounter = 0;
    totalTouchDuration = 0;

    document.getElementById("tapHere").style.display="block";
    document.getElementById("continue").style.display="none";
    document.getElementById("counter").innerHTML="";

    showFeedback = !showFeedback;
}

		</script>

	</head>

	<body onLoad="onLoad()">
		<div>
			<div id="buttoncontainer">
				<button type="button" onclick="saveDependentVariable('android')" id="variable1">Android</button>
				<button type="button" onclick="saveDependentVariable('pc')" id="variable2">PC</button>
			</div>
			<div id="container" class="container">
				<div id="counter"></div>
				<div id="action"></div>
				<button id="tapHere"><img src="2x/round_touch_app_white_36dp.png"/></button>
				<button id="continue" onclick="startNext()">Continue</button>
			</div>
		</div>
	</body>
</html>
