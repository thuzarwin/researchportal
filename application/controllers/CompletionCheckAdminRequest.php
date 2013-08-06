<?PHP

class CompletionCheckAdminRequest extends CI_Controller 
{
	function index()
		{			
		$data['myClass']=$this;
		$data['action']=0;
		session_start();
			if($_SESSION['usertype']==1){
				$this->load->view('layout',$data);
			} elseif ($_SESSION['usertype']==2){
				$this->load->view('layoutComm',$data);
			} elseif($_SESSION['usertype']==3){
				$this->load->view('layoutChairman',$data);
			}
			else{
			
			header("location:login");
			}
		}
	function load_php()
				{
				$this->load->database();
				$this->load->model('project_model');
				$ProjectID = $_POST['ProjectSelected'];
				//session_start();
				echo'
					<FORM METHOD=POST ACTION="#">
					<TABLE width="90%" border="1" bordercolor="#993300" align="center" cellpadding="3" cellspacing="1" class="table_border_both_left"><tr  class="heading_table_top"> 
							';
					if ($_POST['RequestType'] == 'Checked and Forward To Chairman')
						{
						$this->project_model->projectCompletionAdminResponse('Approve',$ProjectID);
						$this->project_model->insertComment($_SESSION['username'], $_SESSION['usertype'], $ProjectID, addslashes(trim($_POST['comment'])), "admin_approve_completion");
						header("Location: /rp/Completion_admin");
						}
					else if ($_POST['RequestType'] == 'Download Project Description')
						{
						//$Project = $this->input->post('Choice1');
						header("location:/rp/downloadfile?file=upload/".$ProjectID."_description");
						}
					else if ($_POST['RequestType'] == 'Check Deliverables') 
						{
						echo '<br><h1>Deliverables Uploaded</h1> <TABLE width="90%" border="1" bordercolor="#993300" align="center" cellpadding="3" cellspacing="1" class="table_border_both_left"><tr  class="heading_table_top"> 
					 <table class="table table-bordered">
					<tr><TD><h4>Download File</h4></TD><TD><h4>Citations (If Any)</h4></TD></TR>';
						$Path = "upload/".$ProjectID."_";
						//$Path = "upload/".$ProjectID."_";
						$Files = glob($Path."*.*");
						$countuploaded = 0;
						foreach ($Files as $File)
							{
							//echo $File;
							//$Files=(explode('.', $File));
							$countuploaded++;			
/*<<<<<<< HEAD
							$citation = '';
							echo'<a href="download?file='.$File.'">'.$File.'</a>';
							
							$queryStr1='Select citation_text from citation where FileName = "'.substr($File, 7).'";';
							$query1 = $this->db->query($queryStr1);
							foreach($query1->result() as $row)
							{
								$citation = $row->citation_text;
							}
							echo '         Citation:<b>'.$citation.'</b><br>';
							//echo '<br>';
=======*/
							echo'<tr><td><a href="download?file='.$File.'">'.$File.'</a><br></td><td>';
							$tempFile=explode('/',$File);
							$res = $this->project_model->getCitationByFile($tempFile[1],$ProjectID);
							foreach($res->result() as $row)
							{
								echo '<p>';
								print $row->citation_text;
								echo '</p>';
							}
							echo '</td></tr>';
//>>>>>>> d4c56d1471d32b8a4ad7b2260f39cfb7f344ae1e
							}
							echo '</table>';
						echo 'Number of Deliverables uploaded: '.$countuploaded;
						$queryStr='Select * from project where ProjectId = "'.$ProjectID.'";';
						$query = $this->db->query($queryStr);
						$countpromised = 0;
						foreach($query->result() as $row)
							{
							$countpromised = $countpromised + $row->Deliverables;
							$countpromised = $countpromised + $row->cases;
							$countpromised = $countpromised + $row->journals;
							$countpromised = $countpromised + $row->chapters;
							$countpromised = $countpromised + $row->conference;
							$countpromised = $countpromised + $row->paper;
							}
						echo '<br>Number of Deliverables promised: '.$countpromised;
						}
					else if ($_POST['RequestType'] == 'Send For Revision') 
						{
						$to = "nikhil.labh@gmail.com";
						$subject = "Project Application Sent for Revision";
						$message = "Hello,
						
						Admin has sent your project application for Revision.";
						$from = "fpoffice@iimcal.ac.in";
						$headers = "From:" . $from;
						$stat = mail($to,$subject,$message,$headers);
						$this->project_model->projectCompletionAdminResponse('Send For Revision',$ProjectID);
						$this->project_model->insertComment($_SESSION['username'], $_SESSION['usertype'], $ProjectID, addslashes(trim($_POST['comment'])), "admin_reject_extension");
						header("Location: /rp/Completion_admin");
						}
					echo "\n\n";
					//echo $msg;
					 echo '</TABLE>
					</FORM>';
                
				
				}
	
	}
?>