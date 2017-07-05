<?php


namespace Core\Email;

require('lib/PHPMailer/class.smtp.php');
// use App\Lib\PHPMailer;
require('lib/PHPMailer/class.phpmailer.php');


class Email{
    protected $id;
    protected $description;
    protected $sujet;
    protected $message;
    protected $destinataires;
    //SETTERS
    public function setId($id){
        $this->id=intval($id);
    }
    public function setDescription($description){
        $this->description=trim($description);
    }
    public function setSujet($sujet){
        $this->sujet=trim($sujet);
    }
    public function setMessage($message){
        $this->message=trim($message);
    }
    public function setDestinataires($destinataires){
        $this->destinataires=trim($destinataires);
    }
    //GETTERS
    public function getid(){
        return $this->id;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getSujet(){
        return $this->sujet;
    }
    public function getMessage(){
        return $this->message;
    }
    public function getDestinataires(){
        return $this->destinataires;
    }
    public function envoieEmail(){
        // require "private/PHPMailer/PHPMailerAutoload.php";
        $mail = new PHPmailer();
        $mail->IsSMTP();
        $mail->IsHTML(true);

        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only

        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Username   = "esgi-geographic@gmail.com";

        $mail->Password   = "esgiGeographic";
        // $mail->SetFrom($expediteur, $prenom.' '.$nom);



        $mail->From='esgi-geographic@gmail.com';
        $mail->AddAddress($this->destinataires);
        $mail->AddReplyTo('esgi-geographic@gmail.com');



        $mail->Subject = $this->sujet;

        $mail->CharSet = "utf-8";
        $mail->Body=$this->message;
        if(!$mail->Send()){ //Teste si le return code est ok.
            echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7)
        }
        else{


            echo 'Mail envoye avec succes</br>';


        }
        $mail->SmtpClose();
        unset($mail);
    }




    public function envoieEmailComms(){
        // require "private/PHPMailer/PHPMailerAutoload.php";
        $mail = new PHPmailer();
        $mail->IsSMTP();
        $mail->IsHTML(true);

        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only

        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Username   = "social.media.wedo@gmail.com";

        $mail->Password   = "wedoawesome";
        // $mail->SetFrom($expediteur, $prenom.' '.$nom);



        $mail->From='social.media.wedo@gmail.com';
        $mail->AddAddress($this->destinataires);
        $mail->AddReplyTo('social.media.wedo@gmail.com');



        $mail->Subject = $this->sujet;

        $mail->CharSet = "utf-8";
        $mail->Body=$this->message;
        if(!$mail->Send()){ //Teste si le return code est ok.
            echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7)
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