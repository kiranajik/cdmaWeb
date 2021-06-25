<head>
    <link rel="stylesheet" type="text/css" href="nav.css">
</head>
<style>

.active {
    margin: 0 1vw;
    padding: 1vh 1vh 1vh 1vh;
    background-color: #428c72;
    color: white;
    border-radius: 10px;
    font-weight: bold;
}
@media screen and (max-width: 650px) {
    .nav-button {
        font-size: 0.7em;
    }
    .active {
        font-size: 0.7em;
    }
}
</style>
<div class="nav-bar" style="width: max-content;">

    <a href="index.php" class="<?php if($page=="index"){echo "active";}else{echo "nav-button";}?>">Covid Cases</a>
    <a href="vaccination.php" class="<?php if($page=="vaccination"){echo "active";}else{echo "nav-button";}?>">Vaccination</a>
    <a href="donation.php" class="<?php if($page=="donation"){echo "active";}else{echo "nav-button";}?>">Relief Fund</a>

</div>
