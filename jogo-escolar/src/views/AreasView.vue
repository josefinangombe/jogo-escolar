<template>
  <div class="container">
    <h2 class="title">🌍 Escolhe uma Área</h2>

    <div v-if="areas.length === 0">
      Carregando...
    </div>

    <div class="grid">
      <div
        v-for="area in areas"
        :key="area.id"
        class="card"
        @click="entrar(area)"
        :style="{
          backgroundImage: `url(http://localhost:8000/images/areas/${area.imagem})`
        }"
      >
        <div class="content">
          <h3>{{ area.nome }}</h3>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue"
import { useRouter } from "vue-router"
import api from "../services/api"

const areas = ref([])
const router = useRouter()

onMounted(async () => {
  try {
    const res = await api.get("/areas")
    areas.value = res.data
  } catch (error) {
    console.error("Erro ao carregar áreas:", error)
    areas.value = []
  }
})

function entrar(area) {
  if (!area?.id) {
    console.error("❌ Area sem ID:", area)
    return
  }

  router.push(`/temas/${area.id}`)
}
</script>

<style scoped>
.container {
  text-align: center;
  padding: 20px;
}

.title {
  margin-bottom: 20px;
  color: #fff;
}

.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
}

/* CARD */
.card {
  height: 180px;
  background-size: cover;
  background-position: center;
  border-radius: 16px;
  cursor: pointer;
  transition: 0.3s;
  position: relative;
  overflow: hidden;

  display: flex;
  align-items: flex-end;

  color: white;
  box-shadow: 0 10px 25px rgba(0,0,0,0.4);
}

.card:hover {
  transform: scale(1.05);
}

/* overlay */
.card::before {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to top,
    rgba(0,0,0,0.85),
    rgba(0,0,0,0.2)
  );
  z-index: 0;
}

/* conteúdo */
.content {
  position: relative;
  z-index: 2;
  width: 100%;
  padding: 10px;
  text-align: left;
}
</style>