<!DOCTYPE html>
<html>
<head>

<style>
.container {
    display: inline-block;
    position: relative;
    width: 50%;
}
.dummy {
    margin-top: 100%;
}
.element {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: red;
}

</style>
</head>
<body>

<!--<h2>Button Colors</h2>
<p>Change the background color of a button with the background-color property:</p>

<button class="button">Green</button>
<button class="button button2">Blue</button>
<button class="button button3">Red</button>
<button class="button button4">Gray</button>
<button class="button button5">Black</button>-->

<!--<div class="container">
    <div class="dummy"></div>
    <div class="element">
        some text
    </div>
</div>-->

<?php 

	$jd=gregoriantojd(5,29,2017);
	// echo $jd;
echo jddayofweek($jd,1);

?>

</body>
</html>
