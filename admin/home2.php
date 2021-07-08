<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>testing</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	
	<link href="https://bootswatch.com/3/flatly/bootstrap.css" rel="stylesheet">
</head>
<body>
	<div class="container-fluid">
		
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">DRI Admin</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<h2 class="text-center">All Applications</h2>

<div class="row">
			<div class="col-lg-12">
				 <!-- <table class="table table-striped table-hover table-responsive"> -->
				 	<table id="applications" class="table table-bordered display " style="width:100%">
                      <tr>
                      <th>Action</th>
                      <th>Fullname</th>
                      <th>Profile Image Path(Front)</th>
                      <th>Profile Image Path(Back)</th>
                      <th>DOB</th>
                      <th>State</th>
                      <th>Address</th>
                      <th>Zip</th>
                      <th>Gender</th>
                      <th>Driver's License</th>
                      <th>Weight</th>
                      <th>Current Job</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>SSN</th>
                      <th>Age</th>
                      <th>City</th>
                      <th>Agree to Terms and Conditions?</th>
                      <th>Credit Score</th>
                      <th>Date Created</th>
                      </tr>
                      </thead>
                      <tfoot>
                      <tr>
                      <th>Action</th>
                      <th>Fullname</th>
                      <th>Profile Image Path(Front)</th>
                      <th>Profile Image Path(Back)</th>
                      <th>DOB</th>
                      <th>State</th>
                      <th>Address</th>
                      <th>Zip</th>
                      <th>Gender</th>
                      <th>Driver's License</th>
                      <th>Weight</th>
                      <th>Current Job</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>SSN</th>
                      <th>Age</th>
                      <th>City</th>
                      <th>Agree to Terms and Conditions?</th>
                      <th>Credit Score</th>
                      <th>Date Created</th>
                      </tr>
                      </tfoot>
</table>

			</div>
</div>



	</div>


	 <script type="text/javascript">
       $(document).ready(function(){
              
                var applications = $('#dataTableServer').DataTable({
                "scrollX": true,
                "processing": true,
                "serverSide": true,
                "ajax": "server_tables/all_applications.php",
                // 'pagingType': 'numbers'
                // "order": [[ 2, "asc" ]],
                // "columnDefs": [
                // { "render": applications,
                // "data": null,         
                // "targets": [0], "width": "9%", "targets": 0 },
                // ]
                } );




       });
  </script>

</body>
</html>