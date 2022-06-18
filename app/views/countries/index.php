<?php
    // includes header
    require APPROOT . '/views/includes/head_index.php';
?> 

<script>   
     $(document).ready( function () {
        $('#myTable').DataTable({
            pageLength : 5,
            lengthMenu: [ 5, 10, 25, 50, 75, 100 ]
        });
        
        // Testing:
        // #myInput is a <input type="text"> element
        // $('#myInput').on( 'keyup', function () {
        //     table.search( this.value ).draw();
        // } );
    } );
</script>

<h1>Landenoverzicht</h1>

<a href="<?=URLROOT?>/Homepage"><button type="button">homepage</button></a>

<a href="/countries/create"><button type="button" id="addbutton">add new country name</button></a>

<div class="container" style="margin: auto; width: 50%;">
    <table class="stripe hover order-column row-border display nowrap" id="myTable" style="background-color:lightgrey;">
        <thead>
            <tr>
                <th scope="col">Land</th>
                <th scope="col">Hoofstad</th>
                <th scope="col">Continent</th>
                <th scope="col">Aantalinwoners</th>
                <th scope="col">email</th>
                <th scope="col">update</th>
                <th scope="col">delete</th>
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
</div>

<?php
    // includes footer
    require APPROOT . '/views/includes/footer.php';
?> 