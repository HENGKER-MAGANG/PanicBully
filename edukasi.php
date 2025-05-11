<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edukasi Anti-Bullying - Panic Bully</title>
  <link rel="icon" href="assets/logo_smkn2pinrang.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f9fafb;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    .hero-header {
      background: linear-gradient(to right, #ef5350, #d32f2f);
      color: white;
      padding: 6rem 1rem 4rem;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .hero-header::after {
      content: "";
      position: absolute;
      bottom: -20px;
      left: 0;
      width: 100%;
      height: 40px;
      background: white;
      border-top-left-radius: 50% 20px;
      border-top-right-radius: 50% 20px;
    }

    .hero-header img {
      width: 100px;
      height: auto;
      margin-bottom: 20px;
    }

    .hero-header h1 {
      font-size: 3rem;
      font-weight: bold;
      margin: 20px 0;
      animation: slideUp 1s ease-out;
    }

    .hero-header p {
      font-size: 1.2rem;
      animation: fadeInUp 1.5s ease-out;
    }

    .content-section {
      background: white;
      border-radius: 16px;
      padding: 2rem;
      margin: 2rem;
      box-shadow: 0 6px 20px rgba(0,0,0,0.07);
      animation: fadeInUp 2s ease-out;
    }

    .content-section h3 {
      color: #d32f2f;
      margin-bottom: 1rem;
      font-weight: bold;
      animation: slideLeft 1s ease-out;
    }

    .content-section p,
    .content-section ul,
    .content-section ol,
    .content-section blockquote {
      font-size: 1.05rem;
      line-height: 1.7;
      color: #444;
      animation: fadeInUp 1.2s ease-out;
    }

    .video-container {
      position: relative;
      padding-bottom: 56.25%;
      height: 0;
      overflow: hidden;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      margin: 2rem;
      animation: fadeInUp 2.5s ease-out;
    }

    .video-container iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }

    .quiz-section {
      animation: fadeIn 2s ease-in-out;
    }

    .btn-success {
      background-color: #388e3c;
      border: none;
    }

    .btn-success:hover {
      background-color: #2e7d32;
    }

    .btn-primary {
      background-color: #d32f2f;
      border: none;
      margin-bottom: 2rem;
    }

    .btn-primary:hover {
      background-color: #b71c1c;
    }

    footer {
      background: #1a1a1a;
      color: #ccc;
      padding: 2rem 1rem;
      text-align: center;
      margin-top: 4rem;
      animation: fadeIn 2s ease-in-out;
    }

    /* Animasi */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
      from { transform: translateY(50px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    @keyframes slideLeft {
      from { transform: translateX(-50px); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }
  </style>
</head>
<body>
  <header class="hero-header">
    <img src="https://cdn-icons-png.flaticon.com/512/833/833472.png" alt="Anti-Bullying Logo">
    <h1>Edukasi Anti-Bullying</h1>
    <p>Menumbuhkan Kesadaran dan Empati di SMKN 2 Pinrang</p>
  </header>

  <main>
    <section class="content-section">
      <h3>Apa Itu Bullying?</h3>
      <p>Bullying adalah perilaku agresif yang dilakukan secara sengaja dan berulang kali terhadap seseorang yang dianggap lemah secara fisik atau mental. Bentuknya bisa fisik, verbal, sosial, atau daring (cyberbullying).</p>
    </section>

    <section class="content-section">
      <h3>Jenis-Jenis Bullying</h3>
      <ul>
        <li><strong>Fisik:</strong> Memukul, menendang, mendorong.</li>
        <li><strong>Verbal:</strong> Mengejek, menghina, memberi julukan buruk.</li>
        <li><strong>Sosial:</strong> Mengucilkan dari kelompok, menyebar rumor.</li>
        <li><strong>Cyberbullying:</strong> Menghina di media sosial, menyebarkan konten negatif.</li>
      </ul>
    </section>

    <section class="content-section">
      <h3>Bagaimana Menghadapi Bullying?</h3>
      <ol>
        <li>Jangan membalas dengan kekerasan atau hinaan.</li>
        <li>Bicara dengan guru, wali kelas, atau orang tua.</li>
        <li>Gunakan fitur <a href="report.php">Laporkan Sekarang</a> di website ini.</li>
        <li>Dukung teman yang mengalami bullying.</li>
      </ol>
    </section>

    <section class="content-section">
      <h3>Kata-Kata Penyemangat</h3>
      <blockquote class="blockquote">
        <p>"Kamu tidak sendirian. Suara kamu penting dan berharga."</p>
      </blockquote>
      <blockquote class="blockquote">
        <p>"Berani bicara adalah langkah awal untuk perubahan."</p>
      </blockquote>
    </section>

    <section class="video-container">
      <iframe src="https://www.youtube.com/embed/Jcg93UlOwE0" title="Video Edukasi Anti Bullying" frameborder="0" allowfullscreen></iframe>
    </section>

    <section class="content-section quiz-section">
      <h3>Kuis Edukasi Anti-Bullying</h3>
      <p>Uji pemahamanmu dengan menjawab pertanyaan di bawah ini!</p>

      <form id="quizForm">
        <!-- Pertanyaan 1 -->
        <div class="mb-3">
          <label><strong>1. Apa itu cyberbullying?</strong></label>
          <div class="form-check"><input class="form-check-input" type="radio" name="q1" value="a"> A. Menyebar kabar bohong secara langsung</div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q1" value="b"> B. Menghina orang di internet atau media sosial</div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q1" value="c"> C. Memukul teman saat bertengkar</div>
        </div>

        <!-- Pertanyaan 2 -->
        <div class="mb-3">
          <label><strong>2. Apa yang harus kamu lakukan jika melihat teman dibully?</strong></label>
          <div class="form-check"><input class="form-check-input" type="radio" name="q2" value="a"> A. Diam saja</div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q2" value="b"> B. Membantu membalas</div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q2" value="c"> C. Mendukung teman dan laporkan kepada guru</div>
        </div>

        <!-- Pertanyaan 3 -->
        <div class="mb-3">
          <label><strong>3. Bentuk bullying yang tidak terlihat tapi menyakitkan adalah?</strong></label>
          <div class="form-check"><input class="form-check-input" type="radio" name="q3" value="a"> A. Verbal</div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q3" value="b"> B. Fisik</div>
          <div class="form-check"><input class="form-check-input" type="radio" name="q3" value="c"> C. Sosial dan verbal</div>
        </div>

        <button type="button" class="btn btn-success" onclick="submitQuiz()">Kirim Jawaban</button>
        <div id="quizResult" class="mt-4 alert" style="display:none;"></div>
      </form>
    </section>

    <div class="text-center">
      <a href="index.php" class="btn btn-primary mt-4">Kembali ke Beranda</a>
    </div>
  </main>

  <footer>
    &copy; 2025 Panic Bully | Ikhsan Pratama - SMKN 2 Pinrang
  </footer>

  <script>
    function submitQuiz() {
      const answers = { q1: "b", q2: "c", q3: "c" };
      let score = 0;
      for (let key in answers) {
        const selected = document.querySelector(`input[name="${key}"]:checked`);
        if (selected && selected.value === answers[key]) score++;
      }
      const result = document.getElementById("quizResult");
      result.style.display = "block";
      result.className = "mt-4 alert " + (score === 3 ? "alert-success" : "alert-warning");
      result.innerHTML = `Kamu menjawab <strong>${score}</strong> dari <strong>3</strong> pertanyaan dengan benar. ${score === 3 ? "Luar biasa!" : "Yuk belajar lagi!"}`;
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
