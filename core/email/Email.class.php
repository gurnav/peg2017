<?php

namespace Core\Email;

require 'lib/PHPMailer/class.smtp.php';
// use App\Lib\PHPMailer;
require ROOT.'core/email/lib/PHPMailer/class.phpmailer.php';


/**
 * Class that manage mails sendings
 * For EVERY mail
 */
class Email {
    protected $id;
    protected $description;
    protected $subject;
    protected $message;
    protected $addressee;

    /**
     * ID Setter for the class only
     * @param Int : $id The id to be set
     * @return Void
     */
    public function setId($id){
        $this->id=intval($id);
    }

    /**
     * Simple setter for the description
     * @param : $description The Description to be set
     * @return Void
     */
    public function setDescription($description){
        $this->description=trim($description);
    }

    /**
     * Simple setter for the subject
     * @param : $subject The Subject to be set
     * @return Void
     */
    public function setSubject($subject){
        $this->subject=trim($subject);
    }

    /**
     * Simple setter for the message
     * @param : $message The Message to be set
     * @return Void
     */
    public function setMessage($message){
        $this->message=trim($message);
    }

    /**
     * Simple setter for the addressee
     * @param : $addressee The Addressee to be set
     * @return Void
     */
    public function setAddressee($addressee){
        $this->addressee=trim($addressee);
    }


    /**
     * Simple id getter
     * @return Int $id the id of the mail
     */
    public function getid(){
        return $this->id;
    }

    /**
     * Simple description getter
     * @return String $description the description of the mail
     */
    public function getDescription(){
        return $this->description;
    }

    /**
     * Simple subject getter
     * @return String $subject the subject of the mail
     */
    public function getSubject(){
        return $this->subject;
    }

    /**
     * Simple message getter
     * @return String $message the message of the mail
     */
    public function getMessage(){
        return $this->message;
    }

    /**
     * Simple addressee getter
     * @return String $addressee the addressee of the mail
     */
    public function getAddressee(){
        return $this->addressee;
    }


    public function envoieEmail(){
        require "lib/phpmailerexe/PHPMailerAutoload.php";

        $mail = new \PHPmailer();
        $mail->IsSMTP();
        $mail->IsHTML(true);

        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;

        // debugging: 1 = errors and messages, 2 = messages only
        //$mail->SMTPDebug = 1;

        // authentication enabled
        $mail->SMTPAuth = true;

        // secure transfer enabled REQUIRED for GMail
        $mail->SMTPSecure = 'ssl';

        // mail to be created
        $mail->Username   = "esgi-geographic@gmail.com";

        // to be created
        $mail->Password   = "esgiGeographic";
        // $mail->SetFrom($expediteur, $prenom.' '.$nom);



        $mail->From='esgi-geographic@gmail.com';
        $mail->AddAddress($this->addressee);
        $mail->AddReplyTo('esgi-geographic@gmail.com');



        $mail->Subject = $this->subject;

        $mail->CharSet = "utf-8";
        $mail->Body=$this->message;

        //Teste si le return code est ok.
        if(!$mail->Send()){

            //Affiche le message d'erreur (ATTENTION:voir section 7)
            echo $mail->ErrorInfo;
        }
        else{
            echo 'Mail envoye avec succes</br>';
        }

        $mail->SmtpClose();

        unset($mail);
    }




    public function envoieEmailComms(){

        $mail = new \PHPmailer();
        $mail->IsSMTP();
        $mail->IsHTML(true);

        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;

        // debugging: 1 = errors and messages, 2 = messages only
        //$mail->SMTPDebug = 1;

        // authentication enabled
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Username   = "esgi-geographic@gmail.com";

        $mail->Password   = "esgiGeographic";
        // $mail->SetFrom($expediteur, $prenom.' '.$nom);



        $mail->From='esgi-geographic@gmail.com';
        $mail->AddAddress($this->addressee);
        $mail->AddReplyTo('esgi-geographic@gmail.com');



        $mail->Subject = $this->subject;

        $mail->CharSet = "utf-8";
        $mail->Body=$this->message;

        //Teste si le return code est ok.
        if(!$mail->Send()){

            //Affiche le message d'erreur (ATTENTION:voir section 7)
            echo $mail->ErrorInfo;
        }
        else{


            echo 'Mail envoyé avec succès</br>';


        }
        $mail->SmtpClose();
        unset($mail);
    }
    public function getForm($pseudo, $email, $avatar){
        return [
            "options" => [
                "method"=>"POST",
                "action"=>"",
                "id"=>"updateForm",
                "submit"=>"Mettre à jour"
            ],
            "struct" => [
                "avatar"=>[ "label"=>"avatar", "type"=>"file", "id"=>"avatar", "placeholder"=>"", "required"=>1, "msgerror"=>"", "value"=>$avatar ],
                "pseudo"=>[ "label"=>"pseudo", "type"=>"text", "id"=>"pseudo", "value"=>$pseudo, "required"=>1, "msgerror"=>"name" ],
                "email"=>[ "label"=>"email", "type"=>"text", "id"=>"email", "value"=>$email, "required"=>1, "msgerror"=>"email" ],
                "password"=>[ "label"=>"mot de passe", "type"=>"password", "id"=>"password", "required"=>1, "msgerror"=>"password" ],
                "passwordconfirm"=>[ "label"=>"confirmation", "type"=>"password", "id"=>"passwordconfirm", "required"=>1, "msgerror"=>"passwordconfirm" ]
            ]
        ];
    }
}