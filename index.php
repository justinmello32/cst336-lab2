<html>
<head>
	<meta charset="utf-8">
	<title>US Quiz</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js" ></script> 
	<script>
		$(document).ready(function(){

			$("button").on("click",function(){

				console.log($("#q1").val());
			});//click
		})//ready
	</script>
	<script>
		$(document).ready(function(){

			//Global Variables
			var score = 0;
			var attempts = localStorage.getItem("total_attempts");

			//Event Listeners
			$("button").on("click", gradeQuiz);

			displayQ4Choices();
			displayQ9Choices();

            //Functions
            function displayQ4Choices() {

                let q4ChoicesArray = ["Maine", "Rhode Island", "Maryland", "Delaware"];
                q4ChoicesArray = _.shuffle(q4ChoicesArray);

                for (let i = 0; i < q4ChoicesArray.length; i++) {
                	$("#q4Choices").append(` <input type="radio" name="q4" id="${q4ChoicesArray[i]}" value="${q4ChoicesArray[i]}"> <label for="${q4ChoicesArray[i]}"> ${q4ChoicesArray[i]}</label>`);
                }

             }

             function displayQ9Choices() {

                let q9ChoicesArray = ["Mcdonalds", "Jack in the box", "In & Out", "Burger King"];
                q9ChoicesArray = _.shuffle(q9ChoicesArray);

                for (let i = 0; i < q9ChoicesArray.length; i++) {
                	$("#q9Choices").append(` <input type="radio" name="q9" id="${q9ChoicesArray[i]}" value="${q9ChoicesArray[i]}"> <label for="${q9ChoicesArray[i]}"> ${q9ChoicesArray[i]}</label>`);
                }

             }


			//Question 5 Images
			$(".q5Choice").on("click", function() {
				$(".q5Choice").css("background","");
				$(this).css("background","rgb(255, 255, 0)");
			});

			//Question 10 Images
			$(".q10Choice").on("click", function() {
				$(".q10Choice").css("background","");
				$(this).css("background","rgb(255, 255, 0)");
				
				//Add border for visual improvement
				$(".q10Choice").css("border-style","");
				$(this).css("border-style", "solid");
				$(this).css("border-color", "red");
			});

			//Functions
			function isFormValid(){
				let isValid = true;
				if ($("#q1").val() =="") {
					isValid = false;
					$("#validationFdbk").html("Question 1 was not answered");
				}				
				if ($("#q6").val() =="") {
					isValid = false;
					$("#validationFdbk").html("Question 6 was not answered");
				}
				return isValid;
			}

			function gradeQuiz() {

				$("#validationFdbk").html("");

				if(!isFormValid()) {
					return;
				}

				function rightAnswer(index) {
                    $(`#q${index}Feedback`).html("Correct!");
                    $(`#q${index}Feedback`).attr("class", "bg-success text-white");
                    $(`#markImg${index}`).html("<img src='img/checkmark.png' alt='xmark'>");
                    score += 10;
                }

				function wrongAnswer(index){
					$(`#q${index}Feedback`).html("Incorrect");
					$(`#q${index}Feedback`).attr("class", "bg-warning text-white");
					$(`#markImg${index}`).html("<img src='img/xmark.png' alt='xmark'>");
				}

				//Variables
				score = 0;
				let q1Response = $("#q1").val().toLowerCase();
				let q2Response = $("#q2").val();
				let q4Response = $("input[name=q4]:checked").val();
				let q6Response = $("#q6").val().toLowerCase();
				let q7Response = $("#q7").val();
				let q9Response = $("input[name=q9]:checked").val();

				//Question 1
				if(q1Response == "sacramento") {
					rightAnswer(1);
				}else {
					wrongAnswer(1)
				}
				//Question 2
				if(q2Response == "mo") {
					rightAnswer(2);
				}else {
					wrongAnswer(2)
				}
				//Question 3
				if($("#Jefferson").is(":checked") && $("#Roosevelt").is(":checked") && !$("#Jackson").is(":checked") && !$("#Franklin").is(":checked")){
					rightAnswer(3);
				}
				else {
					wrongAnswer(3);
				}

				//Question 4
                if(q4Response == "Rhode Island") {
                    rightAnswer(4);
                }
                else {
                    wrongAnswer(4);
                }

				//Question 5
				if($("#seal2").css("background-color") == "rgb(255, 255, 0)") {
					rightAnswer(5);
				}else {
					wrongAnswer(5);
				}

				//Question 6
				if(q6Response == "los angeles") {
					rightAnswer(6);
				}else {
					wrongAnswer(6)
				}

				//Question 7
				if(q7Response == "3") {
					rightAnswer(7);
				}else {
					wrongAnswer(7)
				}

				//Question 8
				if($("#SantaRosa").is(":checked") && $("#FortBragg").is(":checked") && !$("#YadaVille").is(":checked") && !$("#MoosePark").is(":checked")){
					rightAnswer(8);
				}
				else {
					wrongAnswer(8);
				}

				//Question 9
                if(q9Response == "In & Out") {
                    rightAnswer(9);
                }
                else {
                    wrongAnswer(9);
                }

                //Question 10
				if($("#flag1").css("background-color") == "rgb(255, 255, 0)") {
					rightAnswer(10);
				}else {
					wrongAnswer(10);
				}


				if(score < 80) {
					$("#totalScore").attr("class", "text-danger");
				}
				else {
					$("#totalScore").attr("class", "text-success");
					$("#successMessage").html("Nice job, you scored over 80!")
					$("#successMessage").attr("class", "text-success");
				}
				$("#totalScore").html(`Total Score: ${score}`);
				$("#totalAttempts").html(`Total Attempts: ${++attempts}`);
				localStorage.setItem("total_attempts", attempts);
			}
		})
	</script>
</head>
<body class="text-center">

	<h1 class="jumbotron">US Geography Quiz</h1>


	<h3><span id="markImg1"></span>What is the capital of California?</h3>
	<input type="text" id="q1">
	<br><br>
	<div id="q1Feedback"></div>
	<br>

	<h3><span id="markImg2"></span>What is the longest river?</h3>
	<select id="q2">
		<option value="">Select One</option>
		<option value="ms">Mississippi</option>
		<option value="mo">Missouri</option>
		<option value="co">Colorado</option>
		<option value="de">Delaware</option>
	</select>
	<br><br>
	<div id="q2Feedback"></div>
	<br>

	<h3><span id="markImg3"></span>What presidents are carved into mount Rushmore?</h3>
	<input type="checkbox" id="Jackson"> <label for="Jackson">A. Jackson </label>
	<input type="checkbox" id="Franklin"> <label for="Franklin">B. Franklin </label>
	<input type="checkbox" id="Jefferson"> <label for="Jefferson">T. Jefferson </label>
	<input type="checkbox" id="Roosevelt"> <label for="Roosevelt">T. Roosevelt  </label>
	<br><br>
	<div id="q3Feedback"></div>
	<br>

	<h3><span id="markImg4"></span>What is the smallest US State?</h3>
	<div id="q4Choices"></div>
	<div id="q4Feedback"></div>
	<br></br>


	<h3><span id="markImg5"></span>What image is in the Great Seal of the State of California?</h3>
	<img src="img/seal1.png" alt="Seal 1" class="q5Choice" id="seal1">
	<img src="img/seal2.png" alt="Seal 2" class="q5Choice" id="seal2">
	<img src="img/seal3.png" alt="Seal 3" class="q5Choice" id="seal3">
	<div id="q5Feedback"></div>
	<br></br>

	<h3><span id="markImg6"></span>What is the largest city in California?</h3>
	<input type="text" id="q6">
	<br><br>
	<div id="q6Feedback"></div>
	<br>

	<h3><span id="markImg7"></span>What is the population of California?</h3>
	<select id="q7">
		<option value="">Select One</option>
		<option value="1">10.5 Million</option>
		<option value="2">20.2 Million</option>
		<option value="3">30.5 Million</option>
		<option value="4">200 Million</option>
	</select>
	<br><br>
	<div id="q7Feedback"></div>
	<br>

	<h3><span id="markImg8"></span>Which of these are real cities in California?</h3>
	<input type="checkbox" id="SantaRosa"> <label for="SantaRosa">Santa Rosa </label>
	<input type="checkbox" id="FortBragg"> <label for="FortBragg">Fort Bragg </label>
	<input type="checkbox" id="YadaVille"> <label for="YadaVille">YadaVille </label>
	<input type="checkbox" id="MoosePark"> <label for="MoosePark">MoosePark </label>
	<br><br>
	<div id="q8Feedback"></div>
	<br>

	<h3><span id="markImg9"></span>What is the best fast food? (Hint, double double)</h3>
	<div id="q9Choices"></div>
	<div id="q9Feedback"></div>
	<br></br>

	<h3><span id="markImg10"></span>What is the flag of California? (This one's tough)</h3>
	<img src="img/cal.png" alt="Flag 1" class="q10Choice" id="flag1">
	<img src="img/nm.png" alt="Flag 2" class="q10Choice" id="flag2">
	<img src="img/wash.png" alt="Flag 3" class="q10Choice" id="flag3">
	<div id="q10Feedback"></div>
	<br></br>


	<h3 id="validationFdbk" class="bg-danger text-white"></h3>
	<button class="btn btn-outline-success">Submit Quiz</button>
	<br>
	<h2 id="totalScore" class="text-info"></h2>
	<h2 id="successMessage"></h2>
	<h3 id="totalAttempts"></h3>
</body>
</html>