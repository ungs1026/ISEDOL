<?php
include("includes/mysqli-dbconfig.php");
include("includes/classes/Artist.php");
include("includes/classes/Song.php");
?>

<!DOCTYPE html>
<head>
  <title>ISEGYE IDOL PLAYLIST</title>
  <link rel="icon" href="source/img/main-logo.png" type="image/x-icon" />
  <link rel="shortcut icon" href="source/img/main-logo.png" type="image/x-icon"/>

  <link rel="stylesheet" type="text/css" href="css/songsStyle.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="js/songScript.js"></script>
</head>

<body class="scrollbar">

  <div id="mainContainer">

    <div id="topContainer">

      <?php include("includes/part/nav_song.php"); ?>

      <div id="mainViewContainer">

        <div id="mainContent">