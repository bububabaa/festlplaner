<?php
    session_start();

if (isset($_SESSION['loggedin'])) {

}
else
{
    header("Location: login.php");
    die();
}

/*$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=festlplaner;charset=utf8";*/

$username = "digbizm_1";
$password = "2021##Fireme";
$dsn = "mysql:host=sql349.your-server.de;dbname=festlpage;charset=utf8";


$db = new PDO($dsn,$username,$password);

$sql= "SELECT * FROM anbieter";
$result = $db->query($sql);

$anbietern = $result->fetchAll();

$sql1= "SELECT * FROM anbieter";
$result1 = $db->query($sql1);
$i=0;
$arraid=array();
$arrname=array();
$arransprechsperson=array();
$arrtelefon=array();
$arremail=array();
$arrverified=array();
while($row1 = $result1->fetch()){
    $arraid[$i]= $row1['AID'];
    $arrname[$i]= $row1['Name'];
    $arransprechsperson[$i]= $row1['Ansprechsperson'];
    $arrtelefon[$i]= $row1['Telefon'];
    $arremail[$i]= $row1['Email'];
    $arrverified[$i]= $row1['Verified'];
    $i++;
}
$count=0;
$anzahl = count($arraid);

/*for ($z = 0; $z < $anzahl; $z++ )
{
   echo $arrverified[$z];
    echo " ";
}*/

?>


<!DOCTYPE html>
<html lang="de">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
<head>
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <!--<link rel="stylesheet" href="assets/css/templatemo-style.css">-->
    <link rel="stylesheet" href="assets/css/owl.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Festlplaner</title>
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style type="text/css">
@import url(fontawesome.css);
@import url("https://fonts.googleapis.com/css?family=Roboto+Slab:400,700");


    body {
        color: #566787;
		background: #f5f5f5;
       font-family: "Roboto Slab", serif;

	}
	.table-wrapper {
        background: #fff;
        padding: 20px 25px;
        margin: 30px 0;
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {
		padding-bottom: 15px;
        background: #292929;
		color: #fff;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
		margin: 5px 0 0;
		font-size: 24px;
	}
	.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		color: #fff;
		float: right;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
    }
	table.table tr th:first-child {
		width: 60px;
	}
	table.table tr th:last-child {
		width: 100px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table td:last-child i {
		opacity: 0.9;
		font-size: 22px;
        margin: 0 5px;
    }
	table.table td a {
		font-weight: bold;
		color: #292929;
		display: inline-block;
		text-decoration: none;
		outline: none !important;
	}
	table.table td a:hover {
		color: #2196F3;
	}
	table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }
	/* Custom checkbox */
	.custom-checkbox {
		position: relative;
	}
	.custom-checkbox input[type="checkbox"] {
		opacity: 0;
		position: absolute;
		margin: 5px 0 0 3px;
		z-index: 9;
	}
	.custom-checkbox label:before{
		width: 18px;
		height: 18px;
	}
	.custom-checkbox label:before {
		content: '';
		margin-right: 10px;
		display: inline-block;
		vertical-align: text-top;
		background: white;
		border: 1px solid #bbb;
		border-radius: 2px;
		box-sizing: border-box;
		z-index: 2;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		content: '';
		position: absolute;
		left: 6px;
		top: 3px;
		width: 6px;
		height: 11px;
		border: solid #000;
		border-width: 0 3px 3px 0;
		transform: inherit;
		z-index: 3;
		transform: rotateZ(45deg);
	}
	.custom-checkbox input[type="checkbox"]:checked + label:before {
		border-color: #03A9F4;
		background: #03A9F4;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		border-color: #fff;
	}
	.custom-checkbox input[type="checkbox"]:disabled + label:before {
		color: #b8b8b8;
		cursor: auto;
		box-shadow: none;
		background: #ddd;
	}
	/* Modal styles */
	.modal .modal-dialog {
		max-width: 800px;
	}
	.modal .modal-header, .modal .modal-body, .modal .modal-footer {
		padding: 20px 30px;
	}
	.modal .modal-content {
		border-radius: 3px;
	}
	.modal .modal-footer {
		background: #ecf0f1;
		border-radius: 0 0 3px 3px;
	}
    .modal .modal-title {
        display: inline-block;
    }
	.modal .form-control {
		border-radius: 2px;
		box-shadow: none;
		border-color: #dddddd;
	}
	.modal textarea.form-control {
		resize: vertical;
	}
	.modal .btn {
		border-radius: 2px;
		min-width: 100px;
	}
	.modal form label {
		font-weight: normal;
	}
    img{
        width: 20px;
        height: 20px;
    }

    #myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();

	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;
			});
		} else{
			checkbox.each(function(){
				this.checked = false;
			});
		}
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
</script>
</head>
<body>

   <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">

    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
						<h2>Verwaltung <b>Anbieter</b></h2>

					</div>
                    <div class="col-sm-4">
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Suche nach E-Mail-Adressen.." title="Type in a name">
                    </div>
					<div class="col-sm-3">
                        <a href="admin.php" class="btn btn-danger"><img src="assets/images/baseline_close_black_18dp.png"></a>
                        <a href="admin.php" class="btn btn-secondary"><img src="assets/images/baseline_download_black_18dp.png"></a>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>AID</th>
                        <th>Name</th>
                        <th>Ansprechsperson</th>
                        <th>Telefon</th>
                        <th>Email</th>
                        <th>Verified</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($anbietern as $anbieter) {

                        echo '<tr>
                        <td> '.$arraid[$count].'</td>
                        <td>'.$arrname[$count].'</td>
                        <td>'.$arransprechsperson[$count].'</td>
                        <td>'.$arrtelefon[$count].'</td>
                        <td>'.$arremail[$count].'</td>';


                        echo '
                        <td><center><span class="custom-checkbox">';
                            if($arrverified[$count]==0){
                                echo'
                                <a href="verifizieren.php?value=';echo $anbieter['AID'];echo'" class="btn"><img src="assets/images/baseline_check_box_outline_blank_black_18dp.png"></a>';
                            }
                            else
                            {
                                echo'
                                 <a href="verifizieren.php?value=';echo $anbieter['AID'];echo'" class="btn"><img src="assets/images/baseline_check_box_black_18dp.png"></a>';
                            }
                        echo'
							</span></center><td>
                        </tr>';
                        $count++;

                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>



            </div>
        </div>

    </div>


     <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/custom.js"></script>

    <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

</body>
</html>
