<?php

class user 
{
    //on stocke les attributs de la classe entre les {}
private $id;
public $login;
public $email;
public $firstname;
public $lastname;

//Fonction de constructeur
public function __construct($login,$password,$email,$firstname,$lastname){

// la variable $this -> permet l'acces direct aux informations de l'objet en cours
    $this->bdd = mysqli_connect("localhost","root","","classes");
    $this->login = $login;
    $this->password = $password;
    $this->email = $email;
    $this->firstname = $firstname;
    $this->lastname = $lastname;

}
//Fonction permettant d'enregistrer l'utilisateur dans la bdd
public function register() {
//insere les donnees dans la bdd representee par bdd    
    $insert = mysqli_query($this->bdd,"INSERT INTO 'utilisateurs' ('login','email','password','firstname','lastname') VALUES ('$this->login', '$this->email, '$this->password', '$this->firstname', '$this->lastname')");
//selectionne les donnees dans la bdd correspondant au login precise dans l'instance par $this->login
    $request = mysqli_query ($this->bdd, "SELECT*FROM 'utilisateurs' WHERE login = '$this->login'");
//affiche un tableau contenant les donnes correspondant a l'utilisateur, representee par la variable $request, a laquelle on appose la fonction fetch_array
// Mysqli_assoc = tableau associatif , mysqli_num = tableau numerique, mysqli_both = les deux
    $result = $request->fetch_array(mysqli_assoc);
}

//A FAIRE/ A COMPRENDRE connecte l'utilisateur si $_login=$login et $_password=$password
public function connect ($_login, $_password) 
    {

        $login=$this->login;
        $password=$this->password;

        
        // Fonction mysqli pour se connecter à la base de donner
        $connect = mysqli_connect('localhost', 'root', '', 'classes');
        
        // Requête SQL pour selectionner table utilisateurs 
        $request = "SELECT * FROM utilisateurs";

        // Fonction mysqli qui exécute une requête sur la base de données
        $query = mysqli_query($connect, $request);

        //  Fonction mysqli qui récupère toutes les lignes de résultats dans un tableau
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);


        // Boucle pour voir si l'utilisateur est bien connecté ou pas
        for ($i = 0; isset($result[$i]); $i++) {
            $id = $result[$i]['id'];
            $passwordcheck = $result[$i]['password'];
            $logincheck = $result[$i]['login'];


            if ($login == $logincheck && $password == $passwordcheck) {
                $_SESSION['id'] = $id;
                var_dump($_SESSION['id']);
                echo "You are connected" . '<br/>';
            }
        }
        if ($passwordcheck == FALSE) {
            echo "Error";
        }


    }

// Deconnecte l'utilisateur
public function disconnect() {
    session_destroy();
}

//Supprime et deconnecte l'utilisateur
public function delete() {
    $this->login = $_SESSION['login'];
    $delete = mysqli_query($this->bdd, "DELETE FROM 'utilisateurs' WHERE 'login = $this->login'");
    session_destroy();
}

// Met a jour les attributs de l'objet, puis applique les modifications sur la BDD
public function update($login, $password, $email, $firstname, $lastname){
    $this->bdd = mysqli_connect("localhost","root","","classes");
    $request = mysqli_query($bdd,"UPDATE utilisateurs SET login=$login, password=$password, email=$email, firstname=$firstname, lastname=$lastname Where id = $this->id");}

//Verifie la connection de l'User a la bdd
public function isConnected() {
    if(isset($_SESSION['login']))
        {return true;}
    else {return false;}
}

//Retourne un tableau contenant les informations de l'utilisateur !id!

public function getAllInfos(){
    $bdd = mysqli_connect("localhost","root","","classes");
    $req = mysqli_query($bdd,"SELECT * from utilisateurs");
    $res = mysqli_fetch_all($req);
foreach($res as $key => $value){ 
    echo '<tr>';
    foreach ($value as $key1 => $value1) 
    {
    echo "<td>$value1</td>";  
    }
    echo '</tr>'; 
    }
    return $value1;
}

// Retourne le login de l'utilisateur connecte
public function getLogin() {
    // verifie qu'il y a bien un utilisateur actuellement connecte.
    if($_SESSION['login'] !==""){
    $user = $_SESSION['login'];
    echo "l'utilisateur suivant est bien connecte";
    return $user;
    }
}

// Retourne l'email de l'utilisateur connecte
public function getEmail(){
if ($_SESSION['email'] !==""){
    $user = $_SESSION['email'];
    return $user;
}

}

//Retourne le firstname de l'utilisateur connecte
public function getFirstName() {
    if ($_SESSION['first_name'] !=="") {
        $user = $_SESSION['first_name'];
        return $user;
    }
}

//Retourne le lastname de l'utilisateur connecte
public function getLastname() {
    if ($_SESSION['lastname'] !=="") {
        $user = $_SESSION['lastname'];
        return $user;
    }


}
}








?>