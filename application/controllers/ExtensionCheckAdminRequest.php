<?PHP

class ExtensionCheckAdminRequest extends CI_Controller 
{
	function index()
		{			
		$data['myClass']=$this;
		$data['action']=0;
		$this->load->view('layout',$data);
		}
	function load_php()
				{
				$ProjectID = $_POST['ProjectSelected'];
				$this->load->model('project_model');
				echo'
					<FORM METHOD=POST ACTION="#">
					<TABLE width="90%" border="1" bordercolor="#993300" align="center" cellpadding="3" cellspacing="1" class="table_border_both_left"><tr  class="heading_table_top"> 
							';
					if ($_POST['RequestType'] == 'Approve')
						{
						$this->project_model->projectExtensionAdminResponse('Approve',$ProjectID);
						header("Location: /rp/extension");
						} 
					else if ($_POST['RequestType'] == 'Reject') 
						{
						$this->project_model->projectExtensionAdminResponse('Reject',$ProjectID);
						header("Location: /rp/extension");
						}
					echo "\n\n";
					//echo $msg;
					 echo '</TABLE>
					</FORM>';
                
				
				}
	
	}
?>