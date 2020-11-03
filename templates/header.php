<header class="jumbotron">
  <!-- <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">  -->
    <style>
        .imgsuchen {
            width: 35px;
            height: 35px;
        }

        .sidenav {
            height: 100%;
            /* 100% Full-height */
            width: 0;
            /* 0 width - change this with JavaScript */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Stay on top */
            top: 0;
            /* Stay at the top */
            left: 0;
            background-color: #111;
            /* Black*/
            overflow-x: hidden;
            /* Disable horizontal scroll */
            padding-top: 60px;
            /* Place content 60px from the top */
            transition: 0.5s;
            /* 0.5 second transition effect to slide in the sidenav */

        }

        .sidenav a, .dropdown-btn {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
  transition: 0.3s;
}

        .sidenav a:hover, .dropdown-btn:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

.active {
  background-color: grey;
  color: white;
}

        .dropdown-container {
  display: none;
  padding-left: 8px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
}

/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
    </style>

    <ul class="nav nav-pills nav-fill">
        <li class="nav-items">
        </li>
        <li class="nav-item">
            <a style="font-size: 30px; font-weight: bold; color:white;" href="index.php" aria-disabled="true">Festlplaner</a>
        </li>

        <div style="margin: 0 auto;">
            <li class="nav-item">
                <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <a href="" class=" my-2 my-sm-0" type="submit"><img class="imgsuchen margin: 0 auto;" src="assets/img/search_icon.png" /></a>
                </form>
            </li>
        </div>

        <li class="nav-item">
            <a href="profil.php" aria-disabled="true" style="font-size: 30px; font-weight: bold;color:white;" href="profil.php">Profil</a>
        </li>
    </ul>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">Home</a>
        <a href="#">Kalender</a>
        <a href="#">Galerie</a>
        <a href="#">Karte</a>
        <button class="dropdown-btn">Abos
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
  </div>
    </div>

    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>

    <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");

var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}

    </script>

    <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
<script>
    const options = {
  bottom: '64px', // default: '32px'
  left: 'unset', // default: '32px'
  right: '32px', // default: 'unset'
  time: '0.5s', // default: '0.3s'
  mixColor: '#fff', // default: '#fff'
  backgroundColor: '#fff',  // default: '#fff'
  buttonColorDark: '#100f2c',  // default: '#100f2c'
  buttonColorLight: '#fff', // default: '#fff'
  saveInCookies: false, // default: true,
  label: '🌓', // default: ''
  autoMatchOsTheme: true // default: true
}
  function addDarkmodeWidget() {
    const darkmode = new Darkmode(options);
      darkmode.showWidget();
  }
  window.addEventListener('load', addDarkmodeWidget);
</script>

    <!-- Use any element to open the sidenav -->


</header>
