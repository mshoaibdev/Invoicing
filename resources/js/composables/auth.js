import axios from '@axios'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import route from 'ziggy-js'


export default function useAuth() {

  const isBusy = ref(false)
  const respData = ref(null)

  const errors = ref({
    email: undefined,
    password: undefined,
  })


  const login = async loginData => {
    try {
      isBusy.value = true

      const resp = await axios.post(route('login'), loginData)

      respData.value = resp

    } catch (e) {
      
      if (e.message === 'Network Error') {
        toast.error(e.message)
      } else {
        if (e && e.response && e.response.data && e.response.data.errors) {
          const { errors: formErrors } = e.response.data

          errors.value = formErrors

        }
        toast.error(e.response.data.message)
      }
    } finally {
      isBusy.value = false
    }
  }

  const logout = async () => {
    try {
      isBusy.value = true

      const response = await axios.post(route('logout'))

      respData.value = response
    } catch (e) {
      console.log(e)
      respData.value = e
      if (e.message === 'Network Error') {
        toast.error(e.message)
      } else {
        toast.error(e.response.data.message)
      }
    } finally {
      isBusy.value = false
    }
  }

  const forgotPassword = async data => {
    try {
      isBusy.value = true

      const response = await axios.post(route('password.email'), data)

      respData.value = response
      toast.success(response.data.message)
    } catch (error) {
      respData.value = error
      if (error.message === 'Network Error') {
        toast.error(error.message)
      } else {
        toast.error(error.response.data.message)
      }
    } finally {
      isBusy.value = false
    }
  }


  const resetPassword = async formData => {
    try {
      isBusy.value = true

      const response = await axios.post(route('password.update'), formData)
      
      respData.value = response
      toast.success(response.data.message)
    } catch (error) {
      console.log(error)
      respData.value = error
      if (error.message === 'Network Error') {
        toast.error(error.message)
      } else {
        toast.error(error.response.data.message)
      }
    } finally {
      isBusy.value = false
    }
  }

  
  return {
    isBusy,
    login,
    errors,
    logout,
    respData,
    forgotPassword,
    resetPassword,
  }
}
