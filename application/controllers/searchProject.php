<?PHP
class SearchProject extends CI_Controller{
	
	function index() {
			$data['myClass']=$this;
			$data['action']=0;
			//$this->load->view('layout',$data);
			//vridhi
			session_start();
			if($_SESSION['usertype']==1){
				$this->load->view('layout',$data);
			} elseif ($_SESSION['usertype']==2){
				$this->load->view('layoutComm',$data);
			} elseif($_SESSION['usertype']==3){
				$this->load->view('layoutChairman',$data);
			}
	}
	//Takes input for the search and calls Search function
	function load_php() {
			echo '<h1>Search</h1>';
            echo "<p>Please select filter</p>";
			echo '<FORM name="searchProject" method= POST action="SearchProject/search">';
            echo '<ul class="radiolist">
                <li><input type="radio" name="searchBy" value="ProjectId" /> ProjectId </li>
                <li><input type="radio" name="searchBy" value="Researcher" /> Researcher </li>
                <li><input type="radio" name="searchBy" value="ProjectType" /> Project Type </li>
                <li><input type="radio" name="searchBy" value="ProjectCategory" /> Project Category </li>
                <li><input type="radio" name="searchBy" value="Budget" /> Budget </li>
                <li><input type="radio" name="searchBy" value="Deliverable" /> Deliverable </li>
                <li><input type="radio" name="searchBy" value="ProjectName" /> Project Name </li></ul>';
			echo '<div class="searcharea"><br><input type=text class="searchbox" name="searchValue" placeholder="Enter Search Term"><br>';
			echo '<input type= submit value= "Search" name="search"></div>'; 
		    echo '</FORM>';
	}
	
	
	// Loads the layout 
	function search()
	{
			$data['myClass']=$this;
		    $data['action']=3;
			$data['searchBy']=$_POST['searchBy'];
			$data['searchValue']=$_POST['searchValue'];
		    $this->load->view('layout',$data);	
	}
	
	//Loads the Project Model and searches for the project
	function load_search($searchBy,$searchValue)
	{
		  
		  $this->load->model('project_model');
		 // echo 'Search by '.$searchBy.' value = '.$searchValue;
		  $Query= $this->project_model->projectSearch($searchBy,$searchValue);
	      
		  echo'
		  <FORM METHOD=POST ACTION="http://localhost/ci/index.php/projectDetails">
		  <TABLE width="90%" border="1" bordercolor="#993300" align="center" cellpadding="3" cellspacing="1" class="table_border_both_left"><tr  class="heading_table_top"> 
                     ';
		echo '<TR><TD><h4>ProjectTitle</h4></TD><TD><h4>ProjectId</h4></TD><TD><h4>Description</h4></TD><TD><h4>Researcher</TD><TD><h4>ProjectGrant</TD><TD><h4>App_Date';

			foreach($Query->result() as $row)
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
				 echo '<TD><INPUT TYPE="RADIO" NAME="Choice1" VALUE="'.$row->ProjectId.'"></TD></TR>';
			 }
					 
			 echo '</TABLE>
			<INPUT TYPE=SUBMIT value="Show Details">
			</FORM>';
	}
    

}
?>