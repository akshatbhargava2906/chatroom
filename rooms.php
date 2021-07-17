<?php

    $roomname = $_GET['roomname'];

    include 'db_connect.php';

    $sql = "SELECT * FROM `room` WHERE roomname = '$roomname'";


    $result = mysqli_query($conn, $sql);
    if($result)
    {
        if(mysqli_num_rows($result) == 0)
        {
            $message = "This room does not exists";
            echo '<script language="javascript">;';
            echo 'alert("'.$message.'");';
            echo 'window.location="http://localhost/Chatroom";';
            echo '</script>';
        }
        else
        {

        }

    }

    else
    {
        echo "ERROR :". mysqli_error($conn, $roomname);
    }

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- Custom styles for this template -->
<link href="css/styles.css" rel="stylesheet">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

.anyClass{
  height: 350px;
  overflow-y: scroll;
}
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php"><- Back to Main Menu</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
  </div>
</nav>

<h2>Chat Messages - <?php echo $roomname; ?></h2>

<div class="container">
  <div class="anyClass">
    
  </div>
</div>

<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Add Message"><br>
<button type="button" class="btn btn-secondary" name="submitmsg" id="submitmsg">Send</button>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
  //If user submits form

  //check for new messages every 1 sec
  setInterval(runFunction, 1000);
  function runFunction() 
  {
    $.post("htcont.php", {room: '<?php echo $roomname ?>'}, 
    function(data, status)
    {
      document.getElementsByClassName('anyClass')[0].innerHTML = data;
    }
    
    )
  }

  // Get the input field
var input = document.getElementById("usermsg");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("submitmsg").click();
  }
});

  $("#submitmsg").click(function(){
    var clientmsg = $("#usermsg").val();
    $.post("postmsg.php", {text: clientmsg, room: '<?php echo $roomname ?>', ip: '<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
    function(data, status){
      document.getElementsByClassName('anyClass')[0].innerHTML = data;});
      $("#usermsg").val("");
  return false;
  });

</script>
</body>
</html>
