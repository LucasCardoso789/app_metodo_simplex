<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Método Simplex</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/calc-page.css')}}">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>

	{{-- conta da linha Z --}}
	{{$cz = count($z)}}

	{{-- linha Z --}}
	@for ($i=0; $i < $cz; $i++) {
		{{$z[$i] = intval($z[$i])}}
	}
	@endfor

	@for ($i=0; $i < $cz; $i++) {
		{{$z[$i] = $z[$i]*-1}}
	}
	@endfor

	{{array_unshift($z, 1)}}

	@for ($i=$cz+1; $i <= $cz+$r+1; $i++) {
		{{$z[$i] = 0}}
	}

	{{$cz = count($z)}}
	{{-- /*-----------------------------------*/ --}}

	{{-- linhas lado direito --}}
	@for ($i=0; $i < $r; $i++) {
		{{$ld[$i] = intval($ld[$i])}}
	}
	@endfor
	{{-- /*-----------------------------------*/ --}}

	{{-- linhas da restrições --}}
	@for ($i=0; $i < $r; $i++) {
		{{array_unshift($res[$i], 0)}}
	}
	@endfor

	{{$vf = $v+1}}

	@for ($i=0; $i < $r; $i++) {
		{{array_unshift($res[$i], $i+$vf)}}
	}
	@endfor

	{{-- conta de restrições da coluna --}}
	{{$crc = count($res)}}

	{{-- matriz identidade --}}
	@for ($i=0; $i < $r; $i++) {
		@for ($j=0; $j < $r; $j++) {
			@if ($i == $j) {
				{{$res[$i][] = 1}}
			}@else {
				{{$res[$i][] = 0}}
			}
			@endif
		}
		@endfor
		{{$res[$i][] = $ld[$i]}}
	}
	@endfor

	{{-- conta de restrições da linha --}}
	{{$crl = count($res[0])}}

	@for ($i=0; $i < $crc; $i++) {
		@for($j=0; $j < $crl; $j++) {
			{{$res[$i][$j] = intval($res[$i][$j])}}
		}
		@endfor
	}
	@endfor
	{{-- /*---------------------------------------*/ --}}

	{{function min_not_zero(Array $array) {
		return min(array_diff(array_map('intval', $array), array(0)))
	}}}

	<div class="container">
		<br>
		<br>
		<br>

		

		{{$it = 0}}

		@while({{!$zp<0}})
		<h5>Iteração {{$it}}</h5>
			

		<table class="table table-bordered">
			<thead class="text-white" style="background-color: #0d6efd!important;">
				<tr>
					<th scope="col">Linha</th>
					<th scope="col">Base</th>
					<th scope="col">Z</th>
					 
					@for ($i=1; $i <= $v; $i++) { 
						<th scope='col'>X{{$i}}</th>
					}
					@endfor
					@for ($i=$vf; $i < $r+$vf; $i++) {
						<th scope='col'>X{{$i}}</th>
					}
					@endfor
					
					<th scope="col">Lado Direito</th>
				</tr>
			</thead>
			<tbody>
				
				<tr>
				<td>0</td>
				<td>Z</td>

				@for ($i=0; $i < $cz; $i++) { 
					<td>{{$z[$i]}}</td>
				}
				@endfor

				{{$c = ($r)}}
				@for ($i=0; $i < $c; $i++) { 
					<tr>
					<td>{{$i+1}}</td>
					<td>X {{$res[$i][0]}}</td>

					@for ($j=1; $j < $crl; $j++) {
						<td>
						{{($res[$i][$j])}}
						</td>
					}
					@endfor
					</tr>
				}
				@endfor

				{{-- z de parada --}}
				{{$zp = min($z)}}

				{{-- lado direito dividido --}}
				{{$ldd = array()}}

				{{-- posição do menor de Z - linha de z --}}
				{{$lz = array_search(min($z), $z)}}

				{{-- posição do menor de Z + 1 - linha de z para restrição --}}
				{{$lzr = array_search(min($z), $z)+1}}
				@for ($i=0; $i < $crc; $i++) { 
					
					@if (($res[$i][$lzr])==0) {
						{{$ldd[$i] = 0}}
					} @else {
						{{$ldd[$i] = ($res[$i][$crl-1])/($res[$i][$lzr])}}
					}
					@endif
				}
				@endfor

				{{$min_not = (min_not_zero($ldd))}}

				{{$pivo = ($res[array_search($min_not, $ldd)][$lzr])}}
				

				{{-- posição do pivo das restrições linha --}}
				{{$lp = array_search($min_not, $ldd)}}

				{{-- linha que entra dividida pelo pivô --}}
				@for ($i=$lp; $i <= $lp; $i++) { 
					@for ($j=0; $j < $crl; $j++) {
						@if ($j == 0) {
							{{$res[$i][$j] = $lz}}
						} @else {
							{{$res[$i][$j] = ($res[$i][$j]/$pivo)}}
						}
						@endif
					}
					@endfor
				}
				@endfor

				{{-- coluna pivo - buscar valores 0 --}}
				{{$cp = array_column($res, $lzr)}}
				{{$cpaux = array()}}

				@foreach ($cp as $k => $v) {
					@if($v == 0){
						{{$cpaux[] = $k}}
					}
					@endif
				}
				@endforeach
				
				{{$zaux = $z[$lz]*-1}}

				{{$laux = array()}}
				
				@for ($i=$lp; $i <= $lp; $i++) {
					@for ($j=$lz; $j < $crl; $j++) {
						{{$laux[] = $res[$i][$j]*$zaux}}
					}
					@endfor
				}
				@endfor
				{{array_unshift($laux, 0)}}

				{{-- nova linha z --}}
				@if ($it>=1) {
					@for ($i=1; $i < $cz; $i++) {
						{{$z[$i] = $laux[$i+1] + $z[$i]}}
					}
					@endfor
				} @else {
					@for ($i=1; $i < $cz; $i++) {
						{{$z[$i] = $laux[$i] + $z[$i]}}
					}
					@endfor
				}
				@endif
				{{-- /*----------------------------------*/ --}}

				{{$raux = 0}}

				{{-- encontrar as novas linhas das restrições --}}
				@for ($i=0; $i < $crc; $i++) {
					@for ($j=2; $j < $crl; $j++) {
						@for ($k=0; $k < count($cpaux); $k++) { 
							@if ($i == $cpaux[$k]) {
								@continue
							} @elseif ($i == $lp) {
								@continue
							} @else {
								{{$pr = $i}}
								{{$raux = $res[$i][$lzr]*-1}}
							}
							@endif
						}
						@endfor
					}@endfor
				}
				@endfor

				{{-- linha auxiliar do pivo para linha das restrições --}}
				{{$lraux[] = array()}}

				@for ($i=$lp; $i <= $lp; $i++) {
					@for ($j=$lz; $j < $crl; $j++) {
						{{$lraux[] = $res[$i][$j]*$raux}}
					}
					@endfor
				}
				@endfor
				{{array_unshift($lraux, 0)}}

				@for ($i=0; $i < count($lraux); $i++) {
					{{$lraux[$i] = intval($lraux[$i])}}
				}
				@endfor

				@if((count($lraux)) > $crl) {
					@for ($i=0; $i < ($crl); $i++) {
						{{array_shift($lraux)}}
					}
					@endfor
				}
				@endif

				{{$lz = $lz+1}}

				@for ($i=$pr; $i <= $pr; $i++) { 
					@for ($j=0; $j < $crl; $j++) {
						{{$res[$i][$j] = ($res[$i][$j]+$lraux[$j])}}
					}
					@endfor
				}
				@endfor
			
				{{$it++}}

				{{$zm = max($z)}}
				
			</tbody>
		</table>
		<br>

		<p class='fs-5 badge bg-primary text-wrap' style='width: 20rem;'>A solução ótima é Z = {{$zm}}</p>
		<br>

	</div>
	
</body>
</html>