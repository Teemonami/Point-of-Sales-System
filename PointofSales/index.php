<?php
session_start();
$connect= mysqli_connect('localhost', 'root', '', 'test');
if(isset($_POST["add_to_cart"]))
{
   if (isset($_SESSION["shopping_cart"]))
   {
       $item_array_id= array_column($_SESSION["shopping_cart"], "item_id");
     if(!in_array($_GET["id"], $item_array_id))
     {
       $count=count($_SESSION["shopping_cart"]);
       $item_array= array(
            'item_id'            =>  $_GET["id"],
           'item_name'          =>   $_POST["hidden_name"],
           'item_price'         =>   $_POST["hidden_price"],
           'item_quantity'      =>   $_POST["quantity"]
       );
       $_SESSION["shopping_cart"][$count]=$item_array;
     }
     else
         {
        echo'<script>alert("item already added")</script>';
        echo '<script>window.location="index.php"</script>';
         
     }
   }
   else
   {
       $item_array=array(
           'item_id'            =>   $_GET["id"],
           'item_name'          =>   $_POST["hidden_name"],
           'item_price'         =>   $_POST["hidden_price"],
           'item_quantity'      =>   $_POST["quantity"]
           
           
       );
       $_SESSION["shopping_cart"] [0] =  $item_array;
               }   
   }
if (isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
        
    {
        foreach($_SESSION["shopping_cart"] as $key => $values)
        {
             if($values["item_id"] == $_GET["id"])
             {
                 unset($_SESSION["shopping_cart"][$key]);
                 echo'<script>alert("Item Removed")</script>';
                  echo"<script language='javascript'> window.location='index.php'; </script>";
             }
        }
    }
}
?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
      
        <title></title>
    </head>
    <style>
      .g1{
  width: 100%;
  margin: 0px auto;
  padding: 1px;
  border: 1px solid #B0C4DE;
  background: #white;
  border-radius: 0px 0px 10px 10px;
  text-align-last:center;
  
}
.g4{
    background-color: pink;
}
.g2{
    background-color: black;
    color: white
   
}
 .button1{
    background-color: #5F9EA0;
    color: white;
    padding: 6px ;
    margin: 0px 0;
    border: none;
    cursor: pointer;
   
   float: right;
}
    </style>
    <body>
        
        <a href="insertCart.php">  <button  class="button1"type="submit" style="width:100px;">Update</button></a></div>
        <div class="g2">
    
            <h2 align="left">BIBI's Food Cart</h2></div>
        
        <table><tr>
                
           
         <th align="center" width='6%'> Item</th>
           <th align="center" width='6%'>Price</th>
            <th align="center" width='6%'> Quantity</th>
            </tr></div>
</table>
  <?php
     $query="SELECT * FROM tbl_product ORDER BY id ASC";
     $result=mysqli_query($connect,$query);
     if (mysqli_num_rows($result)> 0) 
         
     {
         while($row= mysqli_fetch_array($result))
         {
             ?>
      
            <form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">    
                <div class="g1">
                    <?php echo $row["name"]; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    
                     $ <?php echo$row["price"];  ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              
                      <input width="50%"type="text" name="quantity" value="1" />
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="submit" name="add_to_cart" value="Add to Cart">
                    <input type="hidden" name="hidden_name" value="<?php echo $row["name"];?>" />
                    <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
               
                          
                </div>    
            </form> 
    
     
    
           <?php
     }
         }
        ?>
        <br>
           <br>   <br>   <br>   <br>   <br>
        <hr>
        <div class="g4">
      <h3>ORDER DETAILS</h3>
      <div>
      <table>
      <tr>
          <th align="center" width='10%'> Item Name</th>
           <th align="center" width='10%'> Quantity</th>
            <th align="center" width='10%'> Price</th>
             <th width="15%">Total</th>
              <th width="5%"> Action</th>
          
          
      </tr>
     

 

 <?php
      if(!empty($_SESSION["shopping_cart"]))
      {
          $total= 0;
          foreach($_SESSION["shopping_cart"] as $key => $values)
          {
      ?>
      <tr>
          <td align="center" width='10%'><?php echo $values["item_name"]; ?> 
           <td align="center" width='10%'><?php echo $values["item_quantity"]; ?> </td>
            <td align="center" width='10%'>$ <?php echo $values["item_price"]; ?> </td>
            <td align="center" width='10%'> <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);  ?></td>
            <td><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span>Remove</span></a></td>
 <?php
 
 $total= $total + ($values["item_quantity"] * $values["item_price"]);
      }
      ?> 
      <tr>
      <tr></tr>
          <td colspan="4" align="right"> Total</td>
          <td align="right"> $  <?php echo number_format($total,2); ?> </td>
          <td>    </td>
         <?php
         
          } 
 ?>
             
      
         </div>    
        
    </body>
     </div>
        
</html>
