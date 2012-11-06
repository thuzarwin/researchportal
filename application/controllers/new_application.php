<?php

class New_application extends CI_Controller {

				function index()
				{
					session_start();
					$data['myClass']=$this;
					$data['action']=0;
					//$this->load->view('layout',$data);
					if($_SESSION['usertype']==1){
						$this->load->view('layout',$data);
					} elseif ($_SESSION['usertype']==2){
						$this->load->view('layoutComm',$data);
					} elseif($_SESSION['usertype']==3){
						$this->load->view('layoutChairman',$data);
					}
					
				}

				function load_php()
				{
					 
					 
					 $this->load->model('project_model');
					 $data['query']= $this->project_model->getProjects();
					 
					 echo '
                     <h1>New Applications</h1>
					 <FORM METHOD=POST ACTION="ShowProject">
                    <table class="table table-bordered">
					<tr><TD><h4>ProjectTitle</h4></TD><TD><h4>ProjectId</h4></TD><TD><h4>Application Date</h4></TD><TD><h4>Researcher1</h4></TD><TD><h4>Researcher2</TD><TD><h4>Select</h1></TD></tr>
					
					<tbody>';
					 $flag=0;
					 foreach($data['query'] as $row)
					 {
						 $flag++;
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
					     echo '<TD><INPUT TYPE="RADIO" NAME="Choice1" VALUE="'.$row->ProjectId.'"></TD></TR>';
					 }
					 if($flag==0){
					 echo '<h4>No New Applications</h4> <br > </tbody> </TABLE>';
					 }
					 else
					 {
					 echo '</tbody>
					 </TABLE>
					 <INPUT TYPE=SUBMIT value="Submit">
					</FORM>';
				}
				
				 
				 
				 
				}

}


?>