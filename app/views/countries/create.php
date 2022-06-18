<?php 
  // includes header
  require APPROOT . '/views/includes/head_create.php';
?>

<Form action="/Countries/create" method="POST">
  <div class="container">
  <h1>Make a land</h1> 
    <div class="container-fluid mb-5">
      <div class="row input-bundle">
        <div class="col-sm-6">
          <div class="form-group mb-2">
            <label for="name">Country Name</label>
            <input type="text" name="name" class="form-control" value="<?= $data['name'] ?>" placeholder="name" required>
            <div class="errorForm"><?= $data['nameError'] ?></div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group mb-2">
            <label for="capitalcity">Capital</label>
            <input type="text" name="capitalcity" class="form-control" value="<?= $data['capitalcity'] ?>" placeholder="capitalcity" required>
            <div class="errorForm"><?= $data['capitalcityError'] ?></div>
          </div>
        </div>

        <div class="col-sm-6">
        <div class="form-group mb-2">
            <label for="population">Population</label>
            <input type="number" name="population" class="form-control" value="<?= $data['population'] ?>" placeholder="population" required>
            <div class="errorForm"><?= $data['populationError'] ?></div>
          </div>
        </div>

        <div class="col-sm-6">
        <div class="form-group mb-2">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>" placeholder="email" required`>
            <div class="errorForm"><?= $data['emailError'] ?></div>
          </div>
        </div>

        <h6>Continent</h6>
            <select class="form-select" name="continent" aria-label="Default select example" id="continent">
            <option <?= $data['continent'] == "Afrika" ? "selected=\"selected\"" : '' ?> value="Afrika">Afrika</option>
                <option <?= $data['continent'] == "Antartica" ? "selected=\"selected\"" : '' ?> value="Antartica">Antartica</option>
                <option <?= $data['continent'] == "Azië" ? "selected=\"selected\"" : '' ?> value="Azië">Azië</option>
                <option <?= $data['continent'] == "Australië/Oceanië" ? "selected=\"selected\"" : '' ?> value="Australië/Oceanië">Australië/Oceanië</option>
                <option <?= $data['continent'] == "Europa" ? "selected=\"selected\"" : '' ?> value="Europa">Europa</option>
                <option <?= $data['continent'] == "Noord-Amerika" ? "selected=\"selected\"" : '' ?> value="Noord-Amerika">Noord-Amerika</option>
                <option <?= $data['continent'] == "Zuid-Amerika" ? "selected=\"selected\"" : '' ?> value="Zuid-Amerika">Zuid-Amerika</option>
            </select>
        <label for="continent"></label>
        <div class="errorForm"><?= $data['continentError'] ?></div>
      </div>
    </div>

    <a href="/countries/index"><button type="Button">Back</button></a>
    <button type="submit" value="submit">Opslaan</button>
  </div>
</Form>

<?php
  // includes footer
  require APPROOT . '/views/includes/footer.php';
?>   



