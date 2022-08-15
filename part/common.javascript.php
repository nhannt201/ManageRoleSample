<script>
function loadSetPage(pageSet)
			{
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						window.location.replace("/");			
					}
				};
				xhttp.open("GET", "interface.php?action=setJobPage&page=" + pageSet, true);
				xhttp.send();
			}
function logoutPage()
			{
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						location.reload();				
					}
				};
				xhttp.open("GET", "interface.php?action=logout", true);
				xhttp.send();
			}
</script>