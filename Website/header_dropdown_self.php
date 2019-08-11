<style>

.topbar
{
	overflow: hidden;
	float: none;
	background-color: #0080F0;
}

.topbar a
{
	float: left;
    font-size: 16px;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.topbar p
{
	float: left;
    font-size: 16px;
    color: #C8C4C4;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}


.dropdown {
    float: left;
    overflow: hidden;
}

.dropdown .dropbtn {
    font-size: 16px;    
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}

.topbar a:hover, .dropdown:hover .dropbtn {
    background-color: red;
}
	
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}
	
</style>


<div class="topbar">
  <a style="margin-left: 250px;">Home</a>

  <a href="#news">News</a>
  <div class="dropdown">
    <button class="dropbtn">My GRMS
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="my_played_games_css.php">My Played Games</a>
      <a href="#">My Wishlist</a>
      <a href="#">My Top Rated</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">My Account
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">Change Password</a>
      <a href="#">Modify Personal Details</a>
      <a href="#"></a>
    </div>
  </div> 
  <a href="#news">Stats</a>
</div>


