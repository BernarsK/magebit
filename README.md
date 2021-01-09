# Running the test assignment on local machine

Project should be run on a machine that supports php and mysql. 
The main page of the project is index.html
To access the list of emails saved on database, you should navigate to /admin.php.
Buttons ending with @email.com will filter the emails leaving only the names that contain the value on button. To revert that, press reset button.
Emails can be exported to .csv with checking the checkbox and then pressing the button

# Database connection and import

To successfully connect to the database the local file db.php should be edited
Row 15-18 values should be changed to your local machine logins. 
The default table name for the project is "emails"
A database example file as an import is added as well (emails.sql)
