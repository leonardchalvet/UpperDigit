
<div class="devtools-text">
	<div class="container-text">
		<div class="text">
			<span> < SECRET DEV MODE /> <em>ON</em></span>
		</div>
	</div>
</div>

<div class="devtools-containerLink">
	<div class="btn">
		List files
	</div>
	<div class="container-el">
		<?php 
		  if ($handle = opendir('.')) {
			    while (false !== ($entry = readdir($handle))) {

			        if ($entry != "." && $entry != "..") {

			            echo "<a class='el' href='$entry\n'>$entry\n</a>";
			        }
			    }
			    closedir($handle);
			}
		?> 
	</div>
</div>

<div class="devtools-menu">
	<div class="container-el">
		<div class="el" data-option="scrollposition">Scroll Position</div>
		<div class="el" data-option="screensize">Screen Size</div>
		<div class="el" data-option="grid">Show Grid</div>
		<div class="el" data-option="element">Stroke Element</div>
		<div class="el" data-option="section">Stroke Section</div>
		<div class="el" data-option="reset">Reset</div>
	</div>
</div>


<div class="devtools-grid">
	

	<div class="container-grid">
		<div class="grid"></div>
		<div class="grid"></div>
		<div class="grid"></div>
		<div class="grid"></div>
		<div class="grid"></div>
		<div class="grid"></div>
		<div class="grid"></div>
		<div class="grid"></div>
		<div class="grid"></div>
		<div class="grid"></div>
		<div class="grid"></div>
		<div class="grid"></div>
	</div>


</div>


<div class="devtools-size">
	
</div>

<div class="devtools-scrollposition">
	
</div>