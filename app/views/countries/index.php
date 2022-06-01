<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mvc-toets.org</title>
</head>
<style>
    body {
        background-color: lightcyan;
    }
    button {
        background-color: lightskyblue;
        border: 0;
        border-radius: .5rem;
        padding: .5rem;
    }
    button:hover {
        background-color: lightgoldenrodyellow;
    }
    a {
        color: black;
        text-decoration: none;
    }

    table {
        background-color: lightgrey;
        border-radius: .5rem;
    }
    #addbutton {
        margin-bottom: 1rem;
    }
    input {
        margin-bottom: .5rem;
        padding: .1rem;
    }

</style>
<body>

<h1>Landenoverzicht</h1>
<button type="button" id="addbutton"><a href="/countries/create">add new country name</a></button>
    <table>
        <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">Land</th>
                <th scope="col">Hoofstad</th>
                <th scope="col">Continent</th>
                <th scope="col">Aantalinwoners</th>
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