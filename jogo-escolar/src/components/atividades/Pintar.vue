<template>
  <div class="app">

    <!-- 🎨 TOOLBAR -->
    <div class="toolbar">

      <button @click="tool = 'brush'" :class="{ active: tool === 'brush' }">
        🖌 Pincel
      </button>

      <button @click="clearCanvas">
        🗑 Limpar
      </button>

      <button @click="finishPainting" class="finish">
        ✔ Terminar
      </button>

      <input type="color" v-model="color" />
      <input type="range" min="2" max="30" v-model="size" />

    </div>

    <!-- 🎮 CANVAS -->
    <canvas
      ref="canvas"
      class="canvas"
      @mousedown="startDraw"
      @mouseup="stopDraw"
      @mouseleave="stopDraw"
      @mousemove="draw"
    ></canvas>

  </div>
</template>

<script setup>
import { ref, onMounted } from "vue"

// 🔥 IMPORTANTÍSSIMO (comunicação com o pai)
const emit = defineEmits(["correct", "wrong"])

const canvas = ref(null)
let ctx = null

const tool = ref("brush")
const color = ref("#ff0000")
const size = ref(8)

let isDrawing = false
let baseImg = new Image()

const imageUrl = "http://localhost:8000/images/corpo/bracos.png"

// 🎯 iniciar desenho
function startDraw(e) {
  isDrawing = true
  draw(e)
}

// 🎯 parar desenho
function stopDraw() {
  isDrawing = false
  ctx.beginPath()
}

// 🎯 desenho
function draw(e) {
  if (!isDrawing) return

  const rect = canvas.value.getBoundingClientRect()
  const x = e.clientX - rect.left
  const y = e.clientY - rect.top

  ctx.lineWidth = size.value
  ctx.lineCap = "round"
  ctx.strokeStyle = color.value

  ctx.lineTo(x, y)
  ctx.stroke()
  ctx.beginPath()
  ctx.moveTo(x, y)
}

// 🧹 limpar
function clearCanvas() {
  ctx.clearRect(0, 0, canvas.value.width, canvas.value.height)
  drawImage()
}

// ✔ FINALIZAR ATIVIDADE (AQUI ESTÁ A CORREÇÃO)
function finishPainting() {
  emit("correct")
}

// 🖼 imagem
function drawImage() {
  const cw = canvas.value.width
  const ch = canvas.value.height

  const ratio = Math.min(cw / baseImg.width, ch / baseImg.height)

  const w = baseImg.width * ratio
  const h = baseImg.height * ratio

  const x = (cw - w) / 2
  const y = (ch - h) / 2

  ctx.globalCompositeOperation = "source-over"
  ctx.drawImage(baseImg, x, y, w, h)
}

onMounted(() => {
  const c = canvas.value

  c.width = 800
  c.height = 500

  ctx = c.getContext("2d")

  ctx.lineJoin = "round"
  ctx.lineCap = "round"

  baseImg = new Image()

  baseImg.onload = () => {
    drawImage()
  }

  baseImg.src = imageUrl
})
</script>

<style scoped>
.app {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
}

.toolbar {
  display: flex;
  gap: 10px;
  padding: 10px;
  background: #fff;
  border-radius: 10px;
}

button {
  padding: 8px;
  border: none;
  cursor: pointer;
  background: #eee;
  border-radius: 6px;
}

button.active {
  background: #ddd;
  border: 2px solid #000;
}

.finish {
  background: #00c853;
  color: white;
}

.canvas {
  border: none;
  border-radius: 10px;
  cursor: crosshair;
}
</style>