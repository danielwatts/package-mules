<?php 
	if (!empty($_POST)) { // check for POST array
		foreach ($_POST as $key => $value) { // go through every POST element
			file_put_contents('editable/index/' . $key . '.html', $value); // save file
		} // foreach end
	} // if end
?>

<!DOCTYPE hmtl>
<html lang="en">
<?php include 'includes/head.html';?>

<body>
	<?php include 'includes/nav.html';?>
	<section class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Package Mules</h1>
				<p>Welcome to the future home of package mules. Our mission is to help bring movers together with low cost options for moving.</p>
				<p>We set up an editable page so we can get public feedback. Please be considerate and only post appropriate content.</p>
			</div>
		</div>
	</section>

	<section class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>The thing you hate most about moving is?</h2>
			</div>

			<div class="col-md-12">
				<div data-editable data-name="moving-1">
					<?php include 'editable/index/moving-1.html'; ?>
				</div>
				<div data-editable data-name="moving-2">
					<?php include 'editable/index/moving-2.html'; ?>
				</div>
				<div data-editable data-name="moving-3">
					<?php include 'editable/index/moving-3.html'; ?>
				</div>
				<div data-editable data-name="moving-4">
					<?php include 'editable/index/moving-4.html'; ?>
				</div>

			</div>
		</div>

	</seciton>

	<?php include 'includes/footer.html';?>
	<?php include 'includes/scripts.html';?>
	<script>
		window.addEventListener('load', function() {
		    var editor;

		    ContentTools.StylePalette.add([
		    	new ContentTools.Style('Author', 'author', ['p'])
			]);

			editor = ContentTools.EditorApp.get();
			editor.init('*[data-editable]', 'data-name');

			editor.bind('save', function (regions) {
			    var name, payload, xhr;

			    // Set the editor as busy while we save our changes
			    this.busy(true);

			    // Collect the contents of each region into a FormData instance
			    payload = new FormData();
			    for (name in regions) {
			        if (regions.hasOwnProperty(name)) {
			            payload.append(name, regions[name]);
			        }
		    }

		    // Send the update content to the server to be saved
		    function onStateChange(ev) {
		        // Check if the request is finished
		        if (ev.target.readyState == 4) {
		            editor.busy(false);
		            if (ev.target.status == '200') {
		                // Save was successful, notify the user with a flash
		                new ContentTools.FlashUI('ok');
		            } else {
		                // Save failed, notify the user with a flash
		                new ContentTools.FlashUI('no');
		            }
		        }
		    };

		    xhr = new XMLHttpRequest();
		    xhr.addEventListener('readystatechange', onStateChange);
		    xhr.open('POST', '/index.php');
		    xhr.send(payload);
		});
	});

	</script>

</html>
