<div class="container">
	<br>
	<br>
	<br>

	@while (!$zp<0)
	<h5>Iteração {{$it}}</h5>
	<table class="table table-bordered">
		<thead class="text-white" style="background-color: #0d6efd!important;">
			<tr>
				<th scope="col">Linha</th>
				<th scope="col">Base</th>
				<th scope="col">Z</th>
				@for($i=1; $i <= $v; $i++) { 
					<th scope='col'>{{X$i}}</th>";
				}
				@endfor

				@for ($i=$vf; $i < $r+$vf; $i++) {
					<th scope='col'>{{X$i}}</th>";
				}
				@endfor
				
				<th scope="col">Lado Direito</th>
			</tr>
		</thead>
		<tbody>
			<tr>
			<td>0</td>
			<td>Z</td>

			@for($i=0; $i < $cz; $i++) { 
				<td>{{$z[$i]}}</td>
			}
			@endfor

			
			@for ($i=0; $i < $c; $i++) { 
				<tr>
				<td>{{$i+1}}"</td>
				<td>X{{$res[$i][0]}}"</td>

				@for($j=1; $j < $crl; $j++) {
					<td>
					 {{($res[$i][$j])}}
					</td>
				}
				@endfor
				</tr>
			}
			@endfor

			
			@for($i=0; $i < $crc; $i++) {
				
				@if(($res[$i][$lzr])==0) {
					{{$ldd[$i] = 0}}
				}@else {
					{{$ldd[$i] = ($res[$i][$crl-1])/($res[$i][$lzr])}}
				}
				@endif
			}
			@endfor

			

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

			

			@foreach ($cp as $k => $v) {
				@if($v == 0){
					{{$cpaux[] = $k}}
				}
				@endif
			}
			@endforeach
			
			

			{{-- print_r($zaux) --}}
			
			@for ($i=$lp; $i <= $lp; $i++) {
				@for ($j=$lz; $j < $crl; $j++) {
					{{$laux[] = $res[$i][$j]*$zaux}}
				}
				@endfor
			}
			@endfor
			

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
				}
				@endfor
			}
			@endfor

			@for ($i=$lp; $i <= $lp; $i++) {
				@for ($j=$lz; $j < $crl; $j++) {
					{{$lraux[] = $res[$i][$j]*$raux}}
				}
				@endfor
			}
			@endfor
			

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
			@endfor

			

			@for ($i=$pr; $i <= $pr; $i++) { 
				@for ($j=0; $j < $crl; $j++) {
					{{$res[$i][$j] = ($res[$i][$j]+$lraux[$j])}}
				}
				@endfor
			}
			@endfor
		</tbody>
	</table>
	 <br>
	@endwhile
	 <p class='fs-5 badge bg-primary text-wrap' style='width: 20rem;'>A solução ótima é Z = {{$zm}}</p>
	 <br>
</div>

