<template>
  <div class="page">

    <div
      v-for="(subtema, sIndex) in subtemas"
      :key="subtema.id"
      class="subtema-block"
    >

      <div
        class="header"
        :style="{ background: subtema.color }"
      >
        <h2>{{ subtema.nome }}</h2>
      </div>

      <div class="map">

        <div
          v-for="(nivel, index) in subtema.niveis"
          :key="nivel.id"
          class="level"
          @click="openNivel(subtema, nivel)"
        >

          <div v-if="index !== 0" class="line"></div>

          <div
            class="circle"
            :style="getNivelStyle(nivel)"
          >
            <span v-if="nivel.locked">🔒</span>
            <span v-else>⭐</span>
          </div>

          <p class="label">Nível {{ index + 1 }}</p>

        </div>

      </div>

    </div>

  </div>
</template>

<script setup>
import { ref, onMounted } from "vue"
import { useRoute, useRouter } from "vue-router"
import api from "../services/api"

const route = useRoute()
const router = useRouter()

const subtemas = ref([])

const colors = [
  "#58cc02",
  "#1cb0f6",
  "#ff9600",
  "#ce82ff",
  "#ff4b4b"
]

/* 📦 carregar dados */
onMounted(async () => {
  try {
    const temaId = route.params.temaId

    // 🔥 ALTERADO: Rota corrigida para o novo padrão REST do Laravel 11
    const res = await api.get(`/temas/${temaId}/subtemas`)

    // Variável de controlo para ajudar a desbloquear os níveis em cadeia
    let ultimoNivelConcluido = true

    subtemas.value = await Promise.all(
      res.data.map(async (s, sIndex) => {

        const niveisRes = await api.get(`/niveis/${s.id}`)

        const niveis = niveisRes.data.map((n, i) => {
          // Verifica se este nível específico foi salvo no navegador como concluído
          const estaConcluido = localStorage.getItem(`nivel_${n.id}_concluido`) === 'true'
          
          // Regra de Desbloqueio: O nível está livre se for o primeiríssimo ou se o anterior terminou
          const locked = !ultimoNivelConcluido

          // Atualiza o estado para o próximo nível da lista ler
          ultimoNivelConcluido = estaConcluido

          return {
            ...n,
            locked: locked // Define dinamicamente se exibe o cadeado
          }
        })

        return {
          ...s,
          color: colors[sIndex % colors.length],
          niveis
        }
      })
    )

  } catch (error) {
    console.error("Erro ao carregar subtemas:", error)
  }
})

/* 🎨 estilo nível */
function getNivelStyle(nivel) {
  if (nivel.locked) {
    return {
      background: "#ccc",
      cursor: "not-allowed"
    }
  }

  return {
    background: "#58cc02",
    boxShadow: "0 6px 0 rgba(0,0,0,0.2)",
    cursor: "pointer"
  }
}

/* 🎮 abrir nível */
function openNivel(subtema, nivel) {
  if (nivel.locked) return

  router.push({
    path: `/atividades/${nivel.id}`,
    query: {
      subtemaId: subtema.id
    }
  })
}
</script>

<style scoped>
.page {
  min-height: 100vh;
  padding-bottom: 40px;
}

.subtema-block {
  margin-bottom: 50px;
}

.header {
  padding: 20px;
  text-align: center;
  color: white;
  font-weight: bold;
  border-radius: 0 0 20px 20px;
}

.map {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 30px 0;
  gap: 40px;
}

.level {
  position: relative;
  text-align: center;
}

.circle {
  width: 70px;
  height: 70px;
  border-radius: 50%;

  display: flex;
  align-items: center;
  justify-content: center;

  font-size: 24px;
  color: white;

  transition: 0.2s;
}

.level:hover .circle {
  transform: scale(1.1);
}

.label {
  margin-top: 8px;
  font-size: 13px;
}

.line {
  position: absolute;
  top: -40px;
  left: 50%;
  width: 5px;
  height: 40px;
  background: #ccc;
  transform: translateX(-50%);
  border-radius: 3px;
}
</style>