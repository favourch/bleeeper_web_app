<?php
ob_start();
session_start();
?>
<div style="overflow-y:scroll;max-height:40%;">
<?php
include('../bleeeperphp/conn.php');
$sid=base64_decode($_SESSION['id']);
$gid=$_POST['grpid'];
$email=$uname=$fname=$mname=$lname=$count=$city=$resi=$id=$qid=NULL;
$x=0;
$q=0;


$sql="SELECT * FROM grp_msg_tb WHERE group_id='$gid' AND message_type='file'";
$query=mysqli_query($con,$sql);
while($res2=mysqli_fetch_array($query))
{


$qid=$res2['sender_id'];
$fileshared=$res2['file_share'];


$sql="SELECT * FROM profiling_tb WHERE id='$qid'";
$query2=mysqli_query($con,$sql);
$res=mysqli_fetch_array($query2); 
    
    
$id=$res['id'];
$email=$res['email'];
$uname=$res['username'];
$fname=$res['first_name'];
$mname=$res['middle_name'];
$lname=$res['last_name'];
$count=$res['country'];

			/*Pic fetch*/
			$idz=$res['id'];
			$sql="SELECT * FROM  ppic_tb WHERE user_id='$idz' AND ppic_state='1'";
			$qchck=mysqli_query($con,$sql);
			$dir="./bleeeperimg/blankuserimg.jpg";
			$dircatch=NULL;
			while($qv=mysqli_fetch_array($qchck)){
			$ppic=$qv['ppic_link'];
			$dircatch="../file_data/".$idz."/".$ppic;
			}
			if($dircatch!=NULL){
			$dir=$dircatch;
			}
			/*Pic fetch*/
			$dircatchdownload=base64_encode("../../group_data/".$gid."/".$fileshared);
			$downloaddir="'tabgroups/download.php/?thread=".$dircatchdownload."&name=".$fileshared."'";
			$ttt="'_blank'";
			




$x=$x+1;
  
echo '<div class="search-field"><img src="'.$dir.'"/><div class="details">'.$fname.' '.$mname.' '.$lname.'<br/><br/>'.$fileshared.'<br/><br/>'.$res2["date_and_time"].'<br/><br/></div>
<input type="button" id="invite_grp_user" value="Download this file" onClick="window.open('.$downloaddir.','.$ttt.');"/>
</div>';


}


if($x==0)
echo "<div class='failed' >There are no files shared in this group</div>";


?>
</div>