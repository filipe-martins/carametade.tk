<?php

/**
 * Class OneFileLoginApplication
 *
 * An entire php application with user registration, login and logout in one file.
 * Uses very modern password hashing via the PHP 5.5 password hashing functions.
 * This project includes a compatibility file to make these functions available in PHP 5.3.7+ and PHP 5.4+.
 *
 * @author Panique
 * @link https://github.com/panique/php-login-one-file/
 * @license http://opensource.org/licenses/MIT MIT License
 */
class OneFileLoginApplication {
    /**
     * @var string Type of used database (currently only SQLite, but feel free to expand this with mysql etc)
     */
//private $db_type = "sqlite"; //

    /**
     * @var string Path of the database file (create this with _install.php)
     */
//private $db_sqlite_path = "./users.db";

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "caradb";

    /**
     * @var object Database connection
     */
    private $db_connection = null;

    /**
     * @var bool Login status of user
     */
    private $user_is_logged_in = false;

    /**
     * @var string System messages, likes errors, notices, etc.
     */
    public $feedback = "";

    /**
     * Simply returns the current status of the screen to see error
     * @return bool User's login status
     */
    public function getFeedback() {
        return $this->feedback;
    }

    /**
     * Does necessary checks for PHP version and PHP password compatibility library and runs the application
     */
    public function __construct() {
        if ($this->performMinimumRequirementsCheck()) {
            $this->runApplication();
        }
    }

    /**
     * Performs a check for minimum requirements to run this application.
     * Does not run the further application when PHP version is lower than 5.3.7
     * Does include the PHP password compatibility library when PHP version lower than 5.5.0
     * (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
     * @return bool Success status of minimum requirements check, default is false
     */
    private function performMinimumRequirementsCheck() {
        if (version_compare(PHP_VERSION, '5.3.7', '<')) {
            echo "Desculpe, esta apalicaÃ§Ã£o nÃ£o corre numa versÃ£o do PHP anterior Ã  5.3.7 !";
        } elseif (version_compare(PHP_VERSION, '5.5.0', '<')) {
            require_once("libraries/password_compatibility_library.php");
            return true;
        } elseif (version_compare(PHP_VERSION, '5.5.0', '>=')) {
            return true;
        }
// default return
        return false;
    }

    /**
     * This is basically the controller that handles the entire flow of the application.
     */
    public function runApplication() {
// check is user wants to see register page (etc.)
        if (isset($_POST["registration"]) && $_POST["registration"] == "Registrar") {
            $this->doRegistration();
            $this->showPageRegistration();
        } else {
// start the session, always needed!
            $this->doStartSession();
// check for possible user interactions (login with session/post data or logout)
            $this->performUserLoginAction();
// show "page", according to user's login status
            if ($this->getUserLoginStatus()) {
                $this->showPageLoggedIn();
            } else {
                $this->showPageLoginForm();
            }
        }
    }

    /**
     * Creates a PDO database connection (in this case to a SQLite flat-file database)
     * @return bool Database creation success status, false by default
     */
    private function createDatabaseConnection() {
        try {
            if (!isset($this->db_connection))
                $this->db_connection = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);

// set the PDO error mode to exception
            $this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (PDOException $e) {
            $this->feedback = "PDO problema connecÃ§Ã£o Ã  base de dados : " . $e->getMessage();
        } catch (Exception $e) {
            $this->feedback = "Problema geral: " . $e->getMessage();
        }
        return false;
    }

    /**
     * Handles the flow of the login/logout process. According to the circumstances, a logout, a login with session
     * data or a login with post data will be performed
     */
    private function performUserLoginAction() {
        if (isset($_GET["action"]) && $_GET["action"] == "logout") {
            $this->doLogout();
        } elseif (!empty($_SESSION['username']) && ($_SESSION['user_is_logged_in'])) {
            $this->doLoginWithSessionData();
        } elseif (isset($_POST["login"])) {
            $this->doLoginWithPostData();
        }
    }

    /**
     * Simply starts the session.
     * It's cleaner to put this into a method than writing it directly into runApplication()
     */
    private function doStartSession() {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
    }

    /**
     * Set a marker (NOTE: is this method necessary ?)
     */
    private function doLoginWithSessionData() {
        $this->user_is_logged_in = true; // ?
    }

    /**
     * Process flow of login with POST data
     */
    private function doLoginWithPostData() {
        if ($this->checkLoginFormDataNotEmpty()) {
            if ($this->createDatabaseConnection()) {
                $this->checkPasswordCorrectnessAndLogin();
            }
        }
    }

    /**
     * Logs the user out
     */
    private function doLogout() {
        $_SESSION = array();
        session_destroy();
        $this->user_is_logged_in = false;
        $this->feedback = "Acabou de fazer log out.";
    }

    /**
     * The registration flow
     * @return bool
     */
    private function doRegistration() {
        if ($this->checkRegistrationData()) {
            if ($this->createDatabaseConnection()) {
                $this->createNewUser();
            }
        }
// default return
        return false;
    }

    /**
     * Validates the login form data, checks if username and password are provided
     * @return bool Login form data check success state
     */
    private function checkLoginFormDataNotEmpty() {
        if (!empty($_POST['utilizador']) && !empty($_POST['password'])) {
            return true;
        } elseif (empty($_POST['utilizador'])) {
            $this->feedback = "Campo do utilizador estÃ¡ vazio.";
        } elseif (empty($_POST['user_password'])) {
            $this->feedback = "Campo da password estÃ¡ vazia.";
        }
// default return
        return false;
    }

    /**
     * Checks if user exits, if so: check if provided password matches the one in the database
     * @return bool User login success status
     */
    private function checkPasswordCorrectnessAndLogin() {
// remember: the user can log in with username or email address
// prepare sql and bind parameters
        $sql = "SELECT username, email, password FROM users
                WHERE username = :username OR email = :username LIMIT 1";
        $query = $this->db_connection->prepare($sql);
        $query->bindParam(':username', $_POST['utilizador']);
        $query->execute();

// Btw that's the weird way to get num_rows in PDO with SQLite:
// if (count($query->fetchAll(PDO::FETCH_NUM)) == 1) {
// Holy! But that's how it is. $result->numRows() works with SQLite pure, but not with SQLite PDO.
// This is so crappy, but that's how PDO works.
// As there is no numRows() in SQLite/PDO (!!) we have to do it this way:
// If you meet the inventor of PDO, punch him. Seriously.
        $result_row = $query->fetchObject();
        if ($result_row) {
// using PHP 5.5's password_verify() function to check password
            if (password_verify($_POST['password'], $result_row->password)) {
// write user data into PHP SESSION [a file on your server]
                $_SESSION['username'] = $result_row->username;
                $_SESSION['email'] = $result_row->email;
                $_SESSION['user_is_logged_in'] = true;

//definir cookie
                if (isset($_POST['remember'])) {
                    setcookie('username', $result_row->username, time() + 60 * 60 * 24 * 366, "/");
//                    setcookie('password', $result_row->password, time() + 60*60*24*366);
                }

                $this->user_is_logged_in = true;
//                header('Location: views/mainForm.php');    // If user is already logged in redirect back to index.php
                return true;
            } else {
                $this->feedback = "Utilizador ou palavra passe errada.";
            }
        } else {
            $this->feedback = "Utilizador ou palavra passe errada.";
        }
// default return
        return false;
    }

    /**
     * Validates the user's registration input
     * @return bool Success status of user's registration data validation
     */
    private function checkRegistrationData() {
// if no registration form submitted: exit the method
        if (!isset($_POST["registration"])) {
            return false;
        }

// validating the input
        if (!empty($_POST['utilizador']) && strlen($_POST['utilizador']) <= 64 && strlen($_POST['utilizador']) >= 2 && preg_match('/^[a-z\d]{2,64}$/i', $_POST['utilizador']) && !empty($_POST['email']) && strlen($_POST['email']) <= 64 && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['password']) && strlen($_POST['password']) >= 6 && !empty($_POST['password2']) && ($_POST['password'] === $_POST['password2'])) {

// only this case return true, only this case is valid
            return true;
        } elseif (empty($_POST['utilizador'])) {
            $this->feedback = "Sem utilizador";
        } elseif (empty($_POST['password']) || empty($_POST['password2'])) {
            $this->feedback = "Sem password";
        } elseif ($_POST['password'] !== $_POST['password2']) {
            $this->feedback = "Não introduziu a mesma password nos dois campos!";
        } elseif (strlen($_POST['password']) < 6) {
            $this->feedback = "A password tem de ter no mÃ­nimo 6 caracteres";
        } elseif (strlen($_POST['utilizador']) > 64 || strlen($_POST['utilizador']) < 2) {
            $this->feedback = "O utilizador nÃ£o pode ter menos de 2 or ser maior de 64 caracteres";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['utilizador'])) {
            $this->feedback = "Utilizador invÃ¡lido: sÃ³ a-Z e nÃºmeros sÃ£o permitidos, 2 to 64 caracteres";
        } elseif (empty($_POST['email'])) {
            $this->feedback = "Email nÃ£o pode estar vazio";
        } elseif (strlen($_POST['email']) > 64) {
            $this->feedback = "Email nÃ£o pode ter mais de 64 caracteres";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $this->feedback = "O email nÃ£o tem um formato vÃ¡lido";
        } else {
            $this->feedback = "Ocorreu um erro desconhecido!";
        }

// default return
        return false;
    }

    /**
     * Creates a new user.
     * @return bool Success status of user registration
     */
    private function createNewUser() {
// remove html code etc. from username and email
        $user_name = htmlentities($_POST['utilizador'], ENT_QUOTES);
        $user_email = htmlentities($_POST['email'], ENT_QUOTES);

        $sql = 'SELECT * FROM users WHERE username = :user_name OR email = :user_email';
        $query = $this->db_connection->prepare($sql);
        $query->bindValue(':user_name', $user_name);
        $query->bindValue(':user_email', $user_email);
        $query->execute();

// As there is no numRows() in SQLite/PDO (!!) we have to do it this way:
// If you meet the inventor of PDO, punch him. Seriously.
        $result_row = $query->fetchObject();
        if ($result_row) {
            $this->feedback = "Desculpe, esse nome de utilizador ou email jÃ¡ foi utilizado. Por favor escolha outro.";
        } else {
            $user_password = $_POST['password'];
// crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 char hash string.
// the constant PASSWORD_DEFAULT comes from PHP 5.5 or the password_compatibility_library
            $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
//activation code
            $code = substr(md5(mt_rand()), 0, 15);
            $sql = 'INSERT INTO users (username, email, password, is_activated, reset_code)
                    VALUES(:user_name, :email, :user_password_hash, :is_activated, :reset_code)';
            $query = $this->db_connection->prepare($sql);
            $query->bindValue(':user_name', $user_name);
            $query->bindValue(':email', $user_email);
            $query->bindValue(':user_password_hash', $user_password_hash);
            $query->bindValue(':is_activated', false);
            $query->bindValue(':reset_code', $code);

// PDO's execute() gives back TRUE when successful, FALSE when not
// @link http://stackoverflow.com/q/1661863/1114320
            $registration_success_state = $query->execute();

            if ($registration_success_state) {
                $this->feedback = "Sua conta foi criada com sucesso. JÃ¡ pode escolher entrar.";
                $_SESSION['username'] = $user_name;
                $_SESSION['email'] = $user_email;
                $_SESSION['user_is_logged_in'] = true;
                return true;
            } else {
                $this->feedback = "Desculpe, seu registo falhou. Por favor tente novamente.";
            }
        }
// default return
        return false;
    }

    /**
     * Simply returns the current status of the user's login
     * @return bool User's login status
     */
    public function getUserLoginStatus() {
        return $this->user_is_logged_in;
    }

    /**
     * Simple demo-"page" that will be shown when the user is logged in.
     * In a real application you would probably include an html-template here, but for this extremely simple
     * demo the "echo" statements are totally okay.
     */
    private function showPageLoggedIn() {
//        if ($this->feedback) {
//            echo $this->feedback . "<br/><br/>";
//        }
        $_SESSION['message'] = $this->feedback;

//        echo "OlÃ¡ " . $_SESSION['username'] . ", estÃ¡ logado.<br/><br/>";
//        echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?action=logout">Log out</a>';
    }

    /**
     * Simple demo-"page" with the login form.
     * In a real application you would probably include an html-template here, but for this extremely simple
     * demo the "echo" statements are totally okay.
     */
    private function showPageLoginForm() {
        $_SESSION['message'] = $this->feedback;
//        if ($this->feedback) {
//            echo $this->feedback . "<br/><br/>";
//        }
//        include_once("views/loginForm.php");   // Else prompt login form
//
//        echo '<h2>Login</h2>';
//
//        echo '<form method="post" action="' . $_SERVER['SCRIPT_NAME'] . '" name="loginform">';
//        echo '<label for="login_input_username">Username (or email)</label> ';
//        echo '<input id="login_input_username" type="text" name="user_name" required /> ';
//        echo '<label for="login_input_password">Password</label> ';
//        echo '<input id="login_input_password" type="password" name="user_password" required /> ';
//        echo '<input type="submit"  name="login" value="Log in" />';
//        echo '</form>';
//
//        echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '?action=register">Register new account</a>';
    }

    /**
     * Simple demo-"page" with the registration form.
     * In a real application you would probably include an html-template here, but for this extremely simple
     * demo the "echo" statements are totally okay.
     */
    private function showPageRegistration() {
        $_SESSION['message'] = $this->feedback;
//        if ($this->feedback) {
//            echo $this->feedback . "<br/><br/>";
//        }
//        echo '<h2>Registration</h2>';
//
//        echo '<form method="post" action="' . $_SERVER['SCRIPT_NAME'] . '?action=register" name="registerform">';
//        echo '<label for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label>';
//        echo '<input id="login_input_username" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />';
//        echo '<label for="login_input_email">User\'s email</label>';
//        echo '<input id="login_input_email" type="email" name="user_email" required />';
//        echo '<label for="login_input_password_new">Password (min. 6 characters)</label>';
//        echo '<input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />';
//        echo '<label for="login_input_password_repeat">Repeat password</label>';
//        echo '<input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />';
//        echo '<input type="submit" name="register" value="Register" />';
//        echo '</form>';
//
//        echo '<a href="' . $_SERVER['SCRIPT_NAME'] . '">Homepage</a>';
    }

    public function createLinkResetPassword() { // Harvest submitted e-mail address
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = $_POST['email'];
        } else {
            $_SESSION['message'] = "O email não é válido!";
            return false;
            ;
        }

        // Require credentials for DB connection.
//            require ('config/dbconnect.php');
        // prepare sql and bind parameters
        if ($this->createDatabaseConnection()) {
            $sql = "SELECT email FROM users WHERE email = ?";
            $query = $this->db_connection->prepare($sql);
            $query->bindParam(1, $email);
            $query->execute();
            $result_row = $query->fetchObject();
            if ($result_row) {
                // If e-mail and reset_code exist and are correct then update user is_activated value.
                $sql = "UPDATE users SET reset_code = ? WHERE email = ?";
                $forgot_password_key = password_hash($email, PASSWORD_DEFAULT);
                $query = $this->db_connection->prepare($sql);
                $query->bindParam("1", $forgot_password_key);
                $query->bindParam("2", $email);
                $query->execute();

//                $_SESSION['SuccessMessage'] = 'User has been created!';

                $message = "Foi enviado para o seu email instrucções para definir uma nova password.";
//                msg= Prezado usuário, \ n \ nSe este e-mail não se aplicar a você, ignore-o. Parece que você solicitou uma redefinição de senha em nosso site www.yoursitehere.com \ n \ nPara redefinir sua senha, clique no link abaixo. Se você não conseguir clicar nele, cole-o na barra de endereço do navegador da Web. \ N \ n ". $ Pwrurl." \ N \ nObrigado, \ nA Administração
//                $message = "htp://localhost/caraMetade/email=" . $email . "?codigo=". $forgot_password_key . "";
//                http://localhost/caraMetade/reset_password.php?email=filipe.martins.400@gmail.com&codigo=$2y$10$jaBnUtGuF8ZvAVGDw2t4TePkzJpwr1Ms/CZeDXA8pwj0mndW0e.MK
//                $to = $email;
//                $subject = "Reset password";
//                $from = 'test@membership.com'; // Insert the e-mail from where you want to send the emails.
//                $body = '<a href="YOURWEBSITEURL/password_reset.php?email=' . $email . '&key=' . $forgot_password_key . '">password_reset.php?email=' . $email . '&key=' . $forgot_password_key . '</a>'; // Replace YOURWEBSITEURL with your own URL for the link to work.
//                $headers = "From: " . $from . "\r\n";
//                $headers .= "Reply-To: " . $from . "\r\n";
//                $headers .= "MIME-Version: 1.0\r\n";
//                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//                mail($to, $subject, $body, $headers);
                $_SESSION['message'] = $message;
                return true;
            } else {
                $_SESSION['message'] = "O email não existe!";
            }
        }
        return false;


//        $select = mysql_query("select email,password from user where email='$email'");
//        if (mysql_num_rows($select) == 1) {
//            while ($row = mysql_fetch_array($select)) {
//                $email = md5($row['email']);
//                $pass = md5($row['password']);
//            }
//        }
    }

    public function verifyReset_code() {
        if ($this->createDatabaseConnection() && isset($_GET["email"]) && isset($_GET["codigo"])) {
            // Variables for reset code
            $user_email = htmlspecialchars($_GET['email']);
            $reset_code = htmlspecialchars($_GET['codigo']);

            // prepare sql and bind parameters
            $sql = "SELECT email, reset_code FROM users
                    WHERE email = :email AND reset_code = :reset_code LIMIT 1";
            $query = $this->db_connection->prepare($sql);
            $query->bindParam(':email', $user_email);
            $query->bindParam(':reset_code', $reset_code);
            $query->execute();

            $result_row = $query->fetchObject();
            if ($result_row) {
                return true;
            }
        }
    }

    public function createNewPassword() {
        try {
            if ($this->createDatabaseConnection()) {
                $email = $_POST['email'];
                $pass = $_POST['password3'];

                $user_password_hash = password_hash($pass, PASSWORD_DEFAULT);

                $sql = "UPDATE users SET password = ?, reset_code = ? WHERE email = ?";
                $query = $this->db_connection->prepare($sql);
                $query->bindParam(1, $user_password_hash);
                $query->bindValue(2, "");
                $query->bindParam(3, $email);
                $query->execute();
                $_SESSION['message'] = "Password alterada com êxito!";
                return true;
            }
        } catch (Exception $exc) {
            $_SESSION['message'] = "Erro definindo a nova password!";
        }
    }
    
    public function getPerfisCriterioProcura($procuro, $distrito, $idadeInf, $idadeSup) {
        // prepare sql and bind parameters
        $sql = "SELECT nome, data_nasc, Estado_Civil, Descricao FROM perfil
                WHERE procura = :procuro AND  distrito = :distrito AND ( (data_nasc >= :idade_inferior) && (data_nasc >= :idade_superior)) ";
        $query = $this->db_connection->prepare($sql);
        $query->bindParam(':procuro', $procuro);
        $query->bindParam(':distrito', $distrito);
        $query->execute();
    }
    
    private function getUserIdByName($username) {
        $sql = "SELECT id FROM users WHERE id = config.userid";
        $query = $this->db_connection->prepare($sql);
        $query->execute();
        return 1; 
    }
    
    public function getUserProcuroParams() {
        $userid = $this->getUserIdByName($_SESSION['username']);
        $sql = "SELECT procuro, distrito, data_nasc FROM config WHERE userid = :userid";
        $query = $this->db_connection->prepare($sql);
        $query->bindParam(':procuro', $_SESSION['procuro']);
        $query->execute();
        $_SESSION['procuro'] = ""; 
    }

}

//end class

if (!isset($application))
    $application = new OneFileLoginApplication();
