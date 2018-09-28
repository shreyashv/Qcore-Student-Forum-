 <style>
	 /* Style the navbar */
	#navbar {
	  overflow: hidden;
	  background-color: #333;
	}

	/* Navbar links */
	#navbar a {
	  float: left;
	  display: block;
	  color: #f2f2f2;
	  text-align: center;
	  padding: 14px;
	  text-decoration: none;
	}

	/* Page content */
	.content {
	  padding: 16px;
	}

	/* The sticky class is added to the navbar with JS when it reaches its scroll position */
	.sticky {
	  position: fixed;
	  top: 0;
	  width: 100%
	}

	/* Add some top padding to the page content to prevent sudden quick movement (as the navigation bar gets a new position at the top of the page (position:fixed and top:0) */
	.sticky + .content {
	  padding-top: 60px;
	} 


<div class="header">
  <h2>Scroll Down</h2>
  <p>Scroll down to see the sticky effect.</p>
</div>

<div id="navbar">
  <a class="active" href="javascript:void(0)">Home</a>
  <a href="javascript:void(0)">News</a>
  <a href="javascript:void(0)">Contact</a>
</div>

 <script>
	// When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the navbar
var navbar = document.getElementById("navbar");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
 </script>