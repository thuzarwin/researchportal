<?php

class Homefaculty extends CI_Controller {

function index()
{
session_start();
$data['myClass']=$this; // passing the object for callback
$data['action']=0;      // what spl action to do for this layout

if($_SESSION['usertype']==4){
						$this->load->view('layoutFaculty',$data);
					} 
					else
					{
					header("location:login");
					}
}


function load_php()
{
 include ("homeAdmin.php");
 
 echo 'WELCOME!!! Mr <b>' .$_SESSION['username'].'</b> Please select the options from Menu form Left';  // TODO: Extract First Name from DB and display
 
}
}

?>