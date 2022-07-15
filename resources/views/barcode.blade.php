@extends('template.navigation')

@section('konten')
<!-- Hero Landing-->
<section class="hero">
  <div class="hero-overlay">
    <span></span>
    <span></span>
  </div>
  <div class="hero-slanted">
    <span></span>
    <span></span>
  </div>
  <div class="hero-content d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <div class="header">
            <h1>Scan QR</h1>
          </div>
        </div>
        <div class="col-md-7">
        </div>
      </div>
    </div>
  </div>
</section>
<section class="landing city">
  <div class="container">
    <h2 style="text-align: left">Scan QR Code</h2>
    <div class="row">

      <div class="col-md-6">

        <video autoplay="true" id="video-webcam">
          Browsermu tidak mendukung bro, upgrade donk!
        </video>
        <button class="btn btn-primary" style="display: flex; margin-top: 10px" onclick="takeSnapshot()">SCAN</button>

      </div>
      <div id="demo" class="col-md-6">

      </div>
    </div>
</section>


<!-- Footer  -->
<section style="margin-top:0!important" class="footer">
  <div class="container">
    <center>
      <img src="{{url('assets/images/logo/KetapangLogo-White.png')}}" width="150px" alt="Logo">
      <font color="#f5f5f5" class="font-segoe text-center nopadding">&#8212; &nbsp; Copyright &copy; 2019 -
        Ketapang - Telkom University</p>
    </center>
  </div>
</section>
<!-- End of Footer  -->
</body>
<script src="{{url('assets/scripts/jquery.min.js')}}"></script>
<script src="{{url('assets/scripts/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{url('assets/scripts/owl.carousel.min.js')}}"></script>
<script type="text/javascript">
  // seleksi elemen video
  var video = document.querySelector("#video-webcam");

  // minta izin user
  navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

  // jika user memberikan izin
  if (navigator.getUserMedia) {
    // jalankan fungsi handleVideo, dan videoError jika izin ditolak
    navigator.getUserMedia({
      video: true
    }, handleVideo, videoError);
  }

  // fungsi ini akan dieksekusi jika  izin telah diberikan
  function handleVideo(stream) {
    video.srcObject = stream;
  }

  // fungsi ini akan dieksekusi kalau user menolak izin
  function videoError(e) {
    // do something
    alert("Izinkan menggunakan webcam untuk demo!")
  }

  function takeSnapshot() {
    const hasil = document.getElementById("demo");
    // buat elemen img
    var img = document.createElement('img');
    var context;

    // ambil ukuran video
    var width = video.offsetWidth,
      height = video.offsetHeight;

    // buat elemen canvas
    canvas = document.createElement('canvas');
    canvas.width = width;
    canvas.height = height;

    // ambil gambar dari video dan masukan 
    // ke dalam canvas
    context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, width, height);

    // render hasil dari canvas ke elemen img
    img.src = canvas.toDataURL('image/png');
    hasil.appendChild(img);
  }
</script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
  // Owl Carousel
  $('.owl-carousel').owlCarousel({
    loop: false,
    margin: 10,
    dots: false,
    nav: false,
    autoplay: false,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        margin: 2,
        stagePadding: 10,
      },
      600: {
        items: 3,
        margin: 10,
        stagePadding: 40,
      },
      1000: {
        items: 4
      }
    }
  });


  // Fetch News API

  const newsUrl =
    "https://newsapi.org/v2/everything?apiKey=f8fd87d48cf746e0a817a4f7a21bafe4&q=bandung AND (wisata OR travel OR turis OR alam OR pemandangan)&language=id";
  axios.get(newsUrl).then(resp => {
    for (let i = 0; i < 6; i++) {
      var d = new Date(resp.data.articles[i].publishedAt);
      d = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ' ' + (d.getHours() > 12 ? d
        .getHours() - 12 : d.getHours()) + ':' + d.getMinutes() + ' ' + (d.getHours() >= 12 ? "PM" :
        "AM");
      $("#newsContainer").append(`
    <div class="col-md-4 col-sm-6 col-xs-6">
    <a href="${resp.data.articles[i].url}" target="_blank">
    <div class="news-card" style='background-image:url("${
      resp.data.articles[i].urlToImage
    }")'>
        <div class="news-content">
                <h5>${resp.data.articles[i].title}</h5>
                <p>${ d }</p>
        </div>
    </div>
    </a>
</div>
    `);
    }
  });

  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      document.querySelector(this.getAttribute('href')).scrollIntoView({
        behavior: 'smooth'

      });
    });
  });
</script>




@endsection

</html>