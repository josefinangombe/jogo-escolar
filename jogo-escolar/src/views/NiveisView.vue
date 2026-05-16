<template>
  <div>
    <h2>📊 Níveis</h2>

    <ul>
      <li v-for="nivel in niveis" :key="nivel.id">
        <router-link :to="`/atividades/${nivel.id}`">
          {{ nivel.nome }}
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue"
import { useRoute } from "vue-router"
import api from "../services/api"

const route = useRoute()
const niveis = ref([])

onMounted(async () => {
  const res = await api.get(`/niveis/${route.params.subtemaId}`)
  niveis.value = res.data
})
</script>