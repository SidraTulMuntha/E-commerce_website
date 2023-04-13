<?php
$conn=mysqli_connect("localhost","root","","login");
require "PHPMailerAutoload.php";
//set up 
$mail=new PHPMailer;
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'stulmuntha20@gmail.com';                     //SMTP username
$mail->Password   = 'scje zfwr ckfn gzwd';                            //SMTP password
$mail->SMTPSecure = 'tls';             //Enable implicit TLS encryption
$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//Recipients
$mail->setFrom('stulmuntha20@gmail.com','Mailer');
$sql="select * from colab where ID>0";
$res=mysqli_query($conn,$sql);
if(mysqli_num_rows($res)>0){

    //$mail->addAddress('sidratulmuntha.kaif@gmail.com', 'sidra');     //Add a recipient

$mail->addReplyTo('stulmuntha20@gmail.com', 'Information');

$mail->addCC('vanshitachauhan709@gmail.com');

//Attachments
//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
while($x=mysqli_fetch_assoc($res)){
    $mail->addBCC($x['email']);
}
//Content
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = 'Welcome To the journey of EXPRESS BAZAR with us';
$mail->Body    = '<h1><b>Thank You for the collaboration</h1></b>';
$mail->AltBody = 'Express bazar brings you the joys of shopping online, great deals and discounts on quality assured products.Choose from our wide range of products including  
· Electronics-Shop for deals on the latest phones: Samsung Galaxy, Redmi, Apple iPhone, OnePlus & more, phone accessories, Laptops, TVs & more.
· Fashion for all occasions - Shop online for Men’s, Women’s & kids clothes:Shirts,Sarees,dresses,Shoes,Watches, Handbags, jewellery & more.
· Beauty - Shop for cosmetics:Perfumes,Make up,Hair-care & more.
· Media-Books,Music,Video games & more
· Home & Kitchen-Cookware,Tableware,Decor, Furnishing,Cleaning & more.
· Appliances (Refrigerators, Washing Machines etc)
and everything else to suit your needs.
Shopping with us is absolutely simple and hassle-free.Grab the exclusive deals and get products at the lowest prices.';

if($mail->send()){
    echo "JOINNING   MAIL  IS  SEND  TO  YOUR  MAIL  WE  LOVE  TO  WORK  WITH  YOU ...................";
}
else{
echo "Fail to send";
}

}
else{
    echo "no data found";
}
?>