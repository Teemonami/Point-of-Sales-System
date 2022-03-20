<?php include('server.php') 


?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Item Update</h2>
  </div>
	
    <form method="post" action="insertCart.php" enctype="multipart/form-data">
  	<?php include('errors.php'); ?>
     
      
  	<div class="input-group">
          
        
  	  <label>Item Name</label>
  	  <input type="text" name="name" value="<?php echo $name; ?>">
  	</div>
        <div class="input-group">
           <label>Item ID</label>
  	  <input type="text" name="id" value="<?php echo $id; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Price</label>
  	  <input type="integer" name="price" value="<?php echo $price; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Barcode</label>
  	  <input type="barcode" name="barcode">
  	</div>
  	
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Update</button>
  	</div>
  	
  </form>
   
</body>
</html>