<div class="col-lg mt-2">
    <!-caroussel-!>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-slide="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner rounded">
    <div class="carousel-item active">
      <img src="asset/img/mobile.jpg" class="img-fluid" style="height:250px; width:1000px; object-fit:cover" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Welcome to restaurant Website page</h5>
        <p>you cant order anything</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="asset/img/rendang.jpg" class="img-fluid" style="height:250px; width:1000px; object-fit:cover" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>pictures menu</h5>
        <p>berikut berbagai foto menu kami</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="asset/img/drink.jpg" class="img-fluid" style="height:250px; width:1000px; object-fit:cover" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>nikmati kemudahan</h5>
        <p>dalam memesan makanan di restaurant kami</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
        <div class="card mt-4 border-0 bg-light">
  <div class="card-body text-center">
    <h5 class="card-title">why? padangfast</h5>
    <p class="card-text">Padang Fast adalah restoran modern yang menyajikan cita rasa autentik masakan Padang dengan konsep cepat saji. Restoran ini menawarkan beragam menu khas seperti rendang, ayam pop, gulai, dan sambal hijau, disajikan dengan cepat tanpa mengurangi kelezatan tradisional. Dengan suasana yang nyaman dan pelayanan efisien, Padang Fast cocok untuk makan siang praktis atau santapan keluarga. Harga bersahabat, kualitas terjamin, dan rasa yang menggugah selera menjadikan Padang Fast pilihan favorit pecinta masakan Nusantara.</p>
    <a href="../padangfast/order.php?x=order" class="btn text-white" style="background-color: maroon;">Pesan</a>
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