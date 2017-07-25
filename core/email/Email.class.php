<?php
namespace Core\Email;

/**
 * Class that manage mails sendings
 * For EVERY mail
 */
class Email extends \PHPMailer {

    protected $subject;
    protected $message;
    protected $addressee;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Simple setter for the subject
     * @param : $subject The Subject to be set
     * @return Void
     */
    public function setSubject($subject) {
        $this->subject = trim($subject);
    }

    /**
     * Simple setter for the message
     * @param : $message The Message to be set
     * @return Void
     */
    public function setMessage($message) {
        $this->message = trim($message);
    }

    /**
     * Simple setter for the addressee
     * @param : $addressee The Addressee to be set
     * @return Void
     */
    public function setAddressee($addressee) {
        $this->addressee = trim($addressee);
    }

    /**
     * Simple subject getter
     * @return String $subject the subject of the mail
     */
    public function getSubject() {
        return $this->subject;
    }

    /**
     * Simple message getter
     * @return String $message the message of the mail
     */
    public function getMessage() {
        return $this->message;
    }

    /**
     * Simple addressee getter
     * @return String $addressee the addressee of the mail
     */
    public function getAddressee() {
        return $this->addressee;
    }

    /**
     * Function which send an email
     * based on the parameters of the class
     * @return Void
     */
    public function sendMail() {
        $this->IsSMTP();
        $this->IsHTML(true);
        $this->Host = "smtp.gmail.com";
        $this->Port = 465;
        $this->SMTPDebug = 2;
        $this->SMTPAuth = true;
        // secure transfer enabled REQUIRED for GMail
        $this->SMTPSecure = 'ssl';
        // mail to be created
        $this->Username   = EMAIL_ADMIN;
        // to be created
        $this->Password   = EMAIL_ADMIN_PASSWORD;
        // $mail->SetFrom($expediteur, $prenom.' '.$nom);
        $this->From = EMAIL_ADMIN;
        $this->AddAddress($this->addressee);
        $this->AddReplyTo(EMAIL_ADMIN);
        $this->Subject = $this->subject;
        $this->CharSet = "utf-8";
        $this->Body = $this->message;
        // Test if the return code is OK
        if(!$this->Send()) {
            // Print error message (WARNING:see section 7)
            throw new \Exception($this->ErrorInfo);
        }
        $this->SmtpClose();
        // unset($mail);
    }

}
