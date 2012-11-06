
<?PHP

// Connect to the database. To tweak the database settings goto applciation/config/database.php 

class Conference_model extends CI_Model {
     
	//get all the projects details
	function getConferences()
		{
		$this->load->database();
		
		if($_SESSION['usertype']==1)
		{
			$queryStr='SELECT * FROM conference WHERE CStatus = "app_admin" ; ';
		}
		elseif ($_SESSION['usertype']==2)
		{
			$queryStr='SELECT * FROM conference WHERE CStatus = "app_comm" ; ';
		}
		elseif ($_SESSION['usertype']==3)
		{
			$queryStr='SELECT * FROM conference WHERE CStatus = "app_chairman" ; ';
		}
		$query= $this->db->query($queryStr);
		
		return $query->result();
		}
	
	//get a project's details
	function conferenceInfo($Conference)
		{
		//echo 'projectInfo called';
		$this->load->database();
		//$query= $this->db->get('project');
		//echo $Project['Id'];	
		$queryStr='SELECT * FROM conference WHERE ConferenceID = "'.$Conference.'";';
		//echo $queryStr;
		$query = $this->db->query($queryStr);
		return $query;
		}
	
	// Function to change the status of the project
	function changeStatus($status,$Conference)//changing the status of the project
		{
		//echo 'changeStatus called ';
		$this->load->database();
		//echo "Project Name:".$Project;
		$queryStr='UPDATE conference SET  CStatus =\''.$status.'\' WHERE  ConferenceId =\''.$Conference.'\' ;';
		//echo $queryStr;
		$query = $this->db->query($queryStr);
		return $query;
		}
	
	// Get the projects at  committee or chairman's approval pending stage	
	function conference_stage($stage)
		{
		//echo 'project_stage called';
		$this->load->database();
		//$query= $this->db->get('project');
		//echo $Project['Id'];	
		$queryStr='SELECT * FROM conference WHERE CStatus = "app_'.$stage.'";';
		//echo $queryStr;
		$query = $this->db->query($queryStr);
		return $query;
		}	
		
	// Search for project
	function conferenceSearch($type,$value)
		{
		$this->load->database();
		if ($type == 'ConferenceId')
		{
			$queryStr='SELECT * FROM conference WHERE ConferenceId = "'.$value.'";';	
		}
		elseif ($type == 'Researcher')
		{
		   $queryStr='SELECT * FROM conference WHERE Researcher1 LIKE \'%'.$value.'%\';';
		}
		
		$query = $this->db->query($queryStr);
		return $query;

		}
	function getNoConf($user)
		{
		 // SELECT Count(*) from `project` WHERE Researcher1='ankushv' or Researcher2='ankushv'or Researcher3='ankushv'
		 $this->load->database();
		 $queryStr='SELECT Count(*) as "total" from `conference` WHERE Researcher1=\''.$user.'\'';
		 //echo $queryStr;
		 $query = $this->db->query($queryStr);
		 $result = $query->row_array();
		 //echo 'The count of projects is '.$result['total'];
		 if ($result['total']>=3)
			return False;
		 else
		   return True;
		 }
		 //**
		 function conference_status($status) //vridhi
		 {
		 	$this->load->database();
		 	//$query= $this->db->get('project');
		 	//echo $Project['Id'];
		 	$queryStr='SELECT * FROM conference WHERE CStatus = "'.$status.'";';
		 	//echo $queryStr;
		 	$query = $this->db->query($queryStr);
		 	return $query;
		 }
		 
		  function getNoConflast3yr($user)
		 {
		 	// SELECT Count(*) from `project` WHERE Researcher1='ankushv' or Researcher2='ankushv'or Researcher3='ankushv'
		 	$this->load->database();
		 	$queryStr='SELECT Count(*) as "total" from `conference` WHERE (Researcher1=\''.$user.'\' AND Start_Date >= DATE("'.date("Y-m-d").'")) ';
		 	//echo $queryStr;
		 	$query = $this->db->query($queryStr);
		 	$result = $query->row_array();
		 	//echo 'The count of projects is '.$result['total'];
		 	if ($result['total']>=3)
		 		return False;
		 	else
		 		return True;
		 }
		  function getNoConfInBlock($user)
		 {
		 	$curr_block_num=1+floor((date("Y")-2001)/3);//first block is from 1/1/2001 to 31/12/2003
		 	$this->load->database();
		 	$queryStr='SELECT Count(*) as "total" from `conference` WHERE (Researcher1=\''.$user.'\' AND Block_number='.$curr_block_num.') ';
		 	//echo $queryStr;
		 	$query = $this->db->query($queryStr);
		 	$result = $query->row_array();
		 	//echo 'The count of projects is '.$result['total'];
		 	if ($result['total']>=3)
		 		return False;
		 	else
		 		return True;
		 	
		 }
		 function ongoingFacultyConferences($user) //--vridhi
		 {
		 	$this->load->database();
		 	$queryStr='SELECT * FROM conference WHERE (Researcher1 LIKE \'%'.$user.'%\' AND CStatus = \'approved\')';
		 	//echo $queryStr;
		 	$query = $this->db->query($queryStr);
		 	return $query;
		 }
		 function conferenceCompleteFaculty($user)
		 {
		 	$this->load->database();
		 	$queryStr='SELECT * FROM conference WHERE (Researcher1 LIKE \'%'.$user.'%\' AND CStatus = \'completed\')';
		 	//echo $queryStr;
		 	$query = $this->db->query($queryStr);
		 	return $query;
		 }
		function ongoingStudentConferences($user) //--vridhi
		 {
		 	$this->load->database();
		 	$queryStr='SELECT * FROM conference WHERE (Researcher1 LIKE \'%'.$user.'%\' AND CStatus = \'approved\')';
		 	//echo $queryStr;
		 	$query = $this->db->query($queryStr);
		 	return $query;
		 }
		 function conferenceCompleteStudent($user)
		 {
		 	$this->load->database();
		 	$queryStr='SELECT * FROM conference WHERE (Researcher1 LIKE \'%'.$user.'%\' AND CStatus = \'completed\')';
		 	//echo $queryStr;
		 	$query = $this->db->query($queryStr);
		 	return $query;
		 }
		 
		 // Function to get all the projects--vridhi
		 function allConferences()
		 {
		 	//echo 'project_stage called';
		 	$this->load->database();
		 	//$query= $this->db->get('project');
		 	//echo $Project['Id'];
		 	$queryStr='SELECT * FROM conference WHERE CStatus = "approved" OR CStatus = "completed";';
		 	//echo $queryStr;
		 	$query = $this->db->query($queryStr);
		 	return $query;
		 }
		 // Fucntion to get the details of the Project Account --vridhi
		 function getC_Account($conferenceId)
		 {
		 	$this->load->database();
		 	$queryStr='SELECT * FROM c_budget WHERE ConferenceID = "'.$conferenceId.'";';
		 	$query= $this->db->query($queryStr);
		 	return $query->result();
		 }
		 //function to insert the project details into project table (user is Faculty)
		 function insertConference($user,$data)
		 {
		 	$this->load->database();
		 	
		 	//1. Check if co researchers are doing more than 3 projects
		 	//echo 'insertProject called';
			//no logic of co researcher here
		 
		 	//2. Insert value into the project table
		 	//INSERT INTO `researchportal`.`project` (`ProjectTitle`, `ProjectId`, `Description`, `App_Date`, `Start_Date`, `End_Date`, `Researcher1`, `Researcher2`, `Researcher3`, `ProjectCategory`, `ProjectGrant`, `PStatus`, `Deliverables`) VALUES ('Business Leasdership Study', 'P33333', 'Leadership traits study on current business leaders', '2012-09-29', '2012-09-30', '2012-11-20', 'ashishkj11', 'prakhars2013', 'anuragn2013', '2', '100000', 'app_admin', '1 Leadership report');
		 	$queryStr= 'INSERT INTO conference (ConferenceTitle , Description , Start_Date, End_Date, Researcher1 , ConferenceCategory , ConferenceGrant , CStatus) VALUES (\''.$data['title'].'\' , \'' .$data['desc'].'\' , \''.$data['start_date'].'\' , \''.$data['end_date'].'\' , \''.$user.'\' , \''.$data['category'].'\' , \''.$data['grant'].'\' , \'app_admin\' );' ;
		 	//echo '<br>'.$queryStr;
		 	$query = $this->db->query($queryStr);
		 	//$result = $query->result();
		 	$msg='The Conference has been Sent for approval';
		 	return $msg;
		 }
		 // function to get the account status of the project--vridhi
		 function getC_AccStatus ($conferenceId)
		 {
		 	//1. get the project budget
		 	$this->load->database();
		 	$queryStr='SELECT ConferenceGrant FROM conference WHERE ConferenceID = "'.$conferenceId.'";';
		 	$query= $this->db->query($queryStr);
		 	$budget= $query->result();
		 	foreach($budget as $row)
		 	{
		 		//print $row->ProjectGrant;
		 		$account['grant']=$row->ConferenceGrant;
		 	}
		 	//2. Calculate the project spending so far
		 	$queryStr='SELECT * FROM c_budget WHERE ConferenceID = "'.$conferenceId.'";';
		 	$query= $this->db->query($queryStr);
		 	$results['query']=$query->result();
		 	$total=0;
		 	foreach($results['query'] as $row)
		 	{
		 		$total=$total + $row->dataset + $row->communication + $row->photocopying + $row->field + $row->stationery +	$row->domestictravel +	$row->localconveyance	+ $row->accomodation	+ $row->contingency	+ $row->software	+ $row->dessimination ;
		 	}
		 	$account['spent']=$total;
		 	return $account;
		 
		 }
		 // function to insert the account data--vridhi
		 function insertC_Account($data)
		 {
		 	$this->load->database();
		 	$queryStr= 'INSERT INTO c_budget (Date, ConferenceId , registrationCharges , travel , perDiem ,  stay ) VALUES (\''.Date("Y-M-D").'\' , \''.$data['conferenceid'].'\' , \'' .$data['registrationCharges'].'\' , \''.$data['travel'].'\' , \''.$data['perDiem'].'\' , \''.$data['stay'].'\');' ;
		 	//echo '<br>'.$queryStr;
		 	$query = $this->db->query($queryStr);
		 	//$result = $query->result();
		 	$msg='The Account Details have been Added';
		 	return $msg;
		 }
		 function conferenceSearchByID($value)
		{
			$this->load->database();
			$queryStr='SELECT * FROM conference WHERE ConferenceId = "'.$value.'";';
			$query = $this->db->query($queryStr);
			return $query;
		
		}
}
?>