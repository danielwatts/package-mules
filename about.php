<!DOCTYPE hmtl>
<html lang="en">
<?php include 'includes/head.html';?>

<body>
	<?php include 'includes/nav.html';?>

	<section class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>About us</h2>
				<p>Package mules is currently in a phase of information gathering. We want to bridge the gap between people who need help with moving, and those who can provide the service.</p>
			</div>
		</div>
	</section>

	<section class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>What would you like to know about us?</h3>
				<p>Click the blue button on the top left. Then edit the quote below. Please only edit 1.</p>
				<div data-editable data-name="quote-1">
    				<blockquote>
        				[Enter content here]
    				</blockquote>
    				<p>[your name]</p>
				</div>
				<div data-editable data-name="quote-2">
    				<blockquote>
        				[Enter content here]
    				</blockquote>
    				<p>[your name]</p>
				</div>
				<div data-editable data-name="quote-3">
    				<blockquote>
        				[Enter content here]
    				</blockquote>
    				<p>[your name]</p>
				</div>
				<div data-editable data-name="quote-4">
    				<blockquote>
        				[Enter content here]
    				</blockquote>
    				<p>[your name]</p>
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
		    xhr.open('POST', '/about.php');
		    xhr.send(payload);
		});
	});
	</script>

</html>