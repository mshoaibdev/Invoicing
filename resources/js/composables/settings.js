import axios from '@axios'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import route from 'ziggy-js'

export default function useSettings() {
  const isLoading = ref(false)
  const respResult = ref(null)
  const settings = ref({})
  const errors = ref({})
  const settingData = ref({})


  const fetchSettings = async keys => {
    try {
      isLoading.value = true

      const response = await axios.get(route('settings.index'), {
        params: {
          keys: keys,
        },
      })
      settings.value = response.data
    } catch (error) {
      if (error.message === 'Network Error') {
        toast.error(error.message)
      } else {
        respResult.value = error
        toast.error(error.response.data.message)
      }
    } finally {
      isLoading.value = false
    }
  }

  // fetchSettings by key
  const fetchSettingsByKey = async key => {
    try {
      isLoading.value = true

      const response = await axios.get(route('settings.get', key))

      settingData.value = response.data.data
    } catch (error) {
      if (error.message === 'Network Error') {
        toast.error(error.message)
      } else {
        respResult.value = error
        toast.error(error.response.data.message)

      }
    } finally {
      isLoading.value = false
    }
  }


  const storeSettings = async data => {
    errors.value = ''
    try {
      isLoading.value = true

      const response = await axios.post(route('settings.store'), data)

      respResult.value = response
      toast.success(response.data.message)
    } catch (error) {
      if (error.message === 'Network Error') {
        toast.error(error.message)
      } else {
        if (error.response.status === 422) {
          errors.value = error.response.data.errors
        }
        respResult.value = error
        toast.error(error.response.data.message)
      }
    } finally {
      isLoading.value = false
    }
  }

  const updateSettings = async data => {
    errors.value = ''
    try {
      isLoading.value = true

      const response = await axios.put(route('settings.update', 1), data)

      respResult.value = response
      toast.success(response.data.message)
    } catch (error) {
      if (error.message === 'Network Error') {
        toast.error(error.message)
      } else {
        if (error.response.status === 422) {
          errors.value = error.response.data.errors
        }
        respResult.value = error
        toast.error(error.response.data.message)
      }
    } finally {
      isLoading.value = false
    }
  }


  return {
    isLoading,
    errors,
    settings,
    respResult,
    settingData,
    updateSettings,
    fetchSettingsByKey,
    fetchSettings,
    storeSettings,
  }
}
