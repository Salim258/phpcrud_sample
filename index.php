<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.0/pulse/bootstrap.min.css" integrity="sha384-t87SWLASAVDfD3SOypT7WDQZv9X6r0mq1lMEc6m1/+tAVfCXosegm1BvaIiQm3zB" crossorigin="anonymous">
</head>
  <section> 
   <nav class="navbar navbar-expand-lg navbar-light bg-primary" id="navbar">
   <a class="navbar-brand" id="navbar-links" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
    <!-- <span class="navbar-toggler-icon"></span> -->
  </button>

<style>
  #navbar-links{
    color: white;
    font-size: 15px;
  }
  #navbar{
    padding: 10px;
  }
</style>

  <div class="collapse navbar-collapse" id="navbarColor03">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" id="navbar-links" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="navbar-links" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="navbar-links" href="#">Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="navbar-links" href="#">About</a>
      </li>
    </ul>
  </div></nav>
  </section>
<body>

  <?php require_once 'process.php'; ?>

  <?php 
      
      if (isset($_SESSION['message'])): ?> 
      <div class = "alert alert-<?=$_SESSION['msg_type']?>">
      <?php 
        echo $_SESSION['message']; 
        unset($_SESSION['message']); 
      ?>
      </div>
  
  <?php endif; ?>

<?php $mysqli = new mysqli($servername,$username,$password,$dbname) or die (mysqli_error($mysqli));   
  $result = $mysqli->query("SELECT * FROM crud"); ?>

  <div class="container"> 
  <div class="row-justify-content-center">
    <table class="table">

      <thead>
        <tr>
          <th>Name</th>
          <th>Location</th>
          <td colspan="2">Action</td>
        </tr>
      </thead>

      <?php 
        while ($row = $result->fetch_assoc()): ?>
          <div class="container">
            <tr>
              <td><?php echo $row['name'];?></td>
              <td><?php echo $row['location'];?></td>
              <td>
                <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info" name="edit">&nbsp; Edit &nbsp;</a>
                <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger" name="delete">Delete</a>
              </td>
            </tr>  
          </div>
       <?php endwhile; ?>

    </table>
  </div>
  </div>

<div class="row-justify-content-center"><div class="container"><br>
<form action="process.php" method="POST">
  <div class="container">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="form-group">
		<label>Name</label>
		<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your Name">
	</div>
	<div class="form-group">
		<label>Location</label>
		<input type="text" name="location" class="form-control" value="<?php echo $location; ?>" placeholder="Enter your Location">
	</div>
	<div class="form-group">
    <?php  
      if ($update == true):
    ?>
		<button type="submit" name="update" class="btn btn-info">Update</button>
    <?php 
      else:
    ?>
     <button type="submit" name="save" class="btn btn-primary">Submit</button>
    <?php  
      endif;
    ?>
	</div>

  </div>
</form>
</div></div>

</body>
</html>