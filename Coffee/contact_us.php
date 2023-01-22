<?php
  


$db_name = 'mysql:host=localhost;dbname=contact_us';
$username = 'root';
$password = '';

$conn = new PDO($db_name, $username, $password);

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $coffeename = $_POST['coffeename'];
   $coffeename = filter_var($coffeename, FILTER_SANITIZE_STRING);

   $tablenumber = $_POST['tablenumber'];
   $tablenumber = filter_var($tablenumber, FILTER_SANITIZE_STRING);

   $how_many_order = $_POST['how_many_order'];
   $how_many_order = filter_var($how_many_order, FILTER_SANITIZE_STRING);


   $select_contact = $conn->prepare("SELECT * FROM `order_` where  name = ? AND coffeename = ? AND tablenumber = ? AND how_many_order = ?");
   $select_contact->execute([$name, $coffeename, $tablenumber,$how_many_order]);

   if($select_contact->rowCount() > 0){
      $message[] = 'message sent already!';
   }else{
      $insert_contact = $conn->prepare("INSERT INTO `order_`(name, coffeename, tablenumber,how_many_order) VALUES(?,?,?,?)");
      $insert_contact->execute([$name, $coffeename, $tablenumber,$how_many_order]);
      $message[] = 'message sent successfully!';
   }

}

?>