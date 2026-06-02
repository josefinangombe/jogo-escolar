<template>
  <div class="drag-area">
    <div
      v-for="item in atividade.dados?.itens || []"
      :key="item"
      draggable="true"
      @dragstart="drag(item)"
      class="box"
    >
      {{ item }}
    </div>
  </div>
</template>

<script setup>
function drag(item) {
  console.log("Arrastar:", item)
}
</script>

<style scoped>
.box {
  padding: 10px;
  background: #334155;
  margin: 5px;
  color: white;
  cursor: grab;
}
</style>