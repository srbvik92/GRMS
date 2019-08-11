<body>
<script type="text/javascript">
function jsFunction()
{
	//alert(value);
    var x = document.getElementById("genre")
	var genre = x.options[x.selectedIndex].value;
	alert(genre);
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("main").innerHTML = this.responseText;
    }
  };
//if (x=="images")
{
  	xhttp.open("POST", "footer.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  	xhttp.send();
}
}
</script>

<select id ="genre" name="genre" onmousedown="this.value='';" onchange="jsFunction();">
  <option value='1'>One</option>
  <option value='2'>Two</option>
  <option value='3'>Three</option>
</select>
<select id ="ddl1" name="ddl1" onmousedown="this.value='';" onchange="jsFunction();">
  <option value='1'>One</option>
  <option value='2'>Two</option>
  <option value='3'>Three</option>
</select>


<div id="main">
	
</div>
</body>