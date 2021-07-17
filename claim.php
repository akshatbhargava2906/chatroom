<?php

$room = $_POST['room'];


if(strlen($room)>20 or strlen($room)<2)
{
    //This is telling user to choose a name between 2 to 20 letters.
    $message = "Please choose a name between 2 to 20 letters";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/Chatroom";';
    echo '</script>';
}

else if(!ctype_alnum($room))
{
    //This is telling the user to choose an alphanumerical word.
    $message = "Please choose a Alphanumeric name";
    echo '<script language="javascript">;';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/Chatroom";';
    echo '</script>';
}

else
{
    //If everything is successful then connect to database.
    include 'db_connect.php';
}

$sql = "SELECT * FROM `room` WHERE roomname = '$room'";
$result = mysqli_query($conn, $sql);
if($result)
{
    if(mysqli_num_rows($result) > 0)
    {
        $message = "Room already exists! Please choose a different name";
        echo '<script language="javascript">;';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost/Chatroom";';
        echo '</script>';
    }

    else
    {
        $sql = "INSERT INTO `room` (`roomname`, `stime`) VALUES ('$room', current_timestamp());";
        if(mysqli_query($conn, $sql))
        {
            $message = "Your room is ready!!";
            echo '<script language="javascript">;';
            echo 'alert("'.$message.'");';
            echo 'window.location="http://localhost/Chatroom/rooms.php?roomname=' . $room. '";';
            echo '</script>';
        }
    }
}
else
{
    echo "Error: ". mysqli_error($conn);
}

?>