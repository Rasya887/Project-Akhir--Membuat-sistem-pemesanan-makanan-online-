
<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color:#8B0000;">
  <div class="container-lg">
    <a class="navbar-brand" href="index.php">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
      </svg> PadangFast
    </a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php
              // Cek apakah $hasil ada dan mengandung username
              if (!empty($hasil) && isset($hasil['username'])) {
                echo $hasil['username'];
              } else {
                echo 'Guest';
              }
            ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end mt-2">
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalPassword"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
              <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
            </svg>Password</a></li>
            <li><a class="dropdown-item" href="login.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
              <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
            </svg>Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="modal fade" id="ModalEdit<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> data user</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form  class="needs-validation" novalidate action="proses/proses-edit-user.php" method="POST">
            <input type="hidden" value="<?php echo $row['id'] ?>" name="id"> 
            <div class="row"  style="display: flex; justify-content: flex-start;">
  <div class="col-lg-6">
    <div class="form-floating mb-3">
      <input disabled type="password" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required value="<?php echo $_SESSION['username_padangfast']; ?>">
      <label for="floatingInput">Username</label>
      <div class="invalid-feedback">
        Masukkan Username.
      </div>
    </div>
  </div>
  <div class="col-lg-6">
  <div class="form-floating mb-3">
      <input disabled type="email" class="form-control" id="floatingPassword" name="password" required">
      <label for="floatingPassword">Password lama</label>
      <div class="invalid-feedback">
        Masukkan password lama.
      </div>
    </div>
  </div>
</div>
</div>
</div>
<div class="col">
<div class="form-floating mb-3">
  <input type="password" class="form-control" id="floatingInput" placeholder="*****"  value="12345" name="password" required  value="<?php echo $row['password'] ?>">
  <label for="floatingInput">password</label>
  <div class="invalid-feedback">
        Masukan password
      </div>
</div>
</div>
</div>
<div class="modal-footer">
    
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="input-user-validate" value="12345">Save changes</button>

            </div>
</form>
            </div>
        </div>
    </div>
</div>
             <!-- modal password-->
     <div class="modal fade" id="ModalPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> Change password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form  class="needs-validation" novalidate action="proses/proses-ubah-password.php" method="POST">
            <input type="hidden" value="<?php echo $row['id'] ?>" name="id"> 
                    <div class="row">
<div class="col-lg-6">
<div class="form-floating mb-3">
  <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required value="<?php echo $_SESSION['username_padangfast']?>">
  <label for="floatingInput">username</label>
  <div class="invalid-feedback">
        Masukan username 
      </div>
      </div>
</div>
</div>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="form-floating mb-3">
      <input type="password" class="form-control" id="floatingPassword"
             name="passwordlama" required>
      <label for="floatingInput">Password Lama</label>
      <div class="invalid-feedback">
        Masukkan Password Lama.
      </div>
    </div>
  </div>
  <div class="row">
  <div class="col-lg-6">
    <div class="form-floating mb-3">
      <input type="password" class="form-control" id="floatingPassword"
             name="passwordbaru" required>
      <label for="floatingInput">Password baru</label>
      <div class="invalid-feedback">
        Masukkan Password baru.
      </div>
    </div>
  </div>
  <div class="row">
  <div class="col-lg-6">
    <div class="form-floating mb-3">
      <input type="password" class="form-control" id="floatingPassword"
             name="repasswordbaru" required>
      <label for="floatingInput">Password baru</label>
      <div class="invalid-feedback">
        ulangi masukkan password baru.
      </div>
    </div>
  </div>
</div>
</div>
<div class="modal-footer">
    
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="ubah-password-validate" value="12345">Save changes</button>

            </div>
</form>
            </div>
        </div>
    </div>
</div>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>

