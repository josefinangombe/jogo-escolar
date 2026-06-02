<template>
  <div class="page">
    <h2>🎮 Atividades</h2>

    <div class="progress">
      <div class="progress-bar" :style="{ width: progresso + '%' }"></div>
    </div>

    <div v-if="loading">A carregar...</div>

    <div v-else-if="atividadeAtual" class="card">

      <div class="enunciado-card">
        <p class="question">{{ atividadeAtual.enunciado }}</p>
      </div>

      <div class="activity-container">
        <component
          :is="getComponent(atividadeAtual.tipo_interacao)"
          :atividade="atividadeAtual"
          :key="atividadeAtual.id"
          @correct="onCorrect"
          @wrong="onWrong"
        />
      </div>

      <p v-if="correto" class="feedback correto">
        ✔ Correto!
      </p>

      <button
        v-if="correto"
        class="btn-continuar"
        @click="proximaAtividade"
      >
        🚀 Continuar
      </button>

    </div>

    <div v-else class="fim">
      🎉 Parabéns! Terminaste todas as atividades.
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue"
import { useRoute, useRouter } from "vue-router"
import { useAtividades } from "../composables/useAtividades"
import api from "../services/api" 

// componentes
import MultiplaEscolha from "../components/atividades/MultiplaEscolha.vue"
import Escrita from "../components/atividades/Escrita.vue"
import Desenhar from "../components/atividades/Desenhar.vue"
import Pintar from "../components/atividades/Pintar.vue"
import Tracado from "../components/atividades/Tracado.vue"
import Falar from "../components/atividades/Falar.vue"
import Arrastar from "../components/atividades/Arrastar.vue"

const route = useRoute()
const router = useRouter()

const nivelId = route.params.nivelId
const subtemaId = computed(() => route.query.subtemaId)

const { atividades, loading, fetchAtividades } = useAtividades(nivelId)

const indexAtual = ref(0)
const correto = ref(false)

const atividadeAtual = computed(() => {
  return atividades.value[indexAtual.value]
})

const progresso = computed(() => {
  if (!atividades.value.length) return 0
  return (indexAtual.value / atividades.value.length) * 100
})

function getComponent(tipo) {
  const map = {
    multipla_escolha: MultiplaEscolha,
    escrita: Escrita,
    desenhar: Desenhar,
    pintar: Pintar,
    tracado: Tracado,
    falar: Falar,
    arrastar: Arrastar
  }
  return map[tipo] || null
}

function onCorrect() {
  correto.value = true
}

function onWrong() {
  correto.value = false
}

function proximaAtividade() {
  correto.value = false

  if (indexAtual.value < atividades.value.length - 1) {
    indexAtual.value++
  } else {
    finalizarNivel()
  }
}

/* 🎯 CORREÇÃO DA API DO LARAVEL + LOCALSTORAGE */
async function finalizarNivel() {
  // Garante que transformamos o parâmetro da rota num número inteiro limpo
  const idDoNivelValido = parseInt(route.params.nivelId, 10);

  // 1. Salva localmente para segurança imediata
  try {
    localStorage.setItem(`nivel_${idDoNivelValido}_concluido`, 'true')
  } catch (e) {
    console.error(e)
  }

  // 2. Envia para a rota CORRETA do teu Laravel (POST /api/progresso)
  try {
    await api.post('/progresso', {
      nivel_id: idDoNivelValido, // 🌟 Alterado para passar o ID numérico purificado
      crianca_id: 1, // Substitui pelo ID real da criança/utilizador se tiveres autenticação
      concluido: true
    })
    console.log("Progresso gravado no Laravel!")
  } catch (err) {
    console.warn("Erro ao salvar no Laravel, mas o jogo vai avançar localmente:", err.message)
    if (err.response) {
      console.error("Detalhes do erro do Laravel:", err.response.data)
    }
  } finally {
    // 3. CORREÇÃO DO VUE ROUTER: Redireciona para /subtemas/:temaId que existe no teu router
    if (subtemaId.value) {
      router.push(`/subtemas/${subtemaId.value}`)
    } else {
      router.push('/') // Fallback para a raiz caso o subtemaId não venha na query string
    }
  }
}

onMounted(async () => {
  await fetchAtividades()
})
</script>

<style scoped>
.page { padding: 20px; max-width: 500px; margin: 0 auto; min-height: 100vh; }
.progress { height: 8px; background: #222; border-radius: 10px; margin-bottom: 15px; overflow: hidden; }
.progress-bar { height: 100%; background: #ffd700; transition: width 0.3s ease; }
.card { background: rgba(255,255,255,0.05); padding: 20px; border-radius: 15px; }
.enunciado-card { background: linear-gradient(135deg, #3e0f44, #6d2e7d); color: white; padding: 15px; border-radius: 12px; margin-bottom: 20px; }
.question { font-size: 18px; font-weight: bold; }
.feedback { margin-top: 10px; }
.correto { color: #00ff88; }
.btn-continuar { margin-top: 20px; padding: 12px 20px; font-size: 16px; font-weight: bold; color: white; background: linear-gradient(135deg, #00c853, #64dd17); border: none; border-radius: 12px; cursor: pointer; }
.fim { text-align: center; font-size: 20px; margin-top: 40px; }
</style>