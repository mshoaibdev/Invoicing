import axios from '@axios'
import { ref } from 'vue'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import route from 'ziggy-js'

export default function useAccount() {
  const accountData = ref({})
  const isBusy = ref(false)
  const errors = ref({})
  const respResult = ref({})

  const fetchAccount = async () => {
    const response = await axios.get(route('account'))

    accountData.value = response.data.data
  }

  const fetchDashboardStats = async () => {
    return await axios.get(route('dashboard.stats'))
  }

  const updatePassword = async formData => {
    try {
      isBusy.value = true

      const response = await axios.put(route('account.password'), formData)

      respResult.value = response
      toast.success(response.data.message)
    } catch (err) {
      if (err.response.status === 422) {
        errors.value = err.response.data.errors
      }
      toast.error(err.response.data.message)
    } finally {
      isBusy.value = false
    }
  }

  const updateAccount = async formData => {
    try {
      isBusy.value = true

      const response = await axios.post(route('account.personal'), formData)

      respResult.value = response

      const { name, avatar_url } = response.data.data

      localStorage.removeItem('userData')
      localStorage.setItem('userData', JSON.stringify({ name, avatar_url }))

      toast.success(response.data.message)
    } catch (err) {
      console.log(err)
      if (err.response.status === 422) {
        errors.value = err.response.data.errors
      }
      toast.error(err.response.data.message)
    } finally {
      isBusy.value = false
    }
  }

  
  return {
    isBusy,
    errors,
    respResult,
    accountData,
    fetchAccount,
    updateAccount,
    updatePassword,
    fetchDashboardStats,
  }
}
