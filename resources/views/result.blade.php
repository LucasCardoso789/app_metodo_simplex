<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Método Simplex</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/calc-page.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</head>

<body>

    <?php


// conta da linha Z
$cz = count($z);

// linha Z

foreach($z as $item){
	$item = intval($item);
}

foreach($z as $item){
	$item = $item* -1;
}

array_unshift($z, 1);

for ($i=$cz+1; $i <= $cz+$r+1; $i++) {
	$z[$i] = 0;
}

$cz = count($z);
/*-----------------------------------*/

// linhas lado direito
for ($i=0; $i < $r; $i++) {
	$ld[$i] = intval($ld[$i]);
}
/*-----------------------------------*/

// linhas da restrições
for ($i=0; $i < $r; $i++) {
	array_unshift($res[$i], 0);
}

$vf = $v+1;

for ($i=0; $i < $r; $i++) {
	array_unshift($res[$i], $i+$vf);
}

// conta de restrições da coluna
$crc = count($res);

// matriz identidade
for ($i=0; $i < $r; $i++) {
	for ($j=0; $j < $r; $j++) {
		if ($i == $j) {
			$res[$i][] = 1;
		} else {
			$res[$i][] = 0;
		}
	}
	$res[$i][] = $ld[$i];
}

// conta de restrições da linha
$crl = count($res[0]);

for ($i=0; $i < $crc; $i++) {
	for ($j=0; $j < $crl; $j++) {
		$res[$i][$j] = intval($res[$i][$j]);
	}
}
/*---------------------------------------*/

function min_not_zero(Array $array) {
	return min(array_diff(array_map('intval', $array), array(0)));
}

?>
<div class="container">
	<br>
	<br>
	<br>

	<?php

	$it = 0;

	do {

		/*for ($i=0; $i < $cz; $i++) {
			echo($z[$i]);
		}
		echo "<br>";
		for ($i=0; $i < $crc; $i++) {
			for ($j=0; $j < $crl; $j++) {
				echo($res[$i][$j]);
			}
			echo "<br>";
		}
		echo "<br>";*/

		echo "<h5>Iteração $it</h5>";
		?>

		<table class="table table-bordered">
			<thead class="text-white" style="background-color: #0d6efd!important;">
				<tr>
					<th scope="col">Linha</th>
					<th scope="col">Base</th>
					<th scope="col">Z</th>
					<?php 
					for ($i=1; $i <= $v; $i++) { 
						echo "<th scope='col'>X$i</th>";
					}
					for ($i=$vf; $i < $r+$vf; $i++) {
						echo "<th scope='col'>X$i</th>";
					}
					?>
					<th scope="col">Lado Direito</th>
				</tr>
			</thead>
			<tbody>
				<?php
				echo "<tr>
				<td>0</td>
				<td>Z</td>";

				for ($i=0; $i < $cz; $i++) { 
					echo"<td>",$z[$i],"</td>";
				}

				$c = ($r);
				for ($i=0; $i < $c; $i++) { 
					echo "<tr>
					<td>",$i+1,"</td>";
					echo "<td>X", $res[$i][0],"</td>";

					for ($j=1; $j < $crl; $j++) {
						echo "<td>";
						echo ($res[$i][$j]);
						echo "</td>";
					}
					echo "</tr>";
				}

				// z de parada
				$zp = min($z);
				//print_r($zp);

				// lado direito dividido
				$ldd = array();

				//posição do menor de Z - linha de z
				$lz = array_search(min($z), $z);

				//posição do menor de Z + 1 - linha de z para restrição
				$lzr = array_search(min($z), $z)+1;
				for ($i=0; $i < $crc; $i++) { 
					//print_r($res[$i][$lzr]);
					//print_r($res[$i][$crl-1]);
					
					if (($res[$i][$lzr])==0) {
						$ldd[$i] = 0;
					} else {
						$ldd[$i] = ($res[$i][$crl-1])/($res[$i][$lzr]);
					}
				}
				//print_r($ldd);

				$min_not = (min_not_zero($ldd));

				$pivo = ($res[array_search($min_not, $ldd)][$lzr]);
				//echo(array_search($min_not, $ldd));

				//posição do pivo das restrições linha
				$lp = array_search($min_not, $ldd);

				// linha que entra dividida pelo pivô
				for ($i=$lp; $i <= $lp; $i++) { 
					for ($j=0; $j < $crl; $j++) {
						if ($j == 0) {
							$res[$i][$j] = $lz;
						} else {
							$res[$i][$j] = ($res[$i][$j]/$pivo);
						}
					}
				}

				// coluna pivo - buscar valores 0
				$cp = array_column($res, $lzr);
				$cpaux = array();

				foreach ($cp as $k => $v) {
					if($v == 0){
						$cpaux[] = $k;
					}
				}
				
				$zaux = $z[$lz]*-1;

				$laux = array();

				//print_r($zaux);
				
				for ($i=$lp; $i <= $lp; $i++) {
					for ($j=$lz; $j < $crl; $j++) {
						$laux[] = $res[$i][$j]*$zaux;
					}
				}
				array_unshift($laux, 0);

				// nova linha z
				if ($it>=1) {
					for ($i=1; $i < $cz; $i++) {
						$z[$i] = $laux[$i+1] + $z[$i];
					}
				} else {
					for ($i=1; $i < $cz; $i++) {
						$z[$i] = $laux[$i] + $z[$i];
					}
				}
				/*----------------------------------*/

				//print_r($laux);

				$raux = 0;

				// encontrar as novas linhas das restrições
				for ($i=0; $i < $crc; $i++) {
					for ($j=2; $j < $crl; $j++) {
						for ($k=0; $k < count($cpaux); $k++) { 
							if ($i == $cpaux[$k]) {
								continue;
							} elseif ($i == $lp) {
								continue;
							} else {
								$pr = $i;
								$raux = $res[$i][$lzr]*-1;
							}
						}
					}
				}

				//print_r($raux);

				// linha auxiliar do pivo para linha das restrições
				$lraux[] = array();
				//print_r($raux);

				for ($i=$lp; $i <= $lp; $i++) {
					for ($j=$lz; $j < $crl; $j++) {
						$lraux[] = $res[$i][$j]*$raux;
						//print_r($res[$i][$j]*$raux);
					}
				}
				array_unshift($lraux, 0);

				//print_r($lz);

				for ($i=0; $i < count($lraux); $i++) {
					$lraux[$i] = intval($lraux[$i]);
				}

				if((count($lraux)) > $crl) {
					for ($i=0; $i < ($crl); $i++) {
						array_shift($lraux);
					}
				}

				$lz = $lz+1;

				for ($i=$pr; $i <= $pr; $i++) { 
					for ($j=0; $j < $crl; $j++) {
						$res[$i][$j] = ($res[$i][$j]+$lraux[$j]);
					}
				}

				//print_r($res);
			
				$it++;

				$zm = max($z);
				?>
			</tbody>
		</table>
		<?php
		echo "<br>";

	} while ($zp<0);

	echo "<p class='fs-5 badge bg-primary text-wrap' style='width: 20rem;'>A solução ótima é Z = $zm</p>";
	echo "<br>";

	?>

</div>

</body>

</html>
