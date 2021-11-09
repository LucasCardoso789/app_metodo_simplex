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
    <div class=" d-flex justify-content-center p-4 " id="main-div">
        <div class="d-flex justify-content-center bg-white rounded-3 border shadow-lg" >

            <div class="row p-5 box-content">
                <h5 class="objective-main-title">Objetivo:</h5>

                <select class="form-select" aria-label="Objetivo">
                    <option selected value="1">Maximizar</option>
                    <option value="2">Minimizar</option>
                  </select>

                  <h5 class="objective-funtion-title">Função Objetivo Z:</h5>
                  <div class="receive-content">


                            <div class=" d-inline-flex input-group row">
                                <div class="col-2">
                                    <input type="number" class="form-control" placeholder="z1">
                                </div>
                                +
                                <div class="col-2">
                                    <input type="number" class="form-control" placeholder="z2">

                                </div>
                                +

                                <div class="col-2">
                                    <input type="number" class="form-control" placeholder="z3">
                                </div>

                            </div>


                  </div>
                    <h5 class="restricoes-title">Restrições:</h5>
                    <h6 class="restricoes-sub-title">Restrição 1:</h6>

                  <div class="d-inline-flex input-group row " >
                        <div class="col-2">
                            <input type="number" class="form-control" placeholder="x1">
                        </div>
                        +
                        <div class="col-2">
                            <input type="number" class="form-control" placeholder="x2">

                        </div>
                        +

                        <div class="col-2">
                            <input type="number" class="form-control" placeholder="x3">
                        </div>
                        <select id="sinal-1" class="form-select">
                            <option value="≤">≤</option>
                            <option value="≥">≥</option>
                            <option value="=">=</option>
                        </select>
                        <div class="col-2">
                            <input type="number" id="resultado-restr" class="form-control">
                        </div>

                   </div>

                   <h6 class="restricoes-sub-title">Restrição 2:</h6>

                   <div class="d-inline-flex input-group row " >
                         <div class="col-2">
                             <input type="number" class="form-control" placeholder="x1">
                         </div>
                         +
                         <div class="col-2">
                             <input type="number" class="form-control" placeholder="x2">

                         </div>
                         +

                         <div class="col-2">
                             <input type="number" class="form-control" placeholder="x3">
                         </div>
                         <select id="sinal-1" class="form-select">
                             <option value="≤">≤</option>
                             <option value="≥">≥</option>
                             <option value="=">=</option>
                         </select>
                         <div class="col-2">
                             <input type="number" id="resultado-restr" class="form-control">
                         </div>

                    </div>

                    <h6 class="restricoes-sub-title">Restrição 3:</h6>

                    <div class="d-inline-flex input-group row " >
                          <div class="col-2">
                              <input type="number" class="form-control" placeholder="x1">
                          </div>
                          +
                          <div class="col-2">
                              <input type="number" class="form-control" placeholder="x2">

                          </div>
                          +

                          <div class="col-2">
                              <input type="number" class="form-control" placeholder="x3">
                          </div>
                          <select id="sinal-1" class="form-select">
                              <option value="≤">≤</option>
                              <option value="≥">≥</option>
                              <option value="=">=</option>
                          </select>
                          <div class="col-2">
                              <input type="number" id="resultado-restr" class="form-control">
                          </div>

                     </div>

                     <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-dark btn-lg text-light mb-9 submit-button">Resolver</button>
                    </div>

            </div>




        </div>


    </div>
</body>
</html>
