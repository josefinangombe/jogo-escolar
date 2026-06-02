<template>
  <div>
    <input v-model="resposta" placeholder="Resposta..." />
    <button @click="check">Enviar</button>

    <p>{{ feedback }}</p>
  </div>
</template>

<script setup>
import { ref } from "vue"
import { useGameStore } from "../../stores/gameStore"

const props = defineProps({ atividade: Object })
const store = useGameStore()

const resposta = ref("")
const feedback = ref("")

function check() {
  if (resposta.value === props.atividade.dados?.correta) {
    feedback.value = "✅ Correto!"
    store.addPoint()
  } else {
    feedback.value = "❌ Errado"
  }
}
</script>