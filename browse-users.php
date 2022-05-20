<?php include_once('config.php');?>
<!doctype html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>User Database; James Pitt</title>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<body>
	
	<?php
	$condition	=	'';
	if(isset($_REQUEST['username']) and $_REQUEST['username']!=""){
		$condition	.=	' AND username LIKE "%'.$_REQUEST['username'].'%" ';
	}
	if(isset($_REQUEST['useremail']) and $_REQUEST['useremail']!=""){
		$condition	.=	' AND useremail LIKE "%'.$_REQUEST['useremail'].'%" ';
	}
	if(isset($_REQUEST['userphone']) and $_REQUEST['userphone']!=""){
		$condition	.=	' AND userphone LIKE "%'.$_REQUEST['userphone'].'%" ';
	}
	if(isset($_REQUEST['df']) and $_REQUEST['df']!=""){

		$condition	.=	' AND DATE(dt)>="'.$_REQUEST['df'].'" ';

	}
	if(isset($_REQUEST['dt']) and $_REQUEST['dt']!=""){

		$condition	.=	' AND DATE(dt)<="'.$_REQUEST['dt'].'" ';

	}
	
	$userData	=	$db->getAllRecords('users','*',$condition,'ORDER BY id DESC');
	?>



   	<div class="container" style="margin-top:50px">

		<div class="card">
			<div class="card-header"><i class="fa fa-fw fa-globe"></i> <strong>Community Game Requests</strong> <a href="add-users.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-plus-circle"></i> Add Game</a></div>
			<div class="card-body">

			<div class="col-sm-12">

<p>Welcome to the <strong>Community Game Request</strong> archive. This a community site where we can all suggest our favourite games to play. The aim of this site is to hypothetically get an idea of the games that our community enjoy playing. This would help for future events and promotional material. Please feel free to add your favourite game by using the <strong>Add Game</strong> selection to the top right of this page.</p>

</div>

				<?php
				if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rds"){
					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record deleted successfully!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rus"){
					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record updated successfully!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rnu"){
					echo	'<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> You did not change any thing!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
					echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> There is some thing wrong <strong>Please try again!</strong></div>';
				}
				?>
				<div class="col-sm-12">
					<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Search Requests</h5>
					<form method="get">
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<label>User Name</label>
									<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($_REQUEST['username'])?$_REQUEST['username']:''?>" placeholder="Full Name">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>User Email</label>
									<input type="email" name="useremail" id="useremail" class="form-control" value="<?php echo isset($_REQUEST['useremail'])?$_REQUEST['useremail']:''?>" placeholder="Email">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Game</label>
									<input type="text" name="userphone" id="userphone" class="form-control" value="<?php echo isset($_REQUEST['userphone'])?$_REQUEST['userphone']:''?>" placeholder="Game">
								</div>
							</div>
							<div class="col-sm-4">

								<div class="form-group">

									<label>Date</label>
									<div class="input-group">
										<input type="text" class="fromDate form-control hasDatepicker" name="df" id="df" value="" placeholder="From date">
										<div class="input-group-prepend"><span class="input-group-text">-</span></div>
										<input type="text" class="toDate form-control hasDatepicker" name="dt" id="dt" value="" placeholder="To date">
										<div class="input-group-append"><span class="input-group-text"><a href="javascript:;" onclick="$('#df,#dt').val('');"><i class="fa fa-fw fa-sync"></i></a></span></div>
									</div>

								</div>

							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>&nbsp;</label>
									<div>
										<button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Search</button>
										<a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger"><i class="fa fa-fw fa-sync"></i></a>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<hr>

		
		<div>
			<table class="table table-striped table-bordered">
				<thead>
					<tr class="bg-primary text-white">
						<th>User Name</th>
						<th>User Email</th>
						<th>Game</th>
						<th class="text-center">Request Added</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if(count($userData)>0){
						$s	=	'';
						foreach($userData as $val){
							$s++;
					?>
					<tr>
						<td><?php echo $val['username'];?></td>
						<td><?php echo $val['useremail'];?></td>
						<td><?php echo $val['userphone'];?></td>
						<td align="center"><?php echo date('Y-m-d',strtotime($val['dt']));?></td>
						<td align="center">
							<a href="edit-users.php?editId=<?php echo $val['id'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Edit</a> | 
							<a href="delete.php?delId=<?php echo $val['id'];?>" class="text-danger" onClick="return confirm('Are you sure to delete this user?');"><i class="fa fa-fw fa-trash"></i> Delete</a>
						</td>

					</tr>
					<?php 
						}
					}else{
					?>
					<tr><td colspan="6" align="center">No Record(s) Found!</td></tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		
	</div>
	
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.caret/0.1/jquery.caret.js"></script>
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
</body>
</html>
