<template>
  <div>
    <canvas ref="canvas" class="canvas"></canvas>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue"

const canvas = ref(null)

onMounted(() => {
  const ctx = canvas.value.getContext("2d")

  canvas.value.addEventListener("mousemove", (e) => {
    if (e.buttons !== 1) return

    ctx.fillStyle = "black"
    ctx.fillRect(e.offsetX, e.offsetY, 2, 2)
  })
})
</script>

<style scoped>
.canvas {
  width: 100%;
  height: 200px;
  background: white;
}
</style>