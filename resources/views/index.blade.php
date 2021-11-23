<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Método Simplex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body style="background-color: #ECFEAA">
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class=" d-flex justify-content-center p-4 ">
            <div class="d-flex justify-content-center bg-white rounded-3 border shadow-lg" >
                <div class="row p-5" style="min-width:350px;">

                    <form action="{{ route('calculo.store') }}" method="post"> 
                    @csrf
                        <div class=" d-flex justify-content-center mb-9 pb-3">
                            <div class="col-md-9">
                                <label for="exampleInputEmail1" class="form-label">Número de Variáveis:</label>
                                <input type="number" name="variavel" class="form-control" id="variableNumber" placeholder="Digite um Número" required min="2" max="100">
                            <div id="emailHelp" class="form-text">Os valores tem limite de 100</div>
                            </div>
                        </div>

                        <div class=" d-flex justify-content-center mb-9 pb-3">
                            <div class="col-md-9">
                                <label for="exampleInputEmail1" class="form-label">Número de Restrições:</label>
                                <input type="number" name="restricao" class="form-control" id="variableNumber" placeholder="Digite um Número" required min="3" max="10">
                            </div>

                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-dark btn-lg text-light mb-9">Continuar</button>
                        </div>

                    </form>
                </div>


            </div>

    </div>
</body>
</html>
