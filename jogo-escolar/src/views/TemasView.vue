<template>
  <div class="container">
    <h2 class="title">📚 Escolhe um Tema</h2>

    <!-- loading -->
    <div v-if="loading">
      Carregando...
    </div>

    <div class="grid" v-else>

      <div
        v-for="tema in temas"
        :key="tema.id"
        class="card"
        @click="entrar(tema)"
        :style="{
          backgroundImage: tema.imagem
            ? `url(http://localhost:8000/images/temas/${tema.imagem})`
            : 'none'
        }"
      >
        <!-- overlay escuro -->
        <div class="overlay"></div>

        <!-- conteúdo -->
        <div class="content">
          <h3>📖 {{ tema.nome }}</h3>

          <button class="btn">
            Entrar ▶
          </button>
        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue"
import { useRoute, useRouter } from "vue-router"
import api from "../services/api"

const temas = ref([])
const loading = ref(true)

const route = useRoute()
const router = useRouter()

onMounted(async () => {
  try {
    const areaId = route.params.areaId

    console.log("AREA ID:", areaId)

    if (!areaId) {
      console.error("areaId não encontrado na rota")
      temas.value = []
      return
    }

    const res = await api.get(`/temas/${areaId}`)

    temas.value = Array.isArray(res.data) ? res.data : []
  } catch (error) {
    console.log("Erro ao carregar temas:", error)
    temas.value = []
  } finally {
    loading.value = false
  }
})

function entrar(tema) {
  router.push(`/subtemas/${tema.id}`)
}
</script>

<style scoped>
.container {
  text-align: center;
  padding: 20px;
}

.title {
  color: white;
  margin-bottom: 20px;
}

.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
}

/* CARD RPG */
.card {
  height: 180px;
  border-radius: 16px;
  position: relative;
  cursor: pointer;
  overflow: hidden;

  background-size: cover;
  background-position: center;

  box-shadow: 0 8px 20px rgba(0,0,0,0.3);
  transition: 0.3s;

  display: flex;
  align-items: flex-end;
}

.card:hover {
  transform: scale(1.05);
}

/* overlay escuro */
.overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to top,
    rgba(0,0,0,0.8),
    rgba(0,0,0,0.1)
  );
}

/* conteúdo */
.content {
  position: relative;
  z-index: 2;
  padding: 10px;
  width: 100%;
  color: white;
  text-align: left;
}

/* botão RPG */
.btn {
  margin-top: 8px;
  padding: 6px 12px;
  border: none;
  border-radius: 8px;
  background: gold;
  color: black;
  font-weight: bold;
  cursor: pointer;
}

.btn:hover {
  background: orange;
}
</style>