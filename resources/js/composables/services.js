import axios from '@axios'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import route from 'ziggy-js'

export default function useServices() {
  const isLoading = ref(false)
  const respResult = ref(null)
  const services = ref({})
  const errors = ref({})
  const settingData = ref({})


  const fetchCalendarServices = async () => {
    try {
      isLoading.value = true

      const response = await axios.get(route('calendar.events'))

      services.value = response.data.data

      return response
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

  // fetchServices by key
  const fetchServicesByKey = async key => {
    try {
      isLoading.value = true

      const response = await axios.get(route('services.get', key))

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


  const storeServices = async data => {
    errors.value = ''
    try {
      isLoading.value = true

      const response = await axios.post(route('services.store'), data)

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

  const updateService = async (id, data) => {
    errors.value = ''
    try {
      isLoading.value = true

      const response = await axios.put(route('services.update', id), data)

      respResult.value = response
      toast.success(response.data.message)

      return response
    } catch (error) {
      console.log(error)
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
    services,
    respResult,
    settingData,
    updateService,
    fetchServicesByKey,
    fetchCalendarServices,
    storeServices,
  }
}
