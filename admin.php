<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
    <title>pineapple. | Admin Page</title>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="js/emailFunctions.js"></script>
    <script src="js/emailtoCSV.js"></script>
</head>
<body>
    <h2>Registered Emails</h2>
	<input type="text" id="myInput" onkeyup="searchEmails()" placeholder="Search for emails.." title="Type in an email address">
	<input type="button" value="RESET" id="reset" onclick="reloadEmails('reset');">
	<form method="get" action="handler.php">
	<table id="email-list">
	<tr>
		<th>ID</th>
		<th>E-mail</th> 
		<th>Date Created</th>
		<th>Selected</th>
    <?php
        include_once 'db.php';
        $db = new Database();
        
        $db->showEmails();

        $buttons = $db->getButtons();
    ?>
	<button type="button" onclick="sortTableByName()">Sort emails by name</button>
	<button type="button" onclick="sortTableByDate()">Sort emails by date</button>
	</tr>
	</table>
	<input type="submit" name="remove" id="remove" value="Delete selected email addresses"/> 
	</form>
	<button id="export" data-export="export">Export selected email addresses to CSV</button>
	</div>
    <script>
	$("#export").click(function(){
	$("#email-list").tableToCSV();
	});
    </script>
</body>
</html>