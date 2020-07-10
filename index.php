<?php 
	
	$errors = "";

   // connect to database

	$db = mysqli_connect('localhost', 'root', '', 'to-do');

	if(isset($_POST['submit']))
	{
		$task = $_POST['task'];
	
		if (empty($task))
		{
		  $errors ="*You must fill in the task";
		}

		else
		{

		  mysqli_query($db,"INSERT INTO tasks (task) VALUES ('$task')");	
		  header('location: index.php');

		}
	}

   //delete task

	if (isset($_GET['del_task']))
	 {
		$id = $_GET['del_task'];

		mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
		header('location: index.php');
	 }

	$tasks = mysqli_query($db, "SELECT * FROM tasks");
	
	
?>

<!DOCTYPE html>
<html>
  <head>
	<title>ToDo List</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body bgcolor=#2F4F4F>

	<div class="headings">
		<h1 style="font-style:'Serif';color:#DC143C ;font-size:90px;background:#FFEBCD;border: 2px solid #6B8E23;text-align:center; text-shadow: 2px 2px;">ToDo List</h1>
	</div>
	<center>
	<form method="POST" action="index.php" class="input_form" style="width: 90%;height:60px;">
		
		  <?php if (isset($errors)) { ?>
		  <p style ="font-size:20px;font-style:serif;"><b><?php echo $errors; ?></b></p>
		  <?php } ?>

		<input type="text" name="task" class="task_input" style="width: 85%;height: 35px;padding: 10px;border: 2px solid #6B8E23;">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
	</form><br>
	</center>

       <table style="background:#FFFAF0; width:75%">
	  <thead>
		<tr>
			<th style="font-size:28px;">No.</th>
			<th style="font-size:28px;">Tasks</th>
			<th style="width: 60px;font-size:28px;">Delete</th>
		</tr>
	  </thead>
	 
	
	 <tbody style="font-size:28px">
	   
	   <?php $i=1; while ($row = mysqli_fetch_array($tasks)) { ?>
		<tr style="text-align:center">
			<td> <?php echo $i; ?> </td>
			<td class="task" style="text-align:center"><i> <?php echo $row['task']; ?></i> </td>
			<td class="delete"> 
			<button style="background-color:rgba(255, 0, 0, 0.4);border-radius:25%;">
			<a style="color: white;background: #a52a2a;border-radius: 3px;text-decoration: none;font-size:18px"
			href="index.php?del_task=<?php echo $row['id']; ?>">X</a> </button>
				
			</td>
		</tr>
	    <?php $i++;} ?>

	  </tbody>
</table>
</body>
</html>

