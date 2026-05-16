<template>
  <div class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-indigo-900 text-white p-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-10">
      <h1 class="text-3xl font-bold">🎮 Mundo do Conhecimento</h1>

      <div class="bg-white/10 px-4 py-2 rounded-xl">
        ⭐ {{ xp }} XP
      </div>
    </div>

    <!-- MAPA -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

      <div
        v-for="area in areas"
        :key="area.id"
        class="relative p-6 rounded-2xl overflow-hidden cursor-pointer transform transition hover:scale-105"
        :class="area.desbloqueado ? 'bg-green-600/30' : 'bg-gray-700/30'"
      >

        <!-- BLOQUEIO -->
        <div v-if="!area.desbloqueado"
             class="absolute inset-0 bg-black/70 flex items-center justify-center text-3xl">
          🔒
        </div>

        <!-- CONTEÚDO -->
        <h2 class="text-2xl font-bold mb-2">
          {{ area.nome }}
        </h2>

        <p class="text-sm text-white/70 mb-3">
          Nível {{ area.nivel }}
        </p>

        <!-- BARRA XP -->
        <div class="w-full bg-white/20 h-3 rounded-full mb-3">
          <div
            class="bg-yellow-400 h-3 rounded-full"
            :style="{ width: area.xp + '%' }"
          ></div>
        </div>

        <button
          v-if="area.desbloqueado"
          class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600"
          @click="entrarArea(area)"
        >
          Entrar
        </button>

      </div>

    </div>

  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "GameMap",

  data() {
    return {
      xp: 120,
      areas: []
    };
  },

  mounted() {
    this.carregarMapa();
  },

  methods: {
    async carregarMapa() {
      try {
        const res = await axios.get("http://localhost:8000/api/areas");

        // transformar dados para formato RPG
        this.areas = res.data.map((area, index) => ({
          ...area,
          nivel: index + 1,
          xp: Math.floor(Math.random() * 100),
          desbloqueado: index === 0 ? true : Math.random() > 0.5
        }));

      } catch (e) {
        console.error(e);
      }
    },

    entrarArea(area) {
      alert("Entrando em " + area.nome);
      // depois vamos redirecionar para temas
    }
  }
};
</script>