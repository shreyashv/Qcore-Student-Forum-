<html>
	<head>
		<style>
			#overlay {
			   display:none;    //This make it initially hidden
			   position:fixed;  //This makes it so it says in a fixed position even if they scroll around
			   left:0px;        //This positions the element to the left most position
			   top:0px;         //This positions the elment to the top most position
			   width:100%;      //This makes the element take up 100% of the parents width
			   height:100%;     //This makes the element take up 100% of the parents height
			   background:#000; //Give it a black background
			   opacity:0.5;     //Change the opacity to 50% so that is see through.
			   z-index:99999;   //Change the z-index so it will be above everything else
			}

			#popup {
			   display:none;
			   position:fixed;
			   left:50%;            //left and top here position top left page
			   top:50%;             //of the element to the center of the 
			   width:300px;         //Set the popup to have a specific width/height
			   height:150px;
			   margin-top:-75px;   //To get the popup to center correctly we need
			   margin-left:-150px;   //To displace the the top/left margins by half of the width/height
			   background:#FFFFFF;  //Background of white
			   border:2px solid #000;  //And give it a border
			   z-index:100000;      //Set z-index to 1 more than that of the overlay so the popup is over the overlay
			}
		</style>
		<script>
					window.onload = function() {
			   //Get the DOM element that represents the <button> element.
			   //And set the onclick event
			   document.getElementById("LearnMoreBtn").onclick = function(){
				  //Set a variable to contain the DOM element of the overly
				  var overlay = document.getElementById("overlay");
				  //Set a variable to contain the DOM element of the popup
				  var popup = document.getElementById("popup");

				  //Changing the display css style from none to block will make it visible
				  overlay.style.display = "block";
				  //Same goes for the popup
				  popup.style.display = "block";
			   };
			};
		</script>
	</head>
	<body>
		<button id="LearnMoreBtn">Learn More</button>
	<div id="overlay">
	</div>
	<div id="popup">
		Popup contents here
	</div>
	</body>
</html>