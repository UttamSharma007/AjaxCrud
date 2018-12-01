
<?php
require_once('db.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2 class="text-center">Crud operation with AJAX</h2>
  <!-- Button to Open the Modal -->
  <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">
    Open modal
  </button>

  <!-- Button to Show Records -->
  <button type="button" class="btn btn-light" onclick="show_data()">
    Display
  </button>
  <h2 class="text-center">All Student Records</h2>
  <table class="table table-striped">
    <thead>
      <tr>
      	<th>S No.</th>
        <th>Name</th>
        <th>Father Name</th>
        <th>Email</th>
        <th>Mobile Number</th>
        <th>Degree</th>
        <th>Year</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody id="records">
      
    </tbody>
  </table>

  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Insert Data</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form class="form-group" id="insertdata">
          	<label class="col-form-label">Name:</label> 
          	<input type="text" name="stu_name" id="stu_name" class="input-group">
          	<label class="col-form-label">Father Name:</label> 
          	<input type="text" name="f_name" id="f_name" class="input-group">
          	<label class="col-form-label">Email:</label> 
          	<input type="email" name="email" id="email" class="input-group">
          	<label class="col-form-label">Mobile Number:</label> 
          	<input type="number" name="mobile_number" id="mobile_number" class="input-group">
          	<label class="col-form-label">Degree:</label> 
          	<input type="text" name="degree" id="degree" class="input-group">
          	<label class="col-form-label">Year:</label> 
          	<input type="text" name="year" id="year" class="input-group">
          </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="insert_data()">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <div class="modal" id="editModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Data</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form class="form-group" id="insertdata">
          	<label class="col-form-label">Name:</label> 
          	<input type="text" name="edit_stu_name" id="edit_stu_name" class="input-group">
          	<label class="col-form-label">Father Name:</label> 
          	<input type="text" name="edit_f_name" id="edit_f_name" class="input-group">
          	<label class="col-form-label">Email:</label> 
          	<input type="email" name="edit_email" id="edit_email" class="input-group">
          	<label class="col-form-label">Mobile Number:</label> 
          	<input type="number" name="edit_mobile_number" id="edit_mobile_number" class="input-group">
          	<label class="col-form-label">Degree:</label> 
          	<input type="text" name="edit_degree" id="edit_degree" class="input-group">
          	<label class="col-form-label">Year:</label> 
          	<input type="text" name="edit_year" id="edit_year" class="input-group">
          	<input type="hidden" name="hidden_id" id="hidden_id">
          </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="update_data()">Update</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		show_records();
	});
	function show_records() {
		var records  = 'show';
		$.ajax({
			url		: 'operation.php',
			type	: 'POST',
			data 	: 
			{
				
				records 		: records,

			},
			success: function(data, status){
				if('success' == status) {
					$("#records").html(data);
				}
			}
		});
	}
	function insert_data() {
		//alert($('#stu_name').val());
		var stu_name = $('#stu_name').val();
		var f_name = $('#f_name').val();
		var email = $('#email').val();
		var mobile_number = $('#mobile_number').val();
		var degree = $('#degree').val();
		var year = $('#year').val();

		$.ajax({
			url		: 'operation.php',
			type	: 'POST',
			data 	: 
			{
				
				stu_name 		: stu_name,
				f_name			: f_name,
				email 			: email,
				mobile_number 	: mobile_number,
				degree 			: degree,
				year 			: year,

			},
			success: function(data, status){
				if('success' == status) {
					show_records();
				}
				else{
					alert("ERROR!!!!");
				}
			}
		});
		//alert("here");
	}

	function delete_data(id) {

		var flag = confirm("Are You Sure");
		if(flag){
			$.ajax({
				url		: 'operation.php',
				type	: 'POST',
				data 	: 
				{
					
					id 		: id,

				},
				success: function(data, status){
					if('success' == status) {
						show_records();
					}
				}
			});
		}
	}

	function update_data() {
		//alert($('#stu_name').val());
		var edit_stu_name = $('#edit_stu_name').val();
		var edit_f_name = $('#edit_f_name').val();
		var edit_email = $('#edit_email').val();
		var edit_mobile_number = $('#edit_mobile_number').val();
		var edit_degree = $('#edit_degree').val();
		var edit_year = $('#edit_year').val();

		var hidden_id = $('#hidden_id').val();

		$.ajax({
			url		: 'operation.php',
			type	: 'POST',
			data 	: 
			{
				
				edit_stu_name 		: edit_stu_name,
				edit_f_name			: edit_f_name,
				edit_email 			: edit_email,
				edit_mobile_number 	: edit_mobile_number,
				edit_degree 			: edit_degree,
				edit_year 			: edit_year,
				hidden_id			: hidden_id,

			},
			success: function(data, status){
				if('success' == status) {
					$('#editModal').modal('hide');
					show_records();
				}
				else{
					alert("ERROR!!!!");
				}
			}
		});
		//alert("here");
	}

	function edit_data(id) {
		
		$('#hidden_id').val(id);

		$.post('operation.php',
				{edit_id:id},
				function(data, status) {
					var user = JSON.parse(data);
					$('#edit_stu_name').val(user.s_name);
					$('#edit_f_name').val(user.s_f_name);
					$('#edit_email').val(user.s_email);
					$('#edit_mobile_number').val(user.s_m_number);
					$('#edit_degree').val(user.s_degree);
					$('#edit_year').val(user.s_year);
				}
		);
		$('#editModal').modal('show');
	}
</script>
</body>
</html>