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
      padding-bottom: 6rem;
    }

    .header {
      background: linear-gradient(135deg, #ef5350, #d32f2f);
      color: white;
      padding: 4rem 1rem 3rem;
      text-align: center;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      position: relative;
    }

    .header img.logo {
      max-height: 80px;
      margin-bottom: 1rem;
    }

    .header h1 {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .header p {
      font-size: 1.2rem;
    }

    .content-section {
      background: white;
      border-radius: 16px;
      padding: 2rem;
      margin-bottom: 2rem;
      box-shadow: 0 6px 20px rgba(0,0,0,0.07);
      transition: transform 0.2s ease-in-out;
    }

    .content-section:hover {
      transform: translateY(-5px);
    }

    .content-section h3 {
      color: #d32f2f;
      margin-bottom: 1rem;
      font-weight: bold;
    }

    .quiz-section label {
      display: block;
      margin-bottom: 0.5rem;
    }

    .form-check {
      margin-bottom: 0.5rem;
    }

    #quizResult {
      font-weight: bold;
    }

    .btn-success {
      background-color: #388e3c;
      border: none;
    }

    .btn-success:hover {
      background-color: #2e7d32;
    }

    footer {
      background-color: #111;
      color: white;
      text-align: center;
      padding: 1rem;
      position: fixed;
      bottom: 0;
      width: 100%;
      font-size: 0.9rem;
    }

    .video-container {
      position: relative;
      padding-bottom: 56.25%;
      padding-top: 30px;
      height: 0;
      overflow: hidden;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .video-container iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
  </style>
</head>
<body>

  <div class="header">
    <img src="https://cdn-icons-png.flaticon.com/512/833/833472.png" alt="Anti-Bullying Logo" class="logo" />
    <h1>Edukasi Anti-Bullying</h1>
    <p>Menumbuhkan Kesadaran dan Empati di SMKN 2 Pinrang</p>
  </div>

  <div class="container mt-4">
    <div class="content-section">
      <h3>Apa Itu Bullying?</h3>
      <p>Bullying adalah perilaku agresif yang dilakukan secara sengaja dan berulang kali terhadap seseorang yang dianggap lemah secara fisik atau mental. Bentuknya bisa fisik, verbal, sosial, atau daring (cyberbullying).</p>
    </div>

    <div class="content-section">
      <h3>Jenis-Jenis Bullying</h3>
      <ul>
        <li><strong>Fisik:</strong> Memukul, menendang, mendorong.</li>
        <li><strong>Verbal:</strong> Mengejek, menghina, memberi julukan buruk.</li>
        <li><strong>Sosial:</strong> Mengucilkan dari kelompok, menyebar rumor.</li>
        <li><strong>Cyberbullying:</strong> Menghina di media sosial, menyebarkan konten negatif.</li>
      </ul>
    </div>

    <div class="content-section">
      <h3>Bagaimana Menghadapi Bullying?</h3>
      <ol>
        <li>Jangan membalas dengan kekerasan atau hinaan.</li>
        <li>Bicara dengan guru, wali kelas, atau orang tua.</li>
        <li>Gunakan fitur <a href="report.php">Laporkan Sekarang</a> di website ini.</li>
        <li>Dukung teman yang mengalami bullying.</li>
      </ol>
    </div>

    <div class="content-section">
      <h3>Kata-Kata Penyemangat</h3>
      <blockquote class="blockquote">
        <p>"Kamu tidak sendirian. Suara kamu penting dan berharga."</p>
      </blockquote>
      <blockquote class="blockquote">
        <p>"Berani bicara adalah langkah awal untuk perubahan."</p>
      </blockquote>
    </div>

    <div class="content-section video-container mb-4">
      <iframe src="https://www.youtube.com/embed/Jcg93UlOwE0" title="Video Edukasi Anti Bullying" frameborder="0" allowfullscreen></iframe>
    </div>

    <div class="content-section quiz-section">
      <h3>Kuis Edukasi Anti-Bullying</h3>
      <p>Uji pemahamanmu dengan menjawab pertanyaan di bawah ini!</p>

      <form id="quizForm">
        <div class="mb-3">
          <label><strong>1. Apa itu cyberbullying?</strong></label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q1" value="a" id="q1a">
            <label class="form-check-label" for="q1a">A. Menyebar kabar bohong secara langsung</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q1" value="b" id="q1b">
            <label class="form-check-label" for="q1b">B. Menghina orang di internet atau media sosial</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q1" value="c" id="q1c">
            <label class="form-check-label" for="q1c">C. Memukul teman saat bertengkar</label>
          </div>
        </div>

        <div class="mb-3">
          <label><strong>2. Apa yang harus kamu lakukan jika melihat teman dibully?</strong></label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q2" value="a" id="q2a">
            <label class="form-check-label" for="q2a">A. Diam saja</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q2" value="b" id="q2b">
            <label class="form-check-label" for="q2b">B. Membantu membalas</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q2" value="c" id="q2c">
            <label class="form-check-label" for="q2c">C. Mendukung teman dan laporkan kepada guru</label>
          </div>
        </div>

        <div class="mb-3">
          <label><strong>3. Bentuk bullying yang tidak terlihat tapi menyakitkan adalah?</strong></label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q3" value="a" id="q3a">
            <label class="form-check-label" for="q3a">A. Verbal</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q3" value="b" id="q3b">
            <label class="form-check-label" for="q3b">B. Fisik</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q3" value="c" id="q3c">
            <label class="form-check-label" for="q3c">C. Sosial dan verbal</label>
          </div>
        </div>

        <button type="button" class="btn btn-success" onclick="submitQuiz()">Kirim Jawaban</button>
      </form>

      <div id="quizResult" class="mt-4 alert" style="display:none;"></div>
    </div>

    <div class="text-center">
      <a href="index.php" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>
  </div>

  <footer>
    &copy; 2025 Panic Bully | Ikhsan Pratama - SMKN 2 Pinrang
  </footer>

  <script>
    function submitQuiz() {
      const answers = {
        q1: "b",
        q2: "c",
        q3: "c"
      };

      let score = 0;
      let total = Object.keys(answers).length;

      for (let key in answers) {
        let selected = document.querySelector(`input[name="${key}"]:checked`);
        if (selected && selected.value === answers[key]) {
          score++;
        }
      }

      const result = document.getElementById("quizResult");
      result.style.display = "block";
      result.className = "mt-4 alert " + (score === total ? "alert-success" : "alert-warning");
      result.innerHTML = `Kamu menjawab <strong>${score}</strong> dari <strong>${total}</strong> pertanyaan dengan benar. ${score === total ? "Luar biasa!" : "Yuk belajar lagi!"}`;
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
