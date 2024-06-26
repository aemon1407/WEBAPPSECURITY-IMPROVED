<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="home.css">

    <link rel="icon" href="/images/logo pembina.png" type="image/x-icon">
    <title>Home</title>
</head>
<body>

    <header>
        <div class="logo">
            <img src="/images/logo pembina.png" alt="Logo">
        </div>
        <h1>PEMBINA IIUM</h1>

        <div class="navigation">
            <nav>
              <ul>
                <li><a href="/home/">Home</a></li>
                <li><a href="/about/">About</a></li>
                <li><a href="/passion/">Objectives</a></li>
                <li><a href="/activity/">Activities</a></li>
                <li><a href="/achievement/">Achievements</a></li>
                <li><a href="/organization/">Organization</a></li>
                <li><a href="/registration/">Register</a></li>
                
            </ul>
            </nav>
        </div>
    </header>

    <main>
    <?php
      if (isset($_GET['msg'])) {
          echo '<div class="banner error" role="alert">';
          echo '<p class="banner-title">Pembina Alert</p>';
          echo '<p>' . $_GET['msg'] . '</p>';
          echo '</div>';
      }
      ?>

        <!-- Define the slideshow container -->
    <div id="slideshow">
        <div class="slide-wrapper">
             
        <!-- Define each of the slides
         and write the content -->
          
            <div class="slide">
                <h1 class="slide-number">
                    <img src="/images/header1.jpg">
                </h1> 
            </div>
            <div class="slide">
                <h1 class="slide-number">
                    <img src="/images/header2.jpg">
                </h1> 
            </div>
            <div class="slide">
                <h1 class="slide-number">
                    <img src="/images/header3.jpg">
                </h1> 
            </div>
        </div>
    </div>

<!--Former members feedback section-->
        <div class="content-container">

          <div class= "sub-title">
            <h2>Let's Hear from Our Former IIUM Members</h2>
          </div>

          <div class="feedback-container">
            <div class="feedback-section"> 
              <img src="/images/aiman.png" alt="Image 1">
              <p>"Too many beneficial experiences have transformed me throughout my time with the Pembina. Honestly, I must say this is the best platform for students to polish their leadership skills and build a proper self-image."</p>
              <div class="feedback-name">
                <p><b>Aiman Fathi</b></p>
                <p> Ahli Pembina UIAM</p>
              </div>
            </div>
  
            <div class="feedback-section"> 
              <img src="/images/wafi.jpg" alt="Image 2">
              <p> "Pembina has taught me to be more courageous, to try new things, and I am more aware of current issues. In the past, I was somewhat introverted, but Pembina has pushed me out of my comfort zone to become more bold and leadership-oriented."</p>
              <div class="feedback-name">
                <p><b>Wafi</b></p>
                <p>Ahli Pembina UKM</p>
              </div>
            </div>

              <div class="feedback-section"> 
                <img src="/images/zaleha.jpg" alt="Image 3">
                <p>"Alhamdulillah, since I joined Pembina at the Universiti Kebangsaan Malaysia, I have gained a lot of exposure to the values of leadership itself. I have also been exposed to networking, which will undoubtedly help me in the future."</p>
                <div class="feedback-name">
                  <p><b>Zaleha</b></p>
                  <p>Ahli Pembina UIAM</p>
                </div>
              </div>
          </div>
        </div>
    </main>

  <footer>Follow us on socials:
      <div class="social-icons">
        <a href="https://www.facebook.com/pembina.uiam" class="fa fa-facebook"></a>
        <a href="https://x.com/PEMBINAUIAM?t=StRzLEQRBE4ARnwWPImkGw&s=35" class="fa fa-twitter"></a>
        <a href="https://www.instagram.com/pembina.uiam?igsh=MTI5d2p0emE3ejYwMw==" class="fa fa-instagram"></a>
        <a href="https://www.tiktok.com/@pembina.uiam?_t=8jRTpey8fAu&_r=1" class="fa fa-tumblr"></a>
        <a href="/admin/login.php" class="admin-link hidden">A</a>
      </div>
      
  </footer>

</body>
</html>
