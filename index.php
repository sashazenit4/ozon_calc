<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>KAS-calc</title>
</head>
<body>
    <div class="title">
        <h1>Калькулятор озон</h1>
    </div>
    <div class="form-container container">
        <form action="handler.php" method="post" class="form">
            <input type="text" name="price" placeholder="Цена р.">
            <div class="input-block">
                <input type="text" name="volume" placeholder="Объём л.">
                <input type="text" name="volume-mass" placeholder="Масса кг.">
            </div>
            <input type="text" name="comission" placeholder="Комиссия %.">
            <input type="text" name="bet" placeholder="Ставка %.">
            <input type="text" name="count" placeholder="Количество проданных шт.">
            <input type="text" name="bet-count" placeholder="Количество проданных по ставкам шт.">
            <span class="click" onclick="beforeSubmit()">Отправить запрос</span>
        </form>
        <div class="instruction-link">
            <a href="instruction.html">Ссылка на инструкцию к калькулятору</a>
        </div>
    </div>
</body>
<script>
    function beforeSubmit()
    {
        let form = document.querySelector('.form')
        form.submit()
    }
</script>
</html>