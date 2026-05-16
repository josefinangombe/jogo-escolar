<template>
  <div>
    <h2>🧩 Subtemas</h2>

    <ul>
      <li v-for="subtema in subtemas" :key="subtema.id">
        <router-link :to="`/niveis/${subtema.id}`">
          {{ subtema.nome }}
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
const subtemas = ref([])

onMounted(async () => {
  const res = await api.get(`/subtemas/${route.params.temaId}`)
  subtemas.value = res.data
})
</script>