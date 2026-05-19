<template>
  <div class="page">

    <h2 class="title">🎮 Atividades</h2>

    <div v-if="loading">A carregar atividades...</div>

    <div v-else-if="atividades.length === 0">
      Nenhuma atividade encontrada.
    </div>

    <div v-for="atividade in atividades" :key="atividade.id" class="card">

      <p class="question">
        <strong>{{ atividade.enunciado }}</strong>
      </p>

      <!-- 🟦 MULTIPLA ESCOLHA -->
      <div v-if="atividade.tipo_interacao === 'multipla_escolha'">
        <button
          v-for="op in safeOptions(atividade)"
          :key="op"
          class="btn"
          @click="checkAnswer(atividade, op)"
        >
          {{ op }}
        </button>
      </div>

      <!-- ✍️ ESCRITA -->
      <div v-if="atividade.tipo_interacao === 'escrita'">
        <input v-model="atividade.resposta" placeholder="Escreve a resposta..." />
        <button @click="checkAnswer(atividade, atividade.resposta)">Enviar</button>
      </div>

      <!-- 🎨 PINTAR -->
      <div v-if="atividade.tipo_interacao === 'pintar'">
        <canvas class="canvas"></canvas>
        <p>🎨 Pinta a área correta</p>
      </div>

      <!-- ✏️ DESENHAR -->
      <div v-if="atividade.tipo_interacao === 'desenhar'">
        <canvas class="canvas"></canvas>
        <p>✏️ Desenha livremente</p>
      </div>

      <!-- 🗣️ FALAR -->
      <div v-if="atividade.tipo_interacao === 'falar'">
        <button @click="startVoice(atividade)">🎤 Falar</button>
        <p>{{ atividade.voiceResult }}</p>
      </div>

      <!-- 📍 TRAÇAR -->
      <div v-if="atividade.tipo_interacao === 'tracar'">
        <p>📍 Liga os pontos na ordem correta</p>
        <div class="trace-area"></div>
      </div>

      <!-- 🧲 ARRASTAR -->
      <div v-if="atividade.tipo_interacao === 'arrastar'">
        <div class="drag-container">
          <div
            v-for="item in safeItems(atividade)"
            :key="item"
            draggable="true"
            class="drag-item"
          >
            {{ item }}
          </div>
        </div>
      </div>

      <hr />

    </div>

  </div>
</template>

<script setup>
import { ref, onMounted } from "vue"
import { useRoute } from "vue-router"
import api from "../services/api"

const route = useRoute()

const atividades = ref([])
const loading = ref(true)

// 🔥 DEBUG
console.log("NIVEL ID:", route.params.nivelId)

// 🔥 SEGURANÇA: garantir array válido
function safeOptions(atividade) {
  try {
    return atividade.dados?.opcoes ?? []
  } catch {
    return []
  }
}

function safeItems(atividade) {
  try {
    return atividade.dados?.itens ?? []
  } catch {
    return []
  }
}

onMounted(async () => {
  try {
    loading.value = true

    const nivelId = route.params.nivelId

    const res = await api.get(`/atividades/${nivelId}`)

    console.log("ATIVIDADES:", res.data)

    // 🔥 garantir array
    atividades.value = Array.isArray(res.data) ? res.data : []

  } catch (error) {
    console.error("ERRO AO CARREGAR ATIVIDADES:", error)
    atividades.value = []
  } finally {
    loading.value = false
  }
})

function checkAnswer(atividade, resposta) {
  if (resposta === atividade.dados?.correta) {
    alert("✅ Correto!")
  } else {
    alert("❌ Tenta novamente")
  }
}

function startVoice(atividade) {
  const SpeechRecognition =
    window.SpeechRecognition || window.webkitSpeechRecognition

  if (!SpeechRecognition) {
    alert("Reconhecimento de voz não suportado")
    return
  }

  const recognition = new SpeechRecognition()
  recognition.lang = "pt-PT"

  recognition.onresult = (event) => {
    atividade.voiceResult = event.results[0][0].transcript
  }

  recognition.start()
}
</script>

<style scoped>
.page {
  padding: 20px;
  color: white;
  background: #0f172a;
  min-height: 100vh;
}

.title {
  text-align: center;
  margin-bottom: 20px;
}

.card {
  background: #1e293b;
  padding: 15px;
  border-radius: 12px;
  margin-bottom: 15px;
}

.btn {
  margin: 5px;
  padding: 8px 12px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  background: #3b82f6;
  color: white;
}

input {
  padding: 8px;
  border-radius: 6px;
  border: none;
  margin-right: 8px;
}

.canvas {
  width: 100%;
  height: 150px;
  background: white;
  border-radius: 8px;
}

.drag-container {
  display: flex;
  gap: 10px;
}

.drag-item {
  padding: 10px;
  background: #334155;
  border-radius: 8px;
  cursor: grab;
}

.trace-area {
  height: 120px;
  background: #334155;
  border-radius: 8px;
}
</style>