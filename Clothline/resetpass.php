<?php
include('connect.php');
if(isset($_POST["email"]) && (!empty($_POST["email"])))
{
    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
    
        echo json_encode(["message" => "error"]);
    
    }
    else{
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $email);
        $stmt->execute();
        $count = $stmt->rowCount();
  
             
        if ($count==""){
            echo json_encode(["message" => "invalid"]);
        }
        else{

            // Query to check the token's validity
            $query = "SELECT * FROM password_reset_temp WHERE  email = :email AND used = 0 AND expDate >= NOW()";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = $stmt->rowCount();

            if ($count === 0) {
                // generate token
                $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
                $expDate = date("Y-m-d H:i:s",$expFormat);
                $key = md5(2418*2);
                $addKey = substr(md5(uniqid(rand(),1)),3,10);
                $key = $key . $addKey;
                // Insert Temp Table
                
                $sql = "INSERT INTO password_reset_temp (email, `key`, expDate, used)VALUES (:email, :keys, :expiry,:used)";
                $query_run = $conn->prepare($sql);
                $data = [
                    ':email' => $email,
                    ':keys' => $key,
                    ':expiry' => $expDate,
                    ':used' => 0];
                $query_execute = $query_run->execute($data);

                if($query_execute){
                
                
                $output='<p>Dear user,</p>';
                $output.='<p>Please click on the following link to reset your password.</p>';
                $output.='<p>-------------------------------------------------------------</p>';
                $output.='<p><a href="http://localhost/Clothline/resetpage.php?
                key='.$key.'&email='.$email.'&action=reset" target="_blank">
                http://localhost/Clothline/resetpage.php
                ?key='.$key.'&email='.$email.'</a></p>';		
                $output.='<p>-------------------------------------------------------------</p>';
                $output.='<p>Please be sure to copy the entire link into your browser.
                The link will expire after 1 day for security reason.</p>';
                $output.='<p>If you did not request this forgotten password email, no action 
                is needed, your password will not be reset. However, you may want to log into 
                your account and change your security password as someone may have guessed it.</p>';   	
                $output.='<p>Thanks,</p>';
                $output.='<p>Mokua Naturals Team</p>';
                $body = $output; 
                $subject = "Password Recovery - Mokua Naturals";
                
                $email_to = $email;
                $fromserver = "noreply@mokuanaturals.com"; 
                require("./vendor/PHPMailer/PHPMailerAutoload.php");
                $phpmailer = new PHPMailer();
                $phpmailer->isSMTP();
                $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
                $phpmailer->SMTPAuth = true;
                $phpmailer->Port = 2525;
                $phpmailer->Username = 'a971bdc60f2ccf';
                $phpmailer->Password = 'a3bc2974a25075';
                $phpmailer->IsHTML(true);
                $phpmailer->From = "noreply@yourwebsite.com";
                $phpmailer->FromName = "MOKUA NATURALS";
                $phpmailer->Sender = $fromserver; // indicates ReturnPath header
                $phpmailer->Subject = $subject;
                $phpmailer->Body = $body;
                $phpmailer->AddAddress($email_to);
                if(!$phpmailer->Send()){
                    echo json_encode(["message" => "Email Error"]);
                }
                else{
                    echo json_encode(["message" => "success"]);                
                }}else{
                    echo json_encode(["message" => "sql error"]); 
                }
            }
            else{
                echo json_encode(["message" => "token_exists"]);
                exit;
            }

        }
        
       
    }
}
else{
    echo json_encode(["message" => "no-data"]);
}
