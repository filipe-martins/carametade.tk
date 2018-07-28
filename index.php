<!--<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />-->

<?php
/* Full membership with login and registration
 * PHP script that includes login registration form with proper password salting, login form with validation and
 * MySQL injection protection.
 * @author MartinoEst
 * @link https://github.com/martinoest/
 * @license http://opensource.org/licenses/MIT MIT License
 * 
 * Minimum 5.6 PHP version required!
 */


/* Require login.php to call login function */
//require("classes/UserClass.php");
require_once("classes/OneFileLoginApplication.php");

/* Call for login function */
//$login = new UserClass();
//if($login->isLoggedIn() == true){
//  include("views/loginTrue.php");
//} else {
//  include("views/loginFalse.php");
//}
//header('Location:login.php');
// run the application

if ($application->getUserLoginStatus()) {
    include_once("views/main.php");    // If user is already logged in redirect back to index.php
} else {
    include_once("views/loginForm.php");   // Else prompt login form
}
?>

