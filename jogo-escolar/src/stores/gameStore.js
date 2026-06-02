import { defineStore } from "pinia"

export const useGameStore = defineStore("game", {
  state: () => ({
    pontos: 0,
    nivel: 1,
    estrelas: {}
  }),

  actions: {
    addPoint() {
      this.pontos++

      if (this.pontos % 5 === 0) {
        this.nivel++
      }
    },

    setEstrela(atividadeId, valor) {
      this.estrelas[atividadeId] = valor
    }
  }
})