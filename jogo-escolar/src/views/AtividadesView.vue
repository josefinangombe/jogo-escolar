<template>
  <div>
    <h2>🎮 Atividades</h2>

    <div v-for="atividade in atividades" :key="atividade.id">
      <p><strong>{{ atividade.enunciado }}</strong></p>

      <div v-if="atividade.tipo_interacao === 'multipla_escolha'">
        <button
          v-for="op in atividade.dados.opcoes"
          :key="op"
        >
          {{ op }}
        </button>
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

onMounted(async () => {
  const res = await api.get(`/atividades/${route.params.nivelId}`)
  atividades.value = res.data
})
</script>