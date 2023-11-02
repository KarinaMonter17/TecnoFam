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
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="assets/css/taller.css">
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
        <li><a href="perfil.php">Galería</a></li>
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
                <h1>Talleres y servicios</h1>
            </div>
    </div>
    <div class="contenedores">
    <div class="contenedor-izquierdo">
        <div class="titulo">
            <h1>Talleres</h1>
        </div>
        <div class="imagenes">
            <div class="item">
                <a href="#"><img src="assets/iconos/danza.png" class="image-popup" alt="Imagen 1" data-images="assets/slider/img3.jpg,assets/slider/img3.jpg,imagen1-3.jpg" data-description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis sapiente enim et. Perspiciatis ex dolore neque itaque minus unde sequi molestias ratione consequatur doloribus harum, est voluptates repellendus illum quos?"></a>
                <h4>DANZA</h4>
                <p>Huapangos y danzón</p>
                <p>Martes y jueves</p>
            </div>
            <!-- Segundo elemento con imagen, descripción y horario -->
            <div class="item">
                <a href="#"><img src="assets/iconos/pintura.png" class="image-popup" alt="Imagen 2" data-images="assets/slider/img3.jpg,assets/slider/img3.jpg,imagen1-3.jpg" data-description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis sapiente enim et. Perspiciatis ex dolore neque itaque minus unde sequi molestias ratione consequatur doloribus harum, est voluptates repellendus illum quos?"></a>
                <h4>PINTURA</h4>
                <p>En tela</p>
                <p>Lunes</p>
            </div>
            <!-- Tercer elemento con imagen, descripción y horario -->
            <div class="item">
                <a href="#"><img src="assets/iconos/cocina.png" class="image-popup" alt="Imagen 3" data-images="assets/slider/img3.jpg,assets/slider/img3.jpg,imagen1-3.jpg" data-description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis sapiente enim et. Perspiciatis ex dolore neque itaque minus unde sequi molestias ratione consequatur doloribus harum, est voluptates repellendus illum quos?"></a>
                <h4>COCINA</h4>
                <p>Miércoles y viernes</p>
            </div>
        </div>
    </div>

    <div class="contenedor-derecho">
        <div class="titulo">
            <h1>Servicios</h1>
        </div>
        <div class="imagenes">
            <div class="item">
                <a href="#"><img src="assets/iconos/fisica.png" class="image-popup" alt="Imagen 1" data-images="assets/slider/img3.jpg,assets/slider/img3.jpg,imagen1-3.jpg" data-description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis sapiente enim et. Perspiciatis ex dolore neque itaque minus unde sequi molestias ratione consequatur doloribus harum, est voluptates repellendus illum quos?"></a>
                <h4>ATENCIÓN FÍSICA</h4>
            </div>
            <!-- Segundo elemento con imagen, descripción y horario -->
            <div class="item">
                <a href="#"><img src="assets/iconos/psicologia.png" class="image-popup" alt="Imagen 2" data-images="assets/slider/img3.jpg,assets/slider/img3.jpg,imagen1-3.jpg" data-description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis sapiente enim et. Perspiciatis ex dolore neque itaque minus unde sequi molestias ratione consequatur doloribus harum, est voluptates repellendus illum quos?"></a>
                <h4>ATENCIÓN PSICOLÓGICA</h4>
            </div>
            <!-- Tercer elemento con imagen, descripción y horario -->
            <div class="item">
                <a href="#"><img src="assets/iconos/medica.png" class="image-popup" alt="Imagen 3" data-images="assets/slider/img3.jpg,assets/slider/img3.jpg,imagen1-3.jpg" data-description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis sapiente enim et. Perspiciatis ex dolore neque itaque minus unde sequi molestias ratione consequatur doloribus harum, est voluptates repellendus illum quos?"></a>
                <h4>ATENCIÓN MEDICA</h4>
            </div>

        </div>
        </div>
    </div>
    <!-- Ventana emergente con estilo "display: none" inicialmente -->
  <div class="popup" id="popup" style="display: none">
    <div class="popup-content">
      <div class="carousel active">
        <img src="" alt="Imagen">
        <p>Descripción de la imagen</p>
      </div>
    </div>
  </div>

  <script>
    const imagePopups = document.querySelectorAll('.image-popup');
    const popup = document.getElementById('popup');
    const carousel = document.querySelector('.carousel');
    const carouselImage = carousel.querySelector('img');
    const carouselDescription = carousel.querySelector('p');

    let currentIndex = 0;
    let currentImages = [];
    let currentDescription = "";

    function showCurrentImage(imageIndex) {
      currentIndex = imageIndex;
      currentImages = imagePopups[imageIndex].getAttribute('data-images').split(',');
      currentDescription = imagePopups[imageIndex].getAttribute('data-description');

      carouselImage.src = currentImages[0];
      carouselDescription.textContent = currentDescription;
      popup.style.display = 'flex';

      // Iniciar la rotación automática
      autoRotateImages();
    }

    function autoRotateImages() {
      setInterval(() => {
        currentIndex = (currentIndex + 1) % currentImages.length;
        carouselImage.src = currentImages[currentIndex];
      }, 5000); // Cambia la imagen cada 5 segundos
    }

    imagePopups.forEach((image, index) => {
      image.addEventListener('click', () => {
        showCurrentImage(index);
      });
    });

    popup.addEventListener('click', (event) => {
      if (event.target === popup) {
        popup.style.display = 'none';
      }
    });
  </script>

    <footer>
        Carretera Mexico- Laredo s/n, esq, con av. Insurgentes,instalaciones del antiguo patrimonio, Ixmiquilpan, Hgo., Ixmiquilpan, Mexico, 42300
    </footer>
    
</body>
</html>