<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $z = $request->z;
        $res = $request->res;
        $ld = $request->ld;
        $v = $request->quant_var;
        $r = $request->quant_res;


                    // conta da linha Z
            $cz = count($z);

            // linha Z
            for ($i=0; $i < $cz; $i++) {
                $z[$i] = intval($z[$i]);
            }

            for ($i=0; $i < $cz; $i++) {
                $z[$i] = $z[$i]*-1;
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


            $it = 0;

            $c = ($r);


            // z de parada
				$zp = min($z);
				//print_r($zp);

				// lado direito dividido
				$ldd = array();

				//posição do menor de Z - linha de z
				$lz = array_search(min($z), $z);

				//posição do menor de Z + 1 - linha de z para restrição
				$lzr = array_search(min($z), $z)+1;


                $min_not = (min_not_zero($ldd));

				$pivo = ($res[array_search($min_not, $ldd)][$lzr]);
				//echo(array_search($min_not, $ldd));

				//posição do pivo das restrições linha
				$lp = array_search($min_not, $ldd);


                // coluna pivo - buscar valores 0
				$cp = array_column($res, $lzr);
				$cpaux = array();



                $zaux = $z[$lz]*-1;

				$laux = array();


                array_unshift($laux, 0);


                $raux = 0;



                // linha auxiliar do pivo para linha das restrições
				$lraux[] = array();


                array_unshift($lraux, 0);

                $lz = $lz+1;


                $it++;


                $zm = max($z);


        /* print_r($z); */
        

        return view('result', ['z' => $z, 'res' => $res, 'ld' => $ld, 'it' => $it, 'zp' => $zp, 'ldd' => $ldd, 'lz' => $lz, 'lzr' => $lzr]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
