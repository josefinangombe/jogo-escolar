<template>
  <div class="page">
    <h2>📊 Níveis</h2>

    <ul class="lista">
      <li v-for="(nivel, index) in niveis" :key="nivel.id" class="item">

        <router-link
          v-if="nivel.liberado"
          :to="`/atividades/${nivel.id}?subtemaId=${subtemaId}`"
          class="link"
        >
          {{ nivel.nome }}
        </router-link>

        <div v-else class="link bloqueado">
          {{ nivel.nome }} 🔒
        </div>

      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue"
import { useRoute } from "vue-router"
import api from "../services/api"

const route = useRoute()

// Mapeia o ID do subtema vindo do parâmetro da rota do Vue Router
const subtemaId = computed(() => route.params.subtemaId)

const niveis = ref([])

onMounted(async () => {
  try {
    // Chama o teu endpoint do Laravel: GET /api/niveis/{subtema}
    const res = await api.get(`/niveis/${subtemaId.value}`)
    
    niveis.value = res.data.map((nivel, index) => {
      // O primeiro nível da lista está sempre aberto
      if (index === 0) {
        return { ...nivel, liberado: true }
      }
      
      // Verifica se o nível anterior foi concluído no localStorage
      const nivelAnterior = res.data[index - 1]
      const anteriorEstaConcluido = localStorage.getItem(`nivel_${nivelAnterior.id}_concluido`) === 'true'
      
      return {
        ...nivel,
        // Libera se o anterior foi feito, ou se o Laravel já enviar um status de liberação
        liberado: anteriorEstaConcluido || nivel.liberado || false
      }
    })

    console.log("Níveis processados:", niveis.value)
  } catch (err) {
    console.error("Erro ao carregar níveis no front:", err)
    niveis.value = []
  }
})
</script>

<style scoped>
.page { padding: 20px; max-width: 500px; margin: 0 auto; }
.lista { list-style: none; padding: 0; }
.item { margin-bottom: 10px; }
.link { display: block; padding: 12px; background: #222; border-radius: 10px; color: white; text-decoration: none; transition: 0.2s; }
.link:hover:not(.bloqueado) { background: #444; }
.link.bloqueado { background: #1a1a1a; color: #555; cursor: not-allowed; border: 1px dashed #333; }
</style>