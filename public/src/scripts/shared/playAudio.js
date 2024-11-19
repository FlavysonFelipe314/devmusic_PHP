let audioBox = document.getElementById("contentAudio");
let musicPlaying = document.getElementById("music-playing");
let currentAudioPlayer = null;

function playSound(audio) {
  // Pausa e remove o áudio anterior
  if (currentAudioPlayer) {
    currentAudioPlayer.pause();
    currentAudioPlayer.remove();
  }

  // Cria o novo player de áudio
  const audioPlayer = document.createElement("audio");
  audioPlayer.src = `media/music/${audio}`;
  audioPlayer.autoplay = true;

  // Atualiza o player atual
  audioBox.innerHTML = "";
  audioBox.appendChild(audioPlayer);
  currentAudioPlayer = audioPlayer;

  // Botão Play/Pause
  const playPauseBtn = document.getElementById("playPauseBtn");
  playPauseBtn.innerHTML =
    "<span class='material-symbols-outlined'>pause</span>";
  playPauseBtn.onclick = () => {
    if (audioPlayer.paused) {
      audioPlayer.play();
      playPauseBtn.innerHTML =
        "<span class='material-symbols-outlined'>pause</span>";
    } else {
      audioPlayer.pause();
      playPauseBtn.innerHTML =
        '<span class="material-symbols-outlined">play_arrow</span>';
    }
  };

  // Controle de barra de progresso
  const progressContainer = document.getElementById("progressContainer");
  const progressBar = document.getElementById("progressBar");
  const currentTimeDisplay = document.getElementById("currentTime");

  progressContainer.onclick = (e) => {
    const containerWidth = progressContainer.offsetWidth;
    const clickX = e.offsetX;
    const newTime = (clickX / containerWidth) * audioPlayer.duration;
    audioPlayer.currentTime = newTime;
  };

  // Atualização da barra de progresso
  audioPlayer.ontimeupdate = () => {
    const progressPercent =
      (audioPlayer.currentTime / audioPlayer.duration) * 100;
    progressBar.style.width = `${progressPercent}%`;
  };
}

function activeSound(capa, titulo, artista) {
  musicPlaying.innerHTML = `
  <a href=""><img src="media/capas/${capa}" alt="" /></a>
    <a href="" class="text">
      <h2>${titulo}</h2>
      <h3>${artista}</h3>
    </a>
`;
}

document.querySelectorAll(".music-single").forEach((item) => {
  item.addEventListener("click", function () {
    const itemId = this.id;
    console.log("Bloco clicado com ID:", itemId);

    fetch(`selecionaMusica_ajax?id=${encodeURIComponent(itemId)}`, {
      method: "GET",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error(`Erro: ${response.status}`);
        }
        return response.json();
      })
      .then((data) => {
        console.log(data.audio);
        let audio = data.audio;
        let capa = data.capa;
        let titulo = data.titulo;
        let artista = data.artista;

        playSound(audio);
        activeSound(capa, titulo, artista);
      })
      .catch((error) => {
        console.error("Erro na requisição:", error);
      });
  });
});
