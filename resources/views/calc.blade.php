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
<body >
    <form action="{{ route('resultado.store') }}" method="post">
        @csrf
    <div class=" d-flex justify-content-center p-4" id="main-div">
        <div class="d-flex justify-content-center bg-white rounded-3 border shadow-lg h-100" id="sub-div">

            <div class="row p-5 box-content w-100">
                <h5 class="objective-main-title">Objetivo:</h5>

                <select class="form-select" aria-label="Objetivo">
                    <option selected value="1">Maximizar</option>
                    <option value="2">Minimizar</option>
                  </select>

                  <h5 class="objective-funtion-title">Função Objetivo Z:</h5>
                  <div class="receive-content">



                    <div class=" d-inline-flex input-group row">

                            @for($i=1; $i <= $quant_var; $i++)
                            <div class="col-1">
                                <input type="number" class="form-control" placeholder="z{{$i}}" id='z[{{$i}}]' name='z[{{$i}}]'>
                            </div>
                            @if($i != $quant_var) +
                            @endif
                            @endfor

                    </div>


                  </div>
                    <h5 class="restricoes-title">Restrições:</h5>

                  <div class="d-inline-flex input-group row ">
                        @for($i=0; $i < $quant_res; $i++)
                            <h6 class="restricoes-sub-title">Restrição {{$i+1}}:</h6>
                                @for($j=0; $j <= $quant_var-1; $j++)
                                    @if($j != $quant_var-1)
                                        <div class="col-1">
                                            <input type="number" class="form-control"  placeholder="x{{$j+1}}" id='res[{{$i}}][{{$j}}]' name='res[{{$i}}][{{$j}}]'>
                                        </div>

                                    +


                                        @else
                                        <div class="col-1"php>
                                        <input type="number" class="form-control" placeholder="x{{$j+1}}" id='res[{{$i}}][{{$j}}]' name='res[{{$i}}][{{$j}}]'>
                                        </div>




                                        <div class="col-1 igualdade-select">
                                        <select id="sinal-1" class="form-select">
                                            <option value="≤">≤</option>
                                            <option value="≥">≥</option>
                                            <option value="=">=</option>
                                        </select>
                                        </div>

                                        <div class="col-1 valor-final-restricao">
                                        <input type="number" class="form-control" id='ld[{{$i}}]' name='ld[{{$i}}]' value='0'>
                                        </div>
                                    @endif
                                @endfor
                        @endfor
                 </div>

                     <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-dark btn-lg text-light mb-9 submit-button">Resolver</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
</body>
</html>
