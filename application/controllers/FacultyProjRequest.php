<?PHP

class FacultyProjRequest extends CI_Controller {
	
	function index()
		{
			
		$data['myClass']=$this;
		$data['action']=0;
		$this->load->view('layoutFaculty',$data);
		}
	function load_php()
				{
				$ProjectID = $this->input->post('ProjectChoice');
				//echo $ProjectID;
				//Load the project model
				$this->load->model('project_model');
				$result= $this->project_model->projectSearchByID($ProjectID);
				//echo '<p> hello this is the Project Details Page </p>';
				// Display the results
				echo'
					<FORM METHOD=POST ACTION="#">
					<TABLE width="90%" border="1" bordercolor="#993300" align="center" cellpadding="3" cellspacing="1" class="table_border_both_left"><tr  class="heading_table_top"> 
							';
					if ($_POST['RequestType'] == 'Request For Extension')
						{
						echo 'Request For Extension'; 
						} 
					else if ($_POST['RequestType'] == 'Project Completed') 
						{
						echo 'Project Completed'; 
						}
					/*foreach($result->result() as $row)
						{
						echo '<TR><TD>';
						 print $row->ProjectTitle;
						 echo '</TD><TD>';
						 print $row->ProjectId;
						 echo '</TD><TD>';
						 print $row->App_Date;
						 echo '</TD><TD>';
						 print $row->Researcher1;
						 echo '</TD><TD>';
						 print $row->Researcher2;
						 echo '</TD><TD>';
						 print $row->Researcher3;
						 echo '</TD><TD>';
						 echo '<TD><INPUT TYPE="RADIO" NAME="ProjectChoice" VALUE="'.$row->ProjectId.'"></TD></TR>';
						}			*/ 
					 echo '</TABLE>
					</FORM>';
                
				
				}
	
	}


?>