-- atom the set all file  
 require_once('../php/configer.php');
$conn = new mysqli($servername, $username, $password, $dbname);
--  save the data local point 
htmlspecialchars($row['email'])
-- create a tabel user 
 CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    photo VARCHAR(200) NOT NULL,
    bath VARCHAR(20) NOT NULL,
    verifay VARCHAR(40) NOT NULL,
    phone VARCHAR(13) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- profile photo chenge html 
 <form id="myform" action='/databases/account.php' method='POST' enctype='multipart/form-data'>
                <input oninput='editimg()' type='file' class='myinput' name='photo' id='editprofile' accept="image/*" >
            </form>





-- saved the Delete photo
CREATE TABLE delete (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userid VARCHAR(10) NOT NULL,
   uploaded TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

-- free databases 
<?php
$servername = "sql10.freesqldatabase.com";  
$username = "sql10740079";         
$password = "ck5NEBGAUC";            
$dbname = "sql10740079"; 
?>


-- save the oracel app 
 <!-- Account Btn -->
          <button onclick="accountprofile()" class="systembtn accbtn">
            <i class="bi bi-person-circle"></i> &nbsp; 
             Account
          </button>
          <!-- Documents Btn -->
          <button onclick="" class="systembtn accbtn">
            <i class="fa-solid fa-file-invoice"></i>
              &nbsp; Documents 
          </button>