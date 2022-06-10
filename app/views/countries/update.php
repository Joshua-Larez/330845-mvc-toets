<!-- link to css -->
<?php require APPROOT . '/views/includes/head_update.php';?>

<body>
    <?php
        $data['names'] ?? '';

        // decode &euml; back to ë
        $data['names']->continent = html_entity_decode($data['names']->continent);

        // var_dump($data);
        // var_dump($data['names']->continent);
        // var_dump($data['names']);
        // var_dump($data);
    ?>

    <Form action="<? URLROOT; ?>/Countries/update" method="post">
      <div class="container">
      <h1>Land wijzigen</h1> 
        <div class="container-fluid mb-5">
          <div class="row input-bundle">
            <div class="col-sm-6">
              <div class="form-group mb-2">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $data['names']->name?>" required placeholder="name">
              </div>
            </div>
    
            <div class="col-sm-6">
              <div class="form-group mb-2">
                <label for="capitalcity">Capital</label>
                <input type="text" name="capitalcity" class="form-control" value="<?php echo $data['names']->capitalCity?>" placeholder="capitalcity">
              </div>
            </div>
    
            <div class="col-sm-6">
            <div class="form-group mb-2">
                <label for="population">Population</label>
                <input type="text" name="population" class="form-control" value="<?php echo $data['names']->population?>" required placeholder="population">
              </div>
            </div>

            <div class="col-sm-6">
            <div class="form-group mb-2">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $data['names']->email?>" required placeholder="email">
              </div>
            </div>

            <h6>Continent</h6>
                <select class="form-select" name="continent" aria-label="Default select example" id="continent">
                    <option <?= $data['names']->continent == "Afrika" ? "selected=\"selected\"" : '' ?> value="Afrika">Afrika</option>
                    <option <?= $data['names']->continent == "Antartica" ? "selected=\"selected\"" : '' ?> value="Antartica">Antartica</option>
                    <option <?= $data['names']->continent == "Azië" ? "selected=\"selected\"" : '' ?> value="Azië">Azië</option>
                    <option <?= $data['names']->continent == "Australië/Oceanië" ? "selected=\"selected\"" : '' ?> value="Australië/Oceanië">Australië/Oceanië</option>
                    <option <?= $data['names']->continent == "Europa" ? "selected=\"selected\"" : '' ?> value="Europa">Europa</option>
                    <option <?= $data['names']->continent == "Noord-Amerika" ? "selected=\"selected\"" : '' ?> value="Noord-Amerika">Noord-Amerika</option>
                    <option <?= $data['names']->continent == "Zuid-Amerika" ? "selected=\"selected\"" : '' ?> value="Zuid-Amerika">Zuid-Amerika</option>
                </select>
            <label for="continent"></label>
          </div>
        </div>

        <input type="hidden" name="id" value="<?=$data['names']->id?>">

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