<!DOCTYPE html>
<!--

IIIIIIIIII   SSSSSSSSSSSSSSS         GGGGGGGGGGGGG
I::::::::I SS:::::::::::::::S     GGG::::::::::::G
I::::::::IS:::::SSSSSS::::::S   GG:::::::::::::::G
II::::::IIS:::::S     SSSSSSS  G:::::GGGGGGGG::::G
  I::::I  S:::::S             G:::::G       GGGGGG
  I::::I  S:::::S            G:::::G              
  I::::I   S::::SSSS         G:::::G              
  I::::I    SS::::::SSSSS    G:::::G    GGGGGGGGGG
  I::::I      SSS::::::::SS  G:::::G    G::::::::G
  I::::I         SSSSSS::::S G:::::G    GGGGG::::G
  I::::I              S:::::SG:::::G        G::::G
  I::::I              S:::::S G:::::G       G::::G
II::::::IISSSSSSS     S:::::S  G:::::GGGGGGGG::::G
I::::::::IS::::::SSSSSS:::::S   GG:::::::::::::::G
I::::::::IS:::::::::::::::SS      GGG::::::GGG:::G
IIIIIIIIII SSSSSSSSSSSSSSS           GGGGGG   GGGG
                                                  
-->

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Research and conference Management Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link rel="stylesheet" href="http://localhost/rp/static/css/bootstrap.min.css" >
    <link href="http://localhost/rp/static/css/custom.css" rel="stylesheet" type="text/css" >
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>
  <body>

    <div class="mast_head">
        <div class="container">
            <div id="logo"></div>
            <a class="btn logout_btn" href="logout">Logout</a>
        </div> <!-- /container -->
    </div>

    <div class="top_nav">
           <div id="tabbar" class="usual">
            <div class="container">
                <ul id="bars">
                    <li><a href="#resproj" class="selected">Research Projects</a></li>
                    <li><a href="#confs">Conferences</a></li>
                </ul>
                <div id="resproj" style="display: block">
                    <ul> 
                        <li><a  href="FacultyProjOngoing">View Ongoing Projects</a> </li>
						<li><a  href="FacultyProjApp">Apply for Project</a> </li>
						<li><a  href="FacultyProjCompleted">View Completed Projects</a> </li>
                    </ul>
                </div>
                <div id="confs" style="display: none">
                    <ul >
                        <li><a  href="facultyConfApp">Apply for Conference</a> </li>
						<li><a  href="facultyCongoing">Ongoing Conferences</a> </li>
						<li><a  href="facultyCcompleted">Past Conferences</a> </li>
                        </li>
                    </ul>
                </div>
           </div> 
        </div>
    </div>

    <div class="container">
        <div>
			<?php
					if ($action==0)
					{
					$myClass->load_php();
					}
					elseif ($action==1)
					{
					$myClass->load_php($msg);
					}
					
			?>
             </div>
        </div>
    </div>
	<footer>
        <p>Handcrafted by Internet Solutions Group &copy; 2012</p>
    </footer>
    <script src="http://localhost/rp/static/js/jquery.min.js"></script>
    <script src="http://localhost/rp/static/js/bootstrap.min.js"></script>
    <script src="http://localhost/rp/static/js/tabs.min.js"></script>
    <script src="http://localhost/rp/static/js/application.js"></script>
  </body>
</html> 