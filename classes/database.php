<?php
 
class database{
 
    function opencon(){
        return new PDO('mysql:host=localhost; dbname=loginmethod', 'root', '');
    }
    // function check($username, $password){
    //     $con = $this->opencon();
    //     $query = "SELECT * from users WHERE username='".$username."'&&password='".$password."'                ";
    //     return $con->query($query)->fetch();
    // }

    function check($username, $password) {
        // Open database connection
        $con = $this->opencon();
    
        // Prepare the SQL query
        $query = $con->prepare("SELECT * FROM users WHERE username = ?");
        $query->execute([$username]);
    
        // Fetch the user data as an associative array
        $user = $query->fetch(PDO::FETCH_ASSOC);
    
        // If a user is found, verify the password
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
    
        // If no user is found or password is incorrect, return false
        return false;
    }

    function view ()
         {
            $con = $this->opencon();
            return $con->query("SELECT  users.user_id,users.username,users.password,users.firstname,users.lastname,users.birthday,users.user_email, users.sex,users.profile_picture, CONCAT (user_address.user_add_id, user_address.user_id,user_address.user_add_street,' ',user_address.user_add_barangay,' ',user_address.user_add_city,'',user_address.user_add_province) AS address From users JOIN user_address ON users.user_id=user_address.user_id")->fetchAll();
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

           

    function signupUser($firstname, $lastname, $birthday, $sex, $email, $username, $password, $profilePicture)
             {
                 $con = $this->opencon();
                 // Save user data along with profile picture path to the database
                 $con->prepare("INSERT INTO users (firstname, lastname, birthday, sex, user_email, username, password, profile_picture) VALUES (?,?,?,?,?,?,?,?)")->execute([$firstname, $lastname, $birthday, $sex, $email, $username, $password, $profilePicture]);
                 return $con->lastInsertId();
                 }
             
    function insertAddress($user_id, $city, $province, $street, $barangay) {
        $con = $this->opencon();
        return $con->prepare("INSERT INTO user_address (user_id, user_add_street,user_add_barangay, user_add_city, user_add_province) VALUES (?, ?, ?, ?, ?)")
            ->execute([$user_id, $city, $province, $street, $barangay]);
    }
   
    function viewdata($id) {
        try {
            $con = $this->opencon();
            $query = $con->prepare("SELECT
            users.user_id,
            users.username,
            users.user_email,
            users.password,
            users.firstname,
            users.lastname,
            users.birthday,
            users.sex,
                user_address.user_add_id,
                user_address.user_id,
                user_address.user_add_street,
                user_address.user_add_barangay,
                user_address.user_add_city,
                user_address.user_add_province
        FROM
            users
        JOIN user_address ON users.user_id = user_address.user_id WHERE users.user_id = ?");
            $query->execute([$id]);
            return $query->fetch();
        } catch (PDOException $e) {
            return[];
        }
    }

    function updateUser($user_id, $firstname, $lastname, $birthday, $sex, $username, $password) {
        try {
            $con = $this->opencon();
            $con->beginTransaction();
            $query = $con->prepare("UPDATE users SET firstname=?, lastname=?, birthday=?, sex=?, username=?, password=? WHERE user_id=?");
            $query->execute([$firstname, $lastname, $birthday, $sex, $username, $password, $user_id]);
            //Update Successful
            $con->commit();
            return true;
        } catch (PDOException $e) {
            // Handle the exception
            $con->rollBack();
            return false;
        }
    }
    
    function updateUserAddress($user_id, $street, $barangay, $city, $province) {
        try {
            $con = $this->opencon();
            $con->beginTransaction();
            $query = $con->prepare("UPDATE user_address SET user_add_street=?, user_add_barangay=?, user_add_city=?, user_add_province=? WHERE user_id=?");
            $query->execute([$street, $barangay, $city, $province, $user_id]);
            //Update Successful
            $con->commit();
            return true;
        } catch (PDOException $e) {
            // Handle the exception
            $con->rollBack();
            return false;
        }
    }
 
}