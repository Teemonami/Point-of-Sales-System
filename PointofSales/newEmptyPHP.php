
<?php
session_start();
$connect= mysqli_connect('localhost', 'root', '', 'test');
if(isset($_POST["addtocart"]))
{
   if (isset($_SESSION["shopping_cart"]))
   {
       $item_array_id= array_column($_SESSION["shopping_cart"], "item_id");
     if(!in_array($_GET["id"], $item_array_id))
     {
       $count=count($_SESSION["shopping_cart"]);
       $item_array= array(
            'item_id'            =>   $_GET["id"],
           'item_name'          =>   $_GET["hidden_name"],
           'item_price'         =>   $_GET["hidde_price"],
           'item_quantity'      =>   $_GET["quantity"]
       );
       $_SESSION["shpping_cart"][$count]=$item_array;
     }
     else
         {
        echo'<script>alert("item already added")</script>';
        echo '<script>window.location="newEmptyPHP.php"</script>';
         
     }
   }
   else
   {
       $item_array=array(
           'item_id'            =>   $_GET["id"],
           'item_name'          =>   $_GET["hidden_name"],
           'item_price'         =>   $_GET["hidde_price"],
           'item_quantity'      =>   $_GET["quantity"]
           
           
       );
       $_SESSION["shopping_cart"] [0] =  $item_array;
               }   
   }
?>

<!DOCTYPE html>
<html>
<head>
<style>
    * {
  box-sizing: border-box;
}

/* Create three equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */


table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
    <a href="index.php">ddd</a>
<h2 align="center">Food Cart</h2>

  <?php
     $query="SELECT * FROM tbl_product";
     $result=mysqli_query($connect,$query);
     if (mysqli_num_rows($result)> 0) 
         
     {
         while($row= mysqli_fetch_array($result))
         {
             ?>


  
<div class="row">
  <div class="column" style="background-color:#aaa;">
    <table>
  <tr>
    <th>Items</th>
    <th>Price</th>
    <th>Quantity</th>
  </tr>
  <tr>
      
      <td> <?php echo$row["name"]; ?>
     <td> <?php echo$row["price"]; ?>
      
       </td>
  
<td>  <input type="text" name="quantity" value="1" />    </td>  
<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
 <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                    
   
  </tr>
  



</table>
  </div>
    <?php
     }
         }
        ?>
  <div class="column" style="background-color:#bbb;">
      <h3>ORDER DETAILS</h3>
      <table>
      <tr>
          <th width="40%"> Item Name</th>
           <th width="10%"> Quantity</th>
            <th width="20%"> Price</th>
             <th width="15%">Total</th>
              <th width="5%"> Action</th>
          
          
      </tr>
      <?php
      if(!empty($_SESSION["shopping_cart"]))
      {
          $total= 0;
          foreach($_SESSION["shopping_cart"] as $keys => $values)
          {
      ?>
      <tr>
          <td><?php echo $values["item_name"]; ?> </td>
           <td><?php echo $values["item_quantity"]; ?> </td>
            <td>$  <?php echo $values["item_price"]; ?> </td>
            <td> <?php echo number_formatformat($values["item_quantity"]* $values["item_price"], 2);  ?></td>
             <td><a href="newEmptyPHP.php?action=delete=<?php echo $values["item_id"]; ?>"><span class="text-danger" >Remove</span></a></td>
 <?php
 
 $total=$total + ($values["item_quantity"] * $values["item_price"]);
      }
     ?> 
      <tr>
          <td colspan="3" align="right"> Total</td>
          <td align="right"> $<?php echo number_format($total,2); ?> </td>
          <td></td>
         <?php
         
          } 
 ?>
             
          
      </tr>
      </table>
  </div>

<h4 align="center">
 <input type="submit" name="addtocart" value="Add to Cart">
</h4>
</body>
</html>
