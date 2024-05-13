<?php
 
class database{
 
    function opencon(){
        return new PDO('mysql:host=localhost; dbname=loginmethod', 'root', '');
    }
    function check($username, $password){
        $con = $this->opencon();
        $query = "SELECT * from users WHERE username='".$username."'&&password='".$password."'";
        return $con->query($query)->fetch();
    }

    function view ()
         {
            $con = $this->opencon();
            return $con->query("SELECT  users.user_id,users.username,users.password,users.firstname,users.lastname,users.birthday,users.sex, CONCAT (user_address.user_add_id, user_address.user_id,user_address.user_add_street,' ',user_address.user_add_barangay,' ',user_address.user_add_city,'',user_address.user_add_province) AS address From users JOIN user_address ON users.user_id=user_address.user_id")->fetchAll();
         }

    function delete($id)
    {
        try{
        $con = $this->opencon();
        $con->beginTransaction();

        //Delete user Address
        $query = $con->prepare("DELETE FROM user_address WHERE user_id = ?");
        $query->execute([$id]);

        //Delete user
        $query2 = $con->prepare("DELETE FROM users WHERE user_id = ?");
        $query2->execute([$id]);

        $con->commit();
        return true; // Deletion Successful
        } catch (PDOException $e) {
            $con->rollback();
            return false;
        }
        }
    }

    function signup($firstname, $lastname, $birthday, $username, $password, $sex){
        $con = $this->opencon();
   
        $query = $con->prepare("SELECT username FROM users WHERE username = ?");
        $query->execute([$username]);
        $existingUser = $query->fetch();
        if ($existingUser){
            return false; // Username already exists
        }
   
        $query = $con->prepare("INSERT INTO users (username, password, firstname, lastname, birthday, sex) VALUES (?, ?, ?, ?, ?,?)");
        return $query->execute([$username, $password, $firstname, $lastname, $birthday,$sex]);
    }
    function signupUser($username, $password, $firstName, $lastName, $birthday, $sex) {
        $con = $this->opencon();
   
        $query = $con->prepare("SELECT username FROM users WHERE username = ?");
        $query->execute([$username]);
        $existingUser = $query->fetch();
        if ($existingUser){
            return false;
        }
        $query = $con->prepare("INSERT INTO users (firstname, lastname, birthday, sex, username, password) VALUES (?, ?, ?, ?, ?,?)");
        $query->execute([$username, $password, $firstName, $lastName, $birthday,$sex]);
        return $con->lastInsertId();

    }function insertAddress($user_id, $city, $province, $street, $barangay) {
        $con = $this->opencon();
        return $con->prepare("INSERT INTO user_address (user_id, user_add_street,user_add_barangay, user_add_city, user_add_province) VALUES (?, ?, ?, ?, ?)")
            ->execute([$user_id, $city, $province, $street, $barangay]);
    }
   
 
