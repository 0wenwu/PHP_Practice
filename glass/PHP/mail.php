<?php
require_once('../plugin/phpmailer/class.phpmailer.php');
//接受表单的值
$address=$_POST['address'];
$tel=$_POST['tel'];
$customer=$_POST['customer'];
@$note=$_POST['note'];
$account="rangnao9881@163.com";
$pwd="zsd193941";
// $to="15967531712@163.com";
$to="1289675427@qq.com";
$article="联系姓名：".$customer.";联系电话：".$tel.";送货地址：".$address.";备注：".$note;

$mail=new PHPMailer();
// $mail->SMTPDebug=1;
$mail->IsSMTP();
$mail->SMTPAuth=true;
$mail->Host='smtp.163.com';
// $mail->SMTPSecure="ssl";
// $mail->Port=465;
$mail->CharSet='utf-8';
$mail->Username=$account;
$mail->Password=$pwd;
$mail->SetFrom($account,'客户');
$mail->AddReplyTo($account,'客户');
$mail->Subject="订单信息";
$mail->MsgHTML($article);
$mail->AddAddress($to);

if($mail->Send())
{
	echo "订单已提交!";
}
else
{
	echo "系统繁忙，订单提交失败，请重新提交!";
}

?>