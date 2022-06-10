<!-- link to css -->
<?php require APPROOT . '/views/includes/head_create.php';?>

  <body>
    <Form action="/Countries/create" method="post">
      <div class="container">
      <h1>Land maken</h1> 
        <div class="container-fluid mb-5">
          <div class="row input-bundle">
            <div class="col-sm-6">
              <div class="form-group mb-2">
                <label for="name">Country Name</label>
                <input type="text" name="name" class="form-control" value="" required placeholder="name">
              </div>
            </div>
    
            <div class="col-sm-6">
              <div class="form-group mb-2">
                <label for="capitalcity">Capital</label>
                <input type="text" name="capitalcity" class="form-control" value="" placeholder="capitalcity">
              </div>
            </div>
    
            <div class="col-sm-6">
            <div class="form-group mb-2">
                <label for="population">Population</label>
                <input type="number" name="population" class="form-control" value="" required placeholder="population">
              </div>
            </div>

            <div class="col-sm-6">
            <div class="form-group mb-2">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="" required placeholder="email">
              </div>
            </div>

            <h6>Continent</h6>
                <select class="form-select" name="continent" aria-label="Default select example" id="continent">
                    <option value="Afrika">Afrika</option>
                    <option value="Antar">Antartica</option>
                    <option value="Azië">Azië</option>
                    <option value="Australië/Oceanië">Australië/Oceanië</option>
                    <option value="Europa">Europa</option>
                    <option value="Noord-Amerika">Noord-Amerika</option>
                    <option value="Zuid-Amerika">Zuid-Amerika</option>
                </select>
            <label for="continent"></label>
          </div>
        </div>

        <a href="/countries/index"><button type="Button">Back</button></a>
        <button type="submit" value="submit">Opslaan</button>
      </div>
    </Form>
  </body>
    
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- boxicons usage link -->
  <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
</html>