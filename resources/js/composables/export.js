import axios from '@axios'
import { ref } from 'vue'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import route from 'ziggy-js'

export default function useExport() {
  const respResult = ref(null)
  const isBusy = ref(false)

  const exportData = async (url, data) => {
    try {
      isBusy.value = true
      console.log(data)

      const response = await axios.post(route(url), data, {
        responseType: 'blob',
      })

      respResult.value = response.data
    } catch (error) {
      if (error.message === 'Network Error') {
        toast.error(error.message)
      } else {
        respResult.value = error
        toast.error(error.response.data.message)
      }
    } finally {
      isBusy.value = false
    }
  }

  
  return {
    exportData,
    respResult,
    isBusy,
  }
}
