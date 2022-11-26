# Revels
Revels is a web application where each user can publish his own revels and follow other users to see their revels. Revels are text sentences where the user can express his ideas freely and other users can comment.

## index.php
* If you are not logged in, it displays a registration form.
* It also shows a link to the login form.
* If the session is logged in it shows the revels of itself and the users it follows in order of date.
* If no revels exist it will display a message.
* A sidebar also appears showing the users that the user is following.
    which the user is following.
	
## registration.php
* Checks that the data entered in the form has no errors.
* If it has errors it sends them to the index.
* If it does not have errors it inserts the data in the table users.

## login.php
* A login form is displayed.
* Once submitted, it checks that the user and password entered are correct.
* If they are correct, the data is saved in the variable $_SESSION and redirected to index.php.
* If they are not correct, errors are displayed.

## logout.php 
* Destroys the session.
 
## new.php
* Displays a form to enter the disclosure.
* In case it is empty it gives error.
* If it is not empty, it inserts the data in the revels table.

## revel.php
* Displays a revel with and its comments.

## comment.php
* Receives the value entered in the form of revel.php.
* If empty it sends an error.
* If not empty inserts the data into the comments table.
 
## results.php
* Displays the users that contain in the name the string entered in the index form.
* Next to the users a follow button is shown.
 
## list.php
* Displays a list of the chosen user's revels along with a follow button.
* If a user accesses his own list no follow button is shown but a link to delete.php is shown.
 
## follow.php
* Inserts in the follows table the id of the user and the id of the user to follow.
 
## unfollow.php
* Stop following the requested user.

## delete.php
* Selects a revel and deletes it.
* Deletes the comments of the selected revel.

## cancel.php
* A confirmation message is displayed to confirm the deletion of the account.
* To confirm you have to check the checkbox and click confirm.
* If you press confirm without checking the checkbox nothing will happen.
* If you check the checkbox and click on confirm, everything related to the specified user will be deleted.
* If the cancel button is clicked it redirects to the account.php page.
 
## account.php
* Displays a form for the user to verify himself before logging in.
* It will give error if:
    - The password entered is not correct.
    - The field is empty.
* If it does not give error:
    - A 120sec cookie is created that verifies the user.
* Once verified it shows 3 forms and a sidebar.
* The functions in the sidebar are:
    - Access to "My Revels" (list.php)
    - Delete the account
* The forms allow:
    - Update the username
    - Update email address
    - Update the password
* To update the password you are asked to fill in 2 inputs where the value must be the same. Otherwise it will not update.

## conexion.inc.php
* Creates a connection to the database.

## menu.inc.php
* Includes the menu.
* If you are logged in it will show the complete menu.
* In case you are not logged in it will show only a link to index.php.

## menuBackend.inc.php
* Includes the Backend menu.
* In case you are logged in it will show the full menu.

## footer.inc.php
* Includes the footer of the web application.