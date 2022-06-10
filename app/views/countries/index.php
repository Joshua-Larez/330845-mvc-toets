<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mvc.org</title>
    <!-- <link rel="stylesheet" href="/public/css/index.css"> -->
</head>

<?php
    require APPROOT . '/views/includes/header.php';
?> 

<body>
<!-- <a href="<?= URLROOT ?>/countries/create">test</a> -->

<h1>Landenoverzicht</h1>
<a href="/countries/create"><button type="button" id="addbutton">add new country name</button></a>
    <table>
        <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">Land</th>
                <th scope="col">Hoofstad</th>
                <th scope="col">Continent</th>
                <th scope="col">Aantalinwoners</th>
                <th scope="col">email</th>
            </tr>
        </thead>
        <tbody>
            <?= 
                $data['country'] ?? "";
                // if data is null or is an empty string echo no records
                if (is_null($data['country']) || empty($data['country']))
                {
                    // echo this on page
                    echo "  <table>no records</table>";
                }
                else 
                {
                    // give data on this page
                    $data['country'] ?? "";
                }
            ?>
        </tbody>
    </table>
</body>
</html>