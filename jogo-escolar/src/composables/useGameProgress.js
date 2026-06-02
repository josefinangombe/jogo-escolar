import { useGameStore } from "../stores/gameStore"

export function useGameProgress() {
  const store = useGameStore()

  return {
    pontos: store.pontos,
    nivel: store.nivel,
    addPoint: store.addPoint
  }
}