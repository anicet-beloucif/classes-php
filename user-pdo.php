<?php

//Creation de la classe utilisateur nommé POO :
class Userpoo {

//Definition des attributs de la classe 
    private $_id;
    private $_login;
    private $_password;
    private $_email;
    private $_firstname;
    private $_lastname;
    private $_link;

//Fonction permettant d'enregistrer l'utilisateur dans la bdd

    public function register($_login, $_password, $_email, $_firstname, $_lastname)
{   $this->_login = $_login;
    $this->_password = $_password;
    $this->_email = $_email;
    $this->_firstname = $_firstname;
    $this->_lastname = $_lastname;

    $link = new PDO('mysql:host=localhost;dbname=classes','root','');
    $this->_link = $link;
    $SQL1 = "INSERT INTO utilisateurs(login, password, email, firstname, lastname) VALUES ('$_login','$_password','$_email','$_firstname','$_lastname')";
    $SQL2 = "SELECT * FROM utilisateurs WHERE login = '$_login'";
    $query1 = $link->query($SQL1);
    $query2 = $link->query($SQL2);
    $res = $query2->fetch(PDO::FETCH_ASSOC);
    return $res;
}

//Fonction permettant de connecter l'utilisateur 

public function connect($_login, $_password) {
    $this->_login = $_login;
    $this->_password = $_password;

    $link = new PDO('mysql:host=localhost;dbname=classes','root','');
    $this->_link = $link;
    $SQL = "SELECT * FROM utilisateurs WHERE login='$_login'";
    $query = $link->query($SQL);
    $res = $query->fetch(PDO::FETCH_ASSOC);

    if ($res == null) 
    { echo "L'utilisateur n'existe pas";
        $this->disconnect();
    }
        else {
            if($_password == $res['password']) {
                $this->_login = $res['login'];
                $this->_password = $res['password'];	
                $this->_email = $res['email'];
                $this->_firstname = $res['firstname'];
                $this->_lastname = $res['lastname'];
                echo 'connexion reussie';
                return $res; }
        
        else {
            echo 'Cela ne semble pas fonctionner';
            $this->disconnect();

        }

        }

    }

//Fonction permettant de deconnecter l'utilisateur     

public function disconnect() {
        $this->_login ='';
        $this->_password = '';
        $this->_email = '';
        $this->_firstname = '';
        $this->_lastname = '';
        echo 'deconnexion reussie';
            }

//Fonction permettant de deconnecter l'utilisateur puis de le supprimer de la BDD            

public function delete() {
    $_login=$this->_login;

    $link = new PDO('mysql:host=localhost;dbname=classes','root','');
    $this->_link = $link;
    $SQL = "DELETE * from utilisateurs WHERE login = '$_login'";
    $query = $link->query($SQL);
    echo 'le profil utilisateur est bien supprime';
            }

//Fonction permettant de mettre a jour les donnees d'un utilisateur dans la BDD

public function update($_login,$_password,$_email,$_firstname,$_lastname) {

    $logOG = $this->_login;
    $this->_login = $_login;
    $this->_password = $_password;
    $this->_email = $_email;
    $this->_firstname = $_firstname;
    $this->_lastname = $_lastname;

    $link = $this->_link;
    $link = new PDO('mysql:host=localhost;dbname=classes','root','');
    $SQL="Update utilisateurs SET login='$_login, password='$_password', email='$_email', firstname='$_firstname', lastname='$_lastname' WHERE login='$logOG'";
    $query= $link->query($SQL);
    echo 'les donnes utiisateurs ont bien ete mises a jour.';
}

//Fonction permettant de verifier qu'un utilisateur est bien connecte

public function isConnected() {
    if (!($this->_login == '')){return true;}
    else {return false;}
}

//Fonction permettant de sortir toutes les informations d'un utilisateur choisi

public function getAllInfos() {
    $_login = $this->_login;
    $link = new PDO('mysql:host=localhost;dbname=classes','root','');
    $this->_link = $link;
    $SQL = "SELECT * FROM utilisateurs WHERE login = '$_login'";
    $query= $link->query($SQL);
    $res= $query->fetch(PDO::FETCH_ASSOC);

}

//Fonction affichant le login du compte actuel

public function getLogin() {

    return ['login' => $this->_login];
}

//Fonction affichant le email du compte actuel

public function getEmail() {

    return ['email' => $this->_email];
}

//Fonction affichant le firstname du compte actuel

public function getFirstname() {

    return ['firstname' => $this->_firstname];
}

//Fonction affichant le lastname du compte actuel

public function getLastname() {

    return ['lastname' => $this->_lastname];
}






}


?>