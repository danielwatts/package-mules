<!DOCTYPE hmtl>
<html lang="en">
<?php include 'includes/head.html';?>

<body>
	<?php include 'includes/nav.html';?>

	<section class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Logo Suggestion</h2>
				<p>Package mules is currently seeking ideas for a mascot to put on our logo.</p>
			</div>
		</div>
	</section>

	<section class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>What should be our mascot on our logo, and what would be there name</h3>
				<p>Click the blue button on the top left. Then edit the quote below. Please only edit 1.</p>
			</div>
			<div class="col-md-6">
				<div data-editable data-name="mascot-1">
    				<img src="http://placehold.it/300x300">
    				<p>[name]</p>
				</div>
				<div data-editable data-name="mascot-2">
    				<img src="http://placehold.it/300x300">
    				<p>[name]</p>
				</div>
				<div data-editable data-name="mascot-3">
    				<img src="http://placehold.it/300x300">
    				<p>[name]</p>
				</div>
				<div data-editable data-name="mascot-4">
    				<img src="http://placehold.it/300x300">
    				<p>[name]</p>
				</div>
				<div data-editable data-name="mascot-5">
    				<img src="http://placehold.it/300x300">
    				<p>[name]</p>
				</div>
				<div data-editable data-name="mascot-6">
    				<img src="http://placehold.it/300x300">
    				<p>[name]</p>
				</div>
			</div>
		</div>
	</section>

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
		    xhr.open('POST', '/logo.php');
		    xhr.send(payload);

		    var_dump($_POST); 
		});
	});

	</script>

</html>