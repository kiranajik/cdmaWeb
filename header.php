    <head>
        <meta charset='utf-8'>
		<link rel="stylesheet" type="text/css" href="header.css?v=<?php echo time(); ?>">
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700,900" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
	</head>
	<body>
		<header>
			<div class="head_container">
				<div class="logo">
					<img src="covid-logo.png">
				</div>

				<div class="menu" id="myTopnav">
					<ul>
						<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="openNav()">&#9776;</a>
						<li><a href="index.php">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">How To</a></li>
                        <li><a href="#">Contact</a></li>
					</ul>
                </div>
            </div>
        </header>

        <div class="banner">
            <div class="banner-val">
            Covid 19 Visual Analysis
            </div>
            <button type="button" class="theme-toggle"  name="dark_light"  title="Toggle dark/light mode"><img id="mode" src="moon.png"></button>
        </div>

		<div id="mySidenav" class="sidenav">
			  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			  <a href="index.php">Home</a>
			  <a href="#">About</a>
			  <a href="#">How To</a>
              <a href="#">Contact</a>
              <div class="side-footer">
			  <p style="color: #1c3664; text-align: center;margin-left:18px;color:#00203FFF;"><b><u>COVID 19 VISUAL ANALYSIS</u></b></p>
              <p style="color: #1c3664;margin-left:5px;margin-top:5px;">By : </p>
              <p style="color: #1c3664; text-align: center">Kiran Ajikumar</p>
              <p style="color: #1c3664; text-align: center">Jennifer Nicole</p>
              </div>

        </div>
        <script>
            
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
            };

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
            };
        </script>
