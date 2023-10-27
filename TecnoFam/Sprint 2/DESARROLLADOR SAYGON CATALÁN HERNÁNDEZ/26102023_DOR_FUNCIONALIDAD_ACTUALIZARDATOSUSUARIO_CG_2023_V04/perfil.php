<?php
session_start();

if (!isset($_SESSION["user_name"])) {
    // Si el usuario no está conectado, redirige al formulario de inicio de sesión
    header("Location: login.html");
    exit();
}

$user_name = $_SESSION["user_name"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/perfil.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="shortcut icon" href="assets/iconos/icono.png">
    <title>Centro Gerontológico integral</title>
</head>
<body>
    <nav>
        <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="logo">
            <img src="assets/logo/logo.png">
            <div>
                <h1 class="logo-text">Centro gerontológico integral</h1>
                <p>Horarios de 10:00 am a 03:00 pm</p>
            </div>
        </div>
        <ul class="menu">
        <li><a href="talleryservicio.php">Talleres y servicios</a></li>
        <!-- Agregar el perfil del usuario en la parte superior derecha -->
        <div class="profile">
            <div class="profile-name">Usuario: <?php echo $user_name; ?></div>
            <div class="floating-menu">
                <ul class="profile-options">
                    <li><a href="editarperfil.php">Actualizar datos</a></li>
                    <li><a href="cerrarsesion.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </ul>
    </nav>

    
    <div class="content">
            <div class="galeri">
                <h1>Galería</h1>
            </div>
    </div>
    <link rel="stylesheet" href="assets/css/styleslider.css">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <img src="assets/slider/img10.jpg" alt="">
          </div>
          <div class="swiper-slide">
            <img src="assets/slider/img4.jpg" alt="">
          </div>
          <div class="swiper-slide">
            <img src="assets/slider/img6.jpg" alt="">
          </div>
          <div class="swiper-slide">
            <img src="assets/slider/img7.jpg" alt="">
          </div>
          <div class="swiper-slide">
            <img src="assets/slider/img8.jpg" alt="">
          </div>
          <div class="swiper-slide">
            <img src="assets/slider/img9.jpg" alt="">
          </div>
          <div class="swiper-slide">
            <img src="assets/slider/img3.jpg" alt="">
          </div>
          <div class="swiper-slide">
            <img src="assets/slider/img11.jpg" alt="">
          </div>
          <div class="swiper-slide">
            <img src="assets/slider/img12.jpg" alt="">
          </div>
    
          <!-- 15 div -->
        
        </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

      <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        coverflowEffect: {
          rotate: 15,
          stretch: 0,
          depth: 300,
          modifier: 1,
          slideShadows: true,
        },
        loop: true,
        autoplay: {
          delay: 3000, // 3000 milisegundos (3 segundos) entre diapositivas
          disableOnInteraction: false, // Permite que el autoplay continúe después de la interacción del usuario
        },
      });
    </script>

    <div class="clearfix"></div>
   
    <div class="content">
        <div class="container">
            <h2>Misión</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium minima amet nesciunt atque nemo fugit esse dolores harum, excepturi nostrum sed dolorum, earum repellendus aut? A exercitationem autem minima aspernatur?</p>
        </div>
        <div class="container2">
          <h2>Visión</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium minima amet nesciunt atque nemo fugit esse dolores harum, excepturi nostrum sed dolorum, earum repellendus aut? A exercitationem autem minima aspernatur?</p>
      </div>
    </div>
    <footer>
        Carretera Mexico- Laredo s/n, esq, con av. Insurgentes,instalaciones del antiguo patrimonio, Ixmiquilpan, Hgo., Ixmiquilpan, Mexico, 42300
    </footer>
</body>
</html>
