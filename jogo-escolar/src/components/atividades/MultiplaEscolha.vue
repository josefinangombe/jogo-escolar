<template>
  <div class="opcoes">

    <button
      v-for="op in atividade.dados?.opcoes || []"
      :key="op.nome"
      @click="check(op)"
      class="btn"
      :disabled="respondido"
      :class="{
        correct: isCorrect(op),
        wrong: isWrong(op),
        selected: selecionada === op.nome
      }"
    >
      <img
        :src="getImageUrl(op.imagem)"
        class="img-opcao"
        @error="handleError"
      />

      <span>{{ op.nome }}</span>
    </button>

    <p v-if="feedback" class="feedback">
      {{ feedback }}
    </p>

  </div>
</template>

<script setup>
import { ref } from "vue"
import { useGameStore } from "../../stores/gameStore"

const props = defineProps({ atividade: Object })
const emit = defineEmits(["correct", "wrong"])

const store = useGameStore()

const feedback = ref("")
const respondido = ref(false)
const respostaCorreta = ref("")
const selecionada = ref("")

const baseUrl = "http://localhost:8000"

// ✅ imagem dinâmica
function getImageUrl(path) {
  return `${baseUrl}/images/${path}`
}

// fallback imagem
function handleError(e) {
  e.target.src = "/default.png"
}

// ✅ OPÇÃO 2 — tentar novamente
function check(op) {
  if (respondido.value) return

  selecionada.value = op.nome

  if (op.nome === props.atividade.resposta_correta) {
    feedback.value = "✅ Correto!"
    respostaCorreta.value = op.nome

    store.addPoint()
    emit("correct")

    respondido.value = true
  } else {
    feedback.value = "❌ Errado, tenta novamente"

    // 🔥 limpa após 1 segundo
    setTimeout(() => {
      selecionada.value = ""
      feedback.value = ""
    }, 1000)

    emit("wrong")
  }
}

function isCorrect(op) {
  return respondido.value && respostaCorreta.value === op.nome
}

function isWrong(op) {
  return (
    !respondido.value &&
    selecionada.value === op.nome &&
    op.nome !== props.atividade.resposta_correta
  )
}
</script>

<style scoped>

/* GRID */
.opcoes {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 15px;
}

/* BOTÃO */
.btn {
  padding: 0;
  width: 100%;
  background: #3b82f6;
  border-radius: 12px;
  overflow: hidden;

  display: flex;
  flex-direction: column;
  align-items: center;

  cursor: pointer;

  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
  transition: all 0.2s ease;
}

/* hover */
.btn:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 18px rgba(0,0,0,0.25);
}

/* desativado */
.btn:disabled {
  opacity: 0.7;
  cursor: not-allowed;
  transform: none;
}

/* imagem */
.img-opcao {
  width: 100%;
  height: 130px;
  object-fit: cover;
}

/* texto */
.btn span {
  padding: 10px;
  font-weight: bold;
  text-align: center;
  color: white;
}

/* selecionado */
.selected {
  outline: 3px solid #ffffff;
}

/* ✅ CORRETO */
@keyframes correctBounce {
  0%   { transform: scale(1); }
  30%  { transform: scale(1.2); }
  50%  { transform: scale(0.95); }
  70%  { transform: scale(1.05); }
  100% { transform: scale(1); }
}

.btn.correct {
  animation: correctBounce 0.6s ease;
  border: 3px solid #22c55e;
  box-shadow: 0 0 20px rgba(34, 197, 94, 0.6);
  pointer-events: none; /* 🔥 bloqueia após acerto */
}

/* ❌ ERRADO */
@keyframes shake {
  0% { transform: translateX(0); }
  25% { transform: translateX(-5px); }
  50% { transform: translateX(5px); }
  75% { transform: translateX(-5px); }
  100% { transform: translateX(0); }
}

.btn.wrong {
  animation: shake 0.4s;
  border: 3px solid #ef4444;
}

/* feedback */
.feedback {
  grid-column: span 2;
  text-align: center;
  margin-top: 10px;
  font-weight: bold;
}

</style>