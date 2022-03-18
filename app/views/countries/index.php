<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mvc-toets.org</title>
</head>
<body>

<h1>Landenoverzicht</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">Land</th>
                <th scope="col">hoofstad</th>
                <th scope="col">continent</th>
                <th scope="col">aantalinwoners</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($data['country'] as $v) {
                    $test = number_format($v->population,0,'.','.');
                    echo "<tr>
                            <th scope='row'>{$v->id}</th>
                            <td>{$v->name}</td>
                            <td>{$v->capitalCity}</td>
                            <td>{$v->continent}</td>
                            <td>{$test}</td>
                        </tr>";
                }              
            ?>
        </tbody>
    </table>
</body>
</html>