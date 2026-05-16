<template>
  <div class="app">

    <!-- HEADER RPG -->
    <header class="header">
      <div class="left">
        <h1>🎮 Jogo Escolar</h1>
        <p class="sub">Mundo do Conhecimento</p>
      </div>

      <div class="right">
        <div class="xp-box">
          ⭐ {{ xp }} XP
        </div>
      </div>
    </header>

    <!-- BARRA DE XP GLOBAL -->
    <div class="xp-bar">
      <div class="xp-fill" :style="{ width: xp + '%' }"></div>
    </div>

    <!-- CONTEÚDO COM TRANSIÇÃO -->
    <main class="content">
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </main>

  </div>
</template>

<script>
export default {
  name: "App",

  data() {
    return {
      xp: 40 // depois vamos buscar do Laravel
    };
  }
};
</script>

<style scoped>
.app {
  font-family: Arial, sans-serif;
  min-height: 100vh;
  background: linear-gradient(135deg, #0f172a, #1e293b, #312e81);
  color: white;
  padding: 20px;
}

/* HEADER */
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: rgba(0,0,0,0.4);
  padding: 15px 20px;
  border-radius: 12px;
  transition: 0.3s;
}

.header:hover {
  transform: scale(1.01);
}

.left h1 {
  margin: 0;
}

.sub {
  font-size: 12px;
  opacity: 0.7;
}

/* XP BOX */
.xp-box {
  background: rgba(255,255,255,0.1);
  padding: 8px 15px;
  border-radius: 10px;
  font-weight: bold;
}

/* BARRA XP */
.xp-bar {
  height: 6px;
  background: rgba(255,255,255,0.1);
  margin-top: 10px;
  border-radius: 10px;
  overflow: hidden;
}

.xp-fill {
  height: 100%;
  background: gold;
  transition: width 0.5s;
}

/* CONTEÚDO */
.content {
  margin-top: 20px;
}

/* ANIMAÇÃO ENTRE TELAS */
.fade-enter-active, .fade-leave-active {
  transition: all 0.4s ease;
}

.fade-enter-from {
  opacity: 0;
  transform: translateX(20px);
}

.fade-leave-to {
  opacity: 0;
  transform: translateX(-20px);
}
</style>