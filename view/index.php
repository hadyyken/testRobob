<!doctype html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <title>Отдел кадров</title>
</head>
<body>

<div class="container" align="center">
    <h3 align="center">Отдел кадров</h3> <br>

    <div class="form-check form-check-inline">

        <input class="form-check-input" type="radio" name="flexRadioDefault" id="all" checked>
        <label class="form-check-label" for="all">
            Отобразить все
        </label>

    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="trial" >
        <label class="form-check-label" for="trial">
            Испытательный срок
        </label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="fired" >
        <label class="form-check-label" for="fired">
            Уволенные
        </label>

    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="chief" >
        <label class="form-check-label" for="chief">
            Начальники
        </label>
    </div>

    <div class="table" id="paginationData">

    </div>
</div>

</body>
</html>
<script src="../resources/js/load.js"></script>