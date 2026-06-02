import { ref } from "vue"
import api from "../services/api"

export function useAtividades(nivelId) {
  const atividades = ref([])
  const loading = ref(false)

  const fetchAtividades = async () => {
    loading.value = true

    try {
      const { data } = await api.get(`/atividades/${nivelId}`)
      atividades.value = Array.isArray(data) ? data : []
    } catch (e) {
      console.error(e)
      atividades.value = []
    } finally {
      loading.value = false
    }
  }

  return { atividades, loading, fetchAtividades }
}