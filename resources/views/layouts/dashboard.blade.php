<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('title', 'Home: ')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <!-- <link rel="stylesheet" href="/public/css/dasboard.css"> -->

</head>
<body>
<header id="home" class="bg-white">
        <div class="section__container header__container">
        <div class="header__content">
            <h2>Hallo, Welcome To</h2>
            <h1>E-Litera</h1>
            <h3>Mastering Skills Without Having to go to College</h3>
            <p>
            Learn directly from the experts through practical modules and tutorials. Realize your dreams without having to wait for graduation!
            </p>
            <div class="header__btns">
            <a href="#intro"><button class="btn">Read More</button></a>
            </div>
        </div>
        <div class="header__image">
            <img class="max-w-screen-lg mx-auto mt-8 min-w-full h-[600px] floating animate-bounce" src="{{asset('images/header.png')}}"" />
        </div>
        </div>
</header>

  <section class="section__container intro__container bg-gray-10" id="intro">
    <div class="intro__image">
      <img src="{{asset('images/icon.png')}}" alt="intro" />
    </div>
    <div class="intro__content">
      <p class="section__subheader">INTRO</p>
      <h2 class="section__header">About E-Litera</h2>
      <p class="intro__description">
        E-LITERA is a platform specifically designed to help children who cannot continue to college after graduating from high school/vocational school. With a focus on developing IT skills.<br> E-LITERA will provide easy and flexible access to learn various skills that suit each person's interests and potential.
      </p>
    </div>
  </section>

  <section class="section_container service_container" id="service">
    <p class="section__subheader" style="margin-top: 70px">BENEFIT</p>
    <h2 class="section__header">From Our Learning</h2>
    <div class="service__grid">
      <div class="service__card">
        <span><i class="ri-window-fill"></i></span>
        <h4>Training From Experts</h4>
        <p>
            Immerse yourself in knowledge with industry experts guiding you through hands-on experience.
        </p>
      </div>
      <div class="service__card">
        <span><i class="ri-store-line"></i></span>
        <h4>Online Progress</h4>
        <p>
            Earn an accredited degree from the comfort of your home, opening the door to a world of possibilities.
        </p>
      </div>
      <div class="service__card">
        <span><i class="ri-smartphone-line"></i></span>
        <h4>Short Courses</h4>
        <p>
            Upgrade your skills with our concise, focused short courses, designed for fast, effective learning.
        </p>
      </div>
      <div class="service__card">
        <span><i class="ri-share-fill"></i></span>
        <h4>1.5k Video Courses</h4>
        <p>
            Explore an extensive library of over 1.5k video courses covering a wide range of subjects, offering a visual learning experience.
        </p>
      </div>

    </div>
  </section>
</body>
</html>