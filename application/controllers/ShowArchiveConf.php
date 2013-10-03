<?PHP


// 1.Show the details of the selected project  
// 2. Approve or reject a project

class ShowArchiveConf extends CI_Controller {

		function index(){

				//echo '<p>Value received is '. $this->input->post('Choice1'). '</p>';
				session_start();
				$data['myClass']=$this;
				$data['action']=0;

			if($_SESSION['usertype']==1){
				$this->load->view('layout',$data);
			} elseif ($_SESSION['usertype']==2){
				$this->load->view('layoutComm',$data);
			} elseif($_SESSION['usertype']==3){
				$this->load->view('layoutChairman',$data);
			}
			else{
			
			header("location:/rp/login");
			}
			}
    // Displays the details of the project
	function load_php()
	{
		if ($_POST['check'] == 'VIEW BLOCK')
		{
			$blockstring = $_POST['selectblock'];
			//$blockselected = $_POST['blockselected'];
			//echo $blockselected;
			$this->load->model('conference_model');
			$status='completed';
			//$Query= $this->conference_model->conference_blockwiseconference($status,$block);
			$Queryblock= $this->conference_model->conference_blocks($status);
			if ($Queryblock->num_rows() <> 0)
			{
				foreach($Queryblock->result() as $row1)
				{
				$str = 'Apr '.(2010+3*($row1->Block_number)).' to Mar '.(2013+3*($row1->Block_number));
				//echo $str;
				//$str = 2010+(3*$row1->Block_number to Mar) '.'.2013+3*$row1->Block_number.';
				If ( $str == $blockstring)
					$block = $row1->Block_number;
				//else
				//	$block = 'block not found';
				//echo '<option size =30 selected>Apr '.(2010+3*($row1->Block_number)).' to Mar '.(2013+3*($row1->Block_number)).'</option>';
				//echo '<input type="hidden" name="blockselected" value='.$row1->Block_number.'>';
				}
				header("Location: /rp/Conf_completed?block=".$block);
				//echo $block;
			}
			//header("Location: /rp/Conf_completed");
		}
		if ($_POST['check'] == 'VIEW')
		{
					 //echo 'load project called    ';
					 $Conference = $this->input->post('Choice1');
					 //echo $Project;
					 $this->load->model('conference_model');
					  //pass the projectId of the selected project
					 
					 echo '
				   <script src="/rp/static/js/jquery-latest.js"></script>
				   <script type="text/javascript" src="/rp/static/js/jquery.validate.js"></script>
				   <style type="text/css">
				   * { font-family: Verdana; font-size: 96%; }
				   label { width: 10em; float: left; }
				   label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
				   p { clear: both; }.submit { margin-left: 12em; }
				   em { font-weight: bold; padding-right: 1em; vertical-align: top; }
				   </style>
				   <script>
				   $(document).ready(function(){
				   $("#commentForm").validate();
				   });
				   </script>
				   <FORM name="approveConference" class = "cmxform" id="commentForm" method= "POST" action="ShowArchiveConf/approveConf">';

					 $Query= $this->conference_model->conferenceInfo($Conference);
					 echo '<table class="table table-bordered"> 
					
					 <thead>
							<tr>
							</tr>
					</thead>
					<tbody>';
					 
					 
									
					$tableHeader= '<TR><TD><h4>ConferenceTitle</h4></TD><TD><h4>Faculty Member</h4></TD><TD><h4>Conference Date</TD><TD><h4>Title of Paper</TD><TD><h4>Co-Author (if any)</TD><TD><h4>Source of Funding</TD></TR>';
					//$tableHeader= $tableHeader.'</TR>';
					 echo $tableHeader;
					 //echo '<TR><TD><h4>ProjectTitle</h4></TD><TD><h4>Work Order Id</h4></TD><TD><h4>ProjectCategory</TD><TD><h4>ProjectGrant</TD><TD><h4>App_Date</TD><TD><h4>Researcher1</TD><TD><h4>Researcher2</TD><TD><h4>Researcher3 </h1>';
					 foreach($Query->result() as $row)
					 {
						 echo '<TR><TD>';
						 print $row->ConferenceTitle;
						 echo '</TD><TD>';
						 print $row->Researcher1;
						 echo '</TD><TD>';
						 print $row->Start_Date;
						 echo '</TD><TD>';
						 print $row->PaperTitle;
						 echo '</TD><TD>';
						 print $row->Researcher2;
						 echo '</TD><TD>';
						 print $row->Funding;
						 echo '</TD>';
						 
						
						
					 }
					 
					 echo '</tbody> </TABLE>';

					$Result= $this->conference_model->getcomment($Conference, $_SESSION['usertype']);
					 echo '<table class="table table-bordered"> 
					
					 <thead>
							<tr>
							</tr>
					</thead>
					<tbody>';
					 $tableHeader= '<TR><TD><h4>Comment</h4></TD><TD><h4>Comment Type</h4></TD><TD><h4>Added by user</h4></TD><TD><h4>Added on</h4>';
					 
					 echo $tableHeader;
					 foreach($Result as $row1)
					 {
						 echo '<TR><TD>';
						 print $row1->Comment;
						 echo '</TD><TD>';
						 print $row1->Comment_type;
						 echo '</TD><TD>';
						 print $row1->User;
						 echo '</TD><TD>';
						 print $row1->Date;
						
					 }
					 
					 echo '</tbody> </TABLE>';
					
					echo'<a href="downloadfile?file=upload/'.$Conference.'_title">Download Full Paper</a><br><br>';
					echo'<a href="downloadfile?file=upload/'.$Conference.'_fees">Download Website Registration & Payment details</a><br><br>';
					echo'<a href="downloadfile?file=upload/'.$Conference.'_budget">Download Budget Declaration</a><br><br>';
					echo'<a href="downloadfile?file=upload/'.$Conference.'_acceptance">Download Acceptance Letter</a><br><br>';
					//echo'<a href="downloadfile?file=upload/'.$Conference.'_grouprecommendation">Download Group Recommendation</a><br><br>';
					echo '<p>Please enter comments for Blocking*</p>
					 <p> <label for="cname">Name</label>
					<em>*</em><input id="cname" name="name" size="25" class="required" minlength="2" /></p>
					 <p><label for="ccomment">Comments</label><em>*</em><textarea name="comment"></textarea></p>';
					echo '<input type= submit value= "Cancel The Conference" name="block"><input type="hidden" name=ConfID value="'.$Conference.' " >';
					/*if ($_SESSION['usertype']==1)
					{
					
					 echo'<a href="printfile?file='.$Project.'" target="_blank">Print</a><br><br>';
					 //echo '<p>Please enter comments for appoving/rejecting (mandatory)*</p><p><textarea name="comment"></textarea></p>';
					}*/
					
					/*if ($_SESSION['usertype']!=2)
					{
					 echo '<p>Please enter comments for appoving/rejecting (mandatory)*</p>
					 <p> <label for="cname">Name</label>
					<em>*</em><input id="cname" name="name" size="25" class="required" minlength="2" /></p>
					 <p><textarea name="comment"></textarea></p>';
					}*/
					
					 /*if ($_SESSION['usertype']==1)
					 {
					 echo '<input type= submit value= "Forward To Chairman" name="approve"><input type= submit value= "Send for Revision" name="approve"><input type="hidden" name=projectID value="'.$Project.' " >'; //Hidden to pass the projectId without showing it to the user
					 }
					 else if ($_SESSION['usertype']==2)
					 {
					 echo '<input type= submit value= "Forward With Approval" name="approve"><input type="hidden" name=projectID value="'.$Project.' " >'; //Hidden to pass the projectId without showing it to the user
					 }
					 else
					 {
						if ($_SESSION['usertype']=='3' && $row->PStatus=='app_chairman_2' || $row->PStatus=='app_comm')
						{
							$commStr= '';
							if($row->comm_approval == 0){
							$commStr = $commStr."No Committee Member ";
							}
							
							if($row->comm_approval == 2 || $row->comm_approval == 5 || $row->comm_approval == 6 || $row->comm_approval == 9){
							$commStr = $commStr."Committee1 ";
							}
							if($row->comm_approval == 3 || $row->comm_approval == 5 || $row->comm_approval == 7 || $row->comm_approval == 9){
							$commStr = $commStr."Committee2 ";
							}
							if($row->comm_approval == 4 || $row->comm_approval == 6 || $row->comm_approval == 7 || $row->comm_approval == 9){
							$commStr = $commStr."Committee3";
							}
							echo '<h4>Approved by ';
							echo $commStr;
							echo '</h4>';
							echo '<input type= submit value= "Approve" name="approve"><input type= submit value= "Revision" name="approve"><input type="hidden" name=projectID value="'.$Project.' " >';
						}
						elseif ($_SESSION['usertype']=='3' && $row->PStatus=='app_chairman_1')
						{
							echo '<input type= submit value= "Forward To Committee" name="approve"><input type= submit value= "Review" name="approve"><input type="hidden" name=projectID value="'.$Project.' " >';
						}						
					 }*/
					 echo '</FORM>';
		}
	}
	
	//function to approve or reject project based on the user's selection
	function approveConf(){
		session_start();
		$data['myClass']=$this;
		$data['action']=2;
			
		
		$this->load->model('conference_model');
		if ($_POST['block']=='Block')
		{
			$Query= $this->conference_model->changeStatus('cancelled',$_POST['ConfID']);
			$this->conference_model->insertComment($_SESSION['username'],$_SESSION['usertype'],$_POST['ConfID'],addslashes(trim($_POST['comment'])),"admin_block");
			$data['msg']='Blocked';
			$this->load->view('layout',$data);
			
		}
		//echo '@#usertype is :'.$_SESSION['usertype'];
		//echo 'project value:'.$_POST['projectID'];
		/*if($_POST['approve']=='Approve' OR $_POST['approve']=='Forward To Committee' OR $_POST['approve']=='Forward To Chairman' OR $_POST['approve']=='Forward With Approval')
		{
			$data['msg']='Approved';
			if($_SESSION['usertype']==1)
			{
				
				$Query= $this->project_model->changeStatus('app_chairman_1',$_POST['projectID']);
				$this->project_model->insertComment($_SESSION['username'],$_SESSION['usertype'],$_POST['projectID'],addslashes(trim($_POST['comment'])),"admin_forward");
				$this->load->view('layout',$data);
			} 
			elseif ($_SESSION['usertype']==2)
			{
				if($_SESSION['username']=="comm")
					$Query= $this->project_model->changeStatusComm(2,'app_chairman_2',$_POST['projectID']);
				elseif($_SESSION['username']=="comm1")
					$Query= $this->project_model->changeStatusComm(3,'app_chairman_2',$_POST['projectID']);
				elseif($_SESSION['username']=="comm2")
					$Query= $this->project_model->changeStatusComm(4,'app_chairman_2',$_POST['projectID']);
				
				//$this->project_model->insertComment($_SESSION['username'],$_SESSION['usertype'],$_POST['projectID'],addslashes(trim($_POST['comment'])),"committee_approve");
				$this->load->view('layoutComm',$data);
			}
			elseif ($_SESSION['usertype']==3 && $_POST['approve']=='Approve')
			{
				
				$Query= $this->project_model->changeStatus('approved',$_POST['projectID']);
				$this->project_model->insertComment($_SESSION['username'],$_SESSION['usertype'],$_POST['projectID'],addslashes(trim($_POST['comment'])),"chairman_approve");
				$this->load->view('layoutChairman',$data);
			}
			elseif($_SESSION['usertype']==3 && $_POST['approve']=='Forward To Committee')
			{
				$to = "nippagupta@iimcal.ac.in";
				$subject = "New Project Consultation";
				$message = "Hello Research Committee members,
FPR Chairperson has sent a new project application for consultation. Please login to research portal (link below) to review it. 
fpr.iimcal.ac.in
fpr.iimcal.ac.in/rp/login
FPR Office.";
				$from = "fpoffice@iimcal.ac.in";
				$headers = "From:" . $from;
				$stat = mail($to,$subject,$message,$headers);
				//echo $stat;
				$Query= $this->project_model->changeStatus('app_comm',$_POST['projectID']);
				$this->project_model->insertComment($_SESSION['username'],$_SESSION['usertype'],$_POST['projectID'],addslashes(trim($_POST['comment'])),"chairman_approve");
				$this->load->view('layoutChairman',$data);
			}
			else
			{
			header("location:/rp/login");
			}

			
			//$this->load->view('layout',$data);

		}*/
		/*else
		{
		    
			$data['msg']='Rejected';
			if($_SESSION['usertype']==1)
			{
							$Query= $this->project_model->changeStatus('revisionAdmin',$_POST['projectID']);
							$this->project_model->insertComment($_SESSION['username'],$_SESSION['usertype'],$_POST['projectID'],addslashes(trim($_POST['comment'])),"admin_reject");
							$this->load->view('layout',$data);
			}
			elseif ($_SESSION['usertype']==2)
			{
							
							$this->project_model->insertComment($_SESSION['username'],$_SESSION['usertype'],$_POST['projectID'],addslashes(trim($_POST['comment'])),"committee_reject");
							$this->load->view('layoutComm',$data);
			}
			elseif ($_SESSION['usertype']==3)
			{
							$Query= $this->project_model->changeStatus('revisionChairman',$_POST['projectID']);
							$this->project_model->insertComment($_SESSION['username'],$_SESSION['usertype'],$_POST['projectID'],addslashes(trim($_POST['comment'])),"chairmain_reject");
							$this->load->view('layoutChairman',$data);
			}
			else{
			header("location:/rp/login");
			}

			
		}*/
		
	}
	
	function approveMsg($status){
		if($status=='Blocked')
			{
			echo 'Conference has been cancelled.';
			}
		else
			{
			echo 'Project has been sent for revision.';
			}
		/* $queryStr='SELECT PStatus FROM project WHERE ProjectId = "'.$value.'";';
		// echo $queryStr;
		$query = $this->db->query($queryStr);
		
		if($_SESSION['usertype']==3 && ){
		if($status=='Approved')
			{
			echo 'Project has been approved.';
			}
		else
			{
			echo 'Project has been sent for revision.';
			}
		}
		else{
		if($status=='Approved')
			{
			echo 'Project has ***** been sent for consultation.';
			}
		else
			{
			echo 'Project has been sent for revision.';
			}
		} */
		
	}
}
?>