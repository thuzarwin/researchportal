<?PHP

class Ongoing extends CI_Controller {
	
	function index()
		{
		    	
			$data['myClass']=$this;
					$data['action']=0;
					//vridhi
					session_start();
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
				echo '<h1> Ongoing Applications </h1>';
				//Load the project model
                //Query for the ongoing projects (!= completed and rejected)
				// Display the results
                
				$this->load->model('project_model');
				$status='approved';
				$Query= $this->project_model->project_status($status);
				
				echo '<TABLE class="table table-bordered"><tbody>';
                echo '<TR><TD><h4>ProjectTitle</h4></TD>
                    <TD><h4>ProjectId</h4></TD>
                    <TD><h4>Description</h4></TD>
                    <TD><h4>ProjectCategory</TD>
                    <TD><h4>ProjectGrant</TD>
                    <TD><h4>App_Date</TD>
                    <TD><h4>Researcher1</TD>
                    <TD><h4>Researcher2</TD>
                    <TD><h4>Researcher3</h1></TD></tbody>';
	 
					 foreach($Query->result() as $row)
					 {
						 echo '<TR><TD>';
						 print $row->ProjectTitle;
						 echo '</TD><TD>';
						 print $row->ProjectId;
						 echo '</TD><TD>';
						 print $row->Description;
						 echo '</TD><TD>';
						 print $row->ProjectCategory;
						 echo '</TD><TD>';
						 print $row->ProjectGrant;
						 echo '</TD><TD>';
						 print $row->App_Date;
						 echo '</TD><TD>';
						 print $row->Researcher1;
						 echo '</TD><TD>';
						 print $row->Researcher2;
						 echo '</TD><TD>';
						 print $row->Researcher3;
					 }
				echo '</TABLE>';
				}
	
	}


?>