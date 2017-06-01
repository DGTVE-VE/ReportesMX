<html>
<head>

<title>Los foritos</title>

</head>
<body>



<?php
echo "<br />";
echo "<center><h2>$nombreorganizacion</h2></center>";
echo "<br />";
echo "<br />";
echo "<br />";
for ($i = 0; $i < $totalcursos; $i++) {
	echo '<div style="padding-left:5em;">'.$cursos[$i]->display_name.'</div>';
	echo '<div style="padding-left:5em;">'.$cursos[$i]->id.'</div>';
	echo '<div style="padding-left:5em;">';
	echo "<a href='/Mi_Reportes/public/download/foros_".$cursos[$i]->display_number_with_default.".csv'>Descargar archivo de foros</a>";
	echo '</div>';
	echo "<br />";
	echo "<br />";
}
?>


</body>
</html>
