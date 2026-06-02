<template>
  <div class="wrapper">

    <p>DEBUG: {{ props.atividade?.imagem }}</p>

    <!-- 🎨 FERRAMENTAS -->
    <div class="toolbar">

      <!-- 🖌 PINCEL -->
      <button type="button" class="tool active">
        🖌
      </button>

      <!-- 🎨 CORES -->
      <div class="colors">
        <button
          v-for="c in colors"
          :key="c"
          class="color"
          :style="{ background: c }"
          @click="setColor(c)"
        />
      </div>

      <!-- 🗑 LIMPAR -->
      <button type="button" class="tool clear" @click="clearAll">
        🗑
      </button>

    </div>

    <!-- 🎮 ÁREA DO JOGO -->
    <div class="game">

      <!-- 🖼 FUNDO -->
      <canvas ref="bgCanvas" class="canvas bg"></canvas>

      <!-- ✏️ DESENHO -->
      <canvas
        ref="drawCanvas"
        class="canvas draw"
        @mousedown="startDraw"
        @mouseup="stopDraw"
        @mousemove="draw"
        @mouseleave="stopDraw"
      ></canvas>

    </div>

    <!-- ✔ BOTÃO TERMINAR -->
    <button type="button" class="finish" @click="checkAnswer">
      Terminar
    </button>

  </div>
</template>

<script setup>
import { ref, watch, nextTick } from "vue"

const props = defineProps({
  atividade: Object
})

const emit = defineEmits(["correct", "wrong"])

const bgCanvas = ref(null)
const drawCanvas = ref(null)

let bgCtx = null
let drawCtx = null

let isDrawing = false

const colors = ["#ff0000", "#0000ff", "#00ff00", "#000000", "#ff9800"]

let currentColor = "#ff0000"
let brushSize = 6

const baseUrl = "http://localhost:8000"

function setColor(c) {
  currentColor = c
}

function clearAll() {
  if (!drawCanvas.value) return
  const ctx = drawCtx
  ctx.clearRect(0, 0, drawCanvas.value.width, drawCanvas.value.height)
}

function startDraw(e) {
  isDrawing = true
  draw(e)
}

function stopDraw() {
  isDrawing = false
}

function draw(e) {
  if (!isDrawing) return

  const rect = drawCanvas.value.getBoundingClientRect()

  const x = e.clientX - rect.left
  const y = e.clientY - rect.top

  drawCtx.fillStyle = currentColor
  drawCtx.beginPath()
  drawCtx.arc(x, y, brushSize, 0, Math.PI * 2)
  drawCtx.fill()
}

async function renderImage() {
  await nextTick()

  const imgName = props.atividade?.imagem
  if (!imgName) return

  const url = `${baseUrl}/images/corpo/${imgName}`

  const bg = bgCanvas.value
  const draw = drawCanvas.value

  bg.width = draw.width = 800
  bg.height = draw.height = 500

  bgCtx = bg.getContext("2d")
  drawCtx = draw.getContext("2d")

  const img = new Image()

  img.onload = () => {
    bgCtx.clearRect(0, 0, bg.width, bg.height)

    const scale = Math.min(
      bg.width / img.width,
      bg.height / img.height
    )

    const w = img.width * scale
    const h = img.height * scale

    const x = (bg.width - w) / 2
    const y = (bg.height - h) / 2

    bgCtx.drawImage(img, x, y, w, h)

    console.log("✔ imagem carregada")
  }

  img.onerror = () => {
    console.error("❌ erro ao carregar imagem:", url)
  }

  img.src = url
}

watch(
  () => props.atividade,
  () => renderImage(),
  { immediate: true }
)

function checkAnswer() {
  console.log("✔ Terminar clicado")
  emit("correct")
}
</script>

<style scoped>
.wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
}

.toolbar {
  display: flex;
  gap: 10px;
  align-items: center;
}

.tool {
  padding: 8px;
  font-size: 18px;
  border: none;
  cursor: pointer;
  border-radius: 8px;
  background: #eee;
}

.tool.active {
  background: #c8e6c9;
}

.colors {
  display: flex;
  gap: 5px;
}

.color {
  width: 22px;
  height: 22px;
  border-radius: 50%;
  border: 1px solid #333;
  cursor: pointer;
}

.game {
  position: relative;
  width: 800px;
  height: 500px;
}

.canvas {
  position: absolute;
  top: 0;
  left: 0;
}

.bg {
  z-index: 1;
}

.draw {
  z-index: 2;
  cursor: crosshair;
}

.finish {
  padding: 10px 20px;
  background: #00c853;
  border: none;
  color: white;
  border-radius: 8px;
  cursor: pointer;
}
</style>