<template>
  <div class="voice-box">

    <!-- 🖼️ IMAGEM -->
    <div class="image-box">
      <img
        :src="imageUrl"
        alt="atividade"
        v-if="imageUrl"
      />
    </div>

    <!-- 🎤 BOTÃO -->
    <button class="mic" @click="startVoiceRecognition">
      🎤 Falar
    </button>

    <!-- 🌊 ONDAS -->
    <div v-if="listening" class="waves">
      <span></span><span></span><span></span><span></span>
    </div>

    <!-- 🧠 TEXTO -->
    <p class="text">
      {{ texto || "Fala o que estás a ver..." }}
    </p>

    <!-- 🎯 FEEDBACK -->
    <div class="feedback" v-if="status !== 'idle'">

      <div v-if="status === '✔ correto'" class="success">
        🎉 Muito bem!
        <br />
        ✔ Resposta correta: <strong>{{ texto }}</strong>
      </div>

      <div v-else-if="status === '❌ errado'" class="error">
        ❌ Tenta outra vez
      </div>

      <div v-else class="info">
        {{ status }}
      </div>

    </div>

  </div>
</template>

<script setup>
import { ref, computed } from "vue"
import { useVoice } from "../../composables/useVoice"

const props = defineProps({
  atividade: Object
})

const emit = defineEmits(["correct", "nivelCompleto"])

const texto = ref("")
const status = ref("idle")
const listening = ref(false)

const { startVoice } = useVoice()

const baseUrl = "http://localhost:8000"

/* 🖼️ imagem */
const imageUrl = computed(() => {
  if (!props.atividade?.imagem) return null
  return `${baseUrl}/images/${props.atividade.imagem}`
})

/* 🧠 normalização */
function normalize(text) {
  return text
    ?.toLowerCase()
    .trim()
    .normalize("NFD")
    .replace(/[\u0300-\u036f]/g, "")
    .replace(/[.,!?]/g, "")
}

/* 🎯 resposta correta */
function getCorrectAnswer() {
  return (
    props.atividade?.resposta ||
    props.atividade?.dados?.resposta ||
    props.atividade?.dados?.audio_texto?.replace("Diz:", "").trim() ||
    ""
  )
}

/* 🎤 reconhecimento */
function startVoiceRecognition() {
  status.value = "🎤 a ouvir..."
  listening.value = true

  startVoice(
    (result) => {
      texto.value = result

      const correta = getCorrectAnswer()

      const said = normalize(result)
      const expected = normalize(correta)

      if (!expected) {
        status.value = "⚠ sem resposta correta definida"
        listening.value = false
        return
      }

      const isCorrect =
        said === expected ||
        said.includes(expected) ||
        expected.includes(said)

      if (isCorrect) {
        status.value = "✔ correto"

        playSuccessSound()

        setTimeout(() => {
          speakChild("Muito bem! Acertaste!")

          // ✔ avisa que está correto
          emit("correct")

          // 🚀 avisa que pode avançar nível
          emit("nivelCompleto")

        }, 600)

      } else {
        status.value = "❌ errado"

        playErrorSound()

        setTimeout(() => {
          speakChild(`A resposta correta é ${correta}. Repete comigo.`)
        }, 500)
      }
    },
    {
      onStart: () => (listening.value = true),
      onEnd: () => (listening.value = false),
      onError: () => {
        listening.value = false
        status.value = "❌ erro no microfone"
      }
    }
  )
}

/* 🔊 sons */
function playSuccessSound() {
  new Audio("https://actions.google.com/sounds/v1/cartoon/clang_and_wobble.ogg").play()
}

function playErrorSound() {
  new Audio("https://actions.google.com/sounds/v1/cartoon/boing.ogg").play()
}

/* 🧒 voz infantil */
function speakChild(text) {
  if (!text) return

  const utterance = new SpeechSynthesisUtterance(text)
  utterance.lang = "pt-PT"
  utterance.pitch = 1.7
  utterance.rate = 0.9

  const voices = speechSynthesis.getVoices()
  utterance.voice =
    voices.find(v => v.lang.includes("pt")) || voices[0]

  speechSynthesis.cancel()
  speechSynthesis.speak(utterance)
}
</script>

<style scoped>
.voice-box {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
  padding: 20px;
}

.image-box img {
  width: 220px;
  border-radius: 12px;
  border: 2px solid #ddd;
}

.mic {
  padding: 12px 18px;
  background: #ff5722;
  color: white;
  border: none;
  border-radius: 10px;
  cursor: pointer;
}

.waves {
  display: flex;
  gap: 5px;
}

.waves span {
  width: 6px;
  height: 10px;
  background: #ff5722;
  animation: wave 1s infinite ease-in-out;
}

.waves span:nth-child(2) { animation-delay: 0.1s; }
.waves span:nth-child(3) { animation-delay: 0.2s; }
.waves span:nth-child(4) { animation-delay: 0.3s; }

@keyframes wave {
  0%, 100% { height: 10px; }
  50% { height: 35px; }
}

/* feedback */
.feedback {
  margin-top: 10px;
  text-align: center;
  font-size: 18px;
}

.success {
  background: #e6ffed;
  color: #1b7f3a;
  padding: 12px;
  border-radius: 10px;
  font-weight: bold;
}

.error {
  background: #ffe6e6;
  color: #b00020;
  padding: 12px;
  border-radius: 10px;
}

.info {
  color: #444;
}

.text {
  font-size: 18px;
  font-weight: bold;
}
</style>