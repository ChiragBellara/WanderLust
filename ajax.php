<?php
include 'connection.php';
?>

<?php
session_start();
$email = $_SESSION["email"];
    $name = "";
    $result1 = mysqli_query($conn,"SELECT stat FROM users WHERE email_id='" . $email . "'");
  
  while($row1 = $result1->fetch_assoc()){
    $stat = $row1['stat'];
    if($stat==0){
      header("location: complete_registeration.php");
    }
  }
  $query = "SELECT * FROM users WHERE email_id='$email'";
        $result1 = mysqli_query($conn,$query);

        while($row1 = mysqli_fetch_array($result1)){
                $userid = $row1['userid'];
                $useridint = (int)$userid;
        }


$output = '';
if(isset($_POST["query"]))
{
    
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM users 
    WHERE stat=1 AND 
    (fname LIKE '%".$search."%'
	OR lname LIKE '%".$search."%' 
    OR username LIKE '%".$search."%')
     
	";
}
else
{
	$query = "
	SELECT * FROM users WHERE stat=1 ORDER BY username";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
	$output = '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Username</th>
                            <th>Name</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
        $userid = $row['userid'];
        $relation = "SELECT * FROM friends WHERE (userid1 = $useridint and userid2 = $userid) OR (userid1 = $userid and userid2 = $useridint)";
        $result1 = mysqli_query($conn,$relation);

        if(mysqli_num_rows($result1) > 0){
            while($row1 = mysqli_fetch_array($result1)){
            $stat = $row1['stat'];
            $initiated = $row1['initiated'];
            if($stat==0){
                    if($initiated == $useridint){
                    $output .= '
                    <tr>
                        <td>'.$row["username"].'</td>
                        <td>'.$row["fname"].' '.$row["lname"].'</td>
                        <td>'.'<button type="button" class="btn btn-info">Awating Response</button>'.'</td>
                        <td>'.' '.'</td>
                        <td>'.' '.'</td>
                        <td>'."<form action=main.php method='POST'>
                        <input type=hidden value=$userid name=globalid>
                        <button type='submit' name='viewglobal' class='btn btn-success'>View</button></form>".'</td>
                    </tr>
                ';
                }
                else{
                  $output .= '
                    <tr>
                        <td>'.$row["username"].'</td>
                        <td>'.$row["fname"].' '.$row["lname"].'</td>
                        <td>'."<form action=main.php method='POST'>
                        <input type=hidden value=$userid name=globalid>
                        <button type='submit' name='acceptfriendrequest' class='btn btn-success'>Accept Request</button></form>".'</td>
                        <td>'."<form action=main.php method='POST'>
                        <input type=hidden value=$userid name=globalid>
                        <button type='submit' name='rejectfriendrequest' class='btn btn-warning'>Reject Request</button></form>".'</td>
                        <td>'."<form action=main.php method='POST'>
                        <input type=hidden value=$userid name=globalid>
                        <button type='submit' name='blockuser' class='btn btn-danger'>Block User</button></form>".'</td>
                        <td>'."<form action=main.php method='POST'>
                        <input type=hidden value=$userid name=globalid>
                        <button type='submit' name='viewglobal' class='btn btn-success'>View</button></form>".'</td>
                    </tr>
                ';  
                }
            }
            else if($stat==1){
                    $output .= '
                        <tr>
                            <td>'.$row["username"].'</td>
                            <td>'.$row["fname"].' '.$row["lname"].'</td>
                            <td>'.'<button type="button" class="btn btn-default">Friend</button>'.'</td>
                            <td>'.' '.'</td>
                            <td>'.' '.'</td>
                            <td>'."<form action=main.php method='POST'>
                            <input type=hidden value=$userid name=globalid>
                            <button type='submit' name='viewglobal' class='btn btn-success'>View</button></form>".'</td>
                        </tr>
                    ';
            }
            else if($stat==2){
                if($initiated == $useridint){
                    $output .= '
                    <tr>
                        <td>'.$row["username"].'</td>
                        <td>'.$row["fname"].' '.$row["lname"].'</td>
                        <td>'."<form action=main.php method='POST'>
                        <input type=hidden value=$userid name=globalid>
                        <button type='submit' name='resendfriendrequest' class='btn btn-warning'>Request Rejected,Resend</button></form>".'</td>
                        <td>'.' '.'</td>
                        <td>'.' '.'</td>
                        <td>'."<form action=main.php method='POST'>
                        <input type=hidden value=$userid name=globalid>
                        <button type='submit' name='viewglobal' class='btn btn-success'>View</button></form>".'</td>
                    </tr>
                ';
                }
                else{
                  $output .= '
                    <tr>
                        <td>'.$row["username"].'</td>
                        <td>'.$row["fname"].' '.$row["lname"].'</td>
                        <td>'.'<button type="button" class="btn btn-warning">Rejected By You</button>'.'</td>
                        <td>'."<form action=main.php method='POST'>
                        <input type=hidden value=$userid name=globalid>
                        <button type='submit' name='friendrequesttorejected' class='btn btn-primary'>Add Friend</button></form>".'</td>
                        <td>'.' '.'</td>
                        <td>'."<form action=main.php method='POST'>
                        <input type=hidden value=$userid name=globalid>
                        <button type='submit' name='viewglobal' class='btn btn-success'>View</button></form>".'</td>
                    </tr>
                ';  
                }
                

            }
            else if ($stat==3){
                if($initiated == $useridint){
                    $output .= '
                    <tr>
                        <td>'.$row["username"].'</td>
                        <td>'.$row["fname"].' '.$row["lname"].'</td>
                        <td>'.'<button type="button" class="btn btn-danger" disabled=disabled>Blocked By User</button>'.'</td>
                        <td>'.' '.'</td>
                        <td>'.' '.'</td>
                        <td>'."<form action=main.php method='POST'>
                        <input type=hidden value=$userid name=globalid>
                        <button type='submit' name='viewglobal' class='btn btn-success'>View</button></form>".'</td>
                    </tr>
                ';
                }
                else{
                  $output .= '
                    <tr>
                        <td>'.$row["username"].'</td>
                        <td>'.$row["fname"].' '.$row["lname"].'</td>
                        <td>'.'<button type="button" class="btn btn-danger" disabled=disabled>Blocked By You</button>'.'</td>
                        <td>'."<form action=main.php method='POST'>
                        <input type=hidden value=$userid name=globalid>
                        <button type='submit' name='unblockuser' class='btn btn-warning'>Unblock</button></form>".'</td>

                        <td>'."<form action=main.php method='POST'>
                        <input type=hidden value=$userid name=globalid>
                        <button type='submit' name='unblockandsendrequest' class='btn btn-primary'>Unblock and Send Request</button></form>".'</td>
                        <td>'."<form action=main.php method='POST'>
                        <input type=hidden value=$userid name=globalid>
                        <button type='submit' name='viewglobal' class='btn btn-success'>View</button></form>".'</td>
                    </tr>
                ';  
                }



            }
        }
        }
        else{
            if($useridint == $userid){
                      $output .= '
                <tr>
                    <td>'.$row["username"].'</td>
                    <td>'.$row["fname"].' '.$row["lname"].'</td>
                    <td>'.'<button type="button" class="btn btn-info">Hey There It is You</button>'.'</td>
                    <td>'.' '.'</td>
                    <td>'.' '.'</td>
                    <td>'."<form action=main.php method='POST'>
                    <input type=hidden value=$userid name=globalid>
                    <button type='submit' name='viewglobal' class='btn btn-success'>View</button></form>".'</td>

                </tr>
            ';

            }
            else{
                  $output .= '
                <tr>
                    <td>'.$row["username"].'</td>
                    <td>'.$row["fname"].' '.$row["lname"].'</td>
                    <td>'."<form action=main.php method='POST'>
                        <input type=hidden value=$userid name=globalid>
                        <button type='submit' name='sendfirstfriendrequest' class='btn btn-primary'>Add Friend</button></form>".'</td>
                    <td>'.' '.'</td>
                    <td>'.' '.'</td>
                    <td>'."<form action=main.php method='POST'>
                    <input type=hidden value=$userid name=globalid>
                    <button type='submit' name='viewglobal' class='btn btn-success'>View</button></form>".'</td>

                </tr>
            ';
            }
            
              
        }
		
	}
	echo $output;
}
else
{
	echo 'Data Not Found';
}
?>
