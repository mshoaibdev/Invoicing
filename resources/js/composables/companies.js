import axios from '@axios'
import { computed, reactive, ref, watch } from 'vue'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import route from 'ziggy-js'

export default function useCompanies() {
  // Use toast
  const isLoading = ref(false)

  const respResult = ref(null)
  const refListTable = ref(null)

  const filters = reactive({
    
  })

  const companies = ref([])
  const perPage = ref(10)
  const totalRecords = ref(0)
  const currentPage = ref(1)
  const totalPages = ref(1)
  const perPageOptions = [10, 25, 50, 100]
  const searchQuery = ref('')
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const companyId = ref(null)
  const user = ref({})
  const errors = ref({})


  const deleteCompany = async id => {
    try {
      isLoading.value = true

      const res = await axios.delete(route('companies.destroy', id))

      respResult.value = res
      toast.success(res.data.message)

      // refetchData()
    } catch (error) {
      console.log(error)
      toast.error('Error! Deleting user')
    } finally {
      isLoading.value = false
    }
  }

  const getCompany = async id => {
    const response = await axios.get(route('companies.show', id))

    user.value = response.data.data
  }

  // current company

  const currentCompany = async id => {
    return await axios.get(route('current-company'))
  }


  const updateCompany = async (id, formData) => {
    try {
      isLoading.value = true

      const response = await axios.post(route('companies.update', id), formData)

      respResult.value = response
      toast.success(response.data.message)
    } catch (error) {
      console.log(error)
      if (error.response.status === 422) {
        errors.value = error.response.data.errors
      }
      toast.error(error.response.data.message)
    } finally {
      isLoading.value = false
    }
  }


  const updateCompanyStatus = async formData => {
    try {
      isLoading.value = true

      const response = await axios.post(route('companies.status', formData.id), formData)

      respResult.value = response
      toast.success(response.data.message)
    } catch (e) {
      console.log(e)
      if (e.response.status === 422) {
        toast.error(e.response.data.message)
      }
    } finally {
      isLoading.value = false
    }
  }


  const storeCompany = async formData => {
    isLoading.value = true
    await axios
      .post(route('companies.store'), formData)
      .then(resp => {
        respResult.value = resp
        toast.success(resp.data.message)
      })
      .catch(err => {
        respResult.value = err
        if (err.response.status === 422) {
          toast.error(err.response.data.message)
        }
      }).finally(() => {
        isLoading.value = false
      })
  }

  const fetchCompanies = async () => {
    isLoading.value = true
    try {
      const response = await axios.get(route('companies.index'), {
        params: {
          q: searchQuery.value,
          perPage: perPage.value,
          page: currentPage.value,
          sortBy: sortBy.value,
          sortDesc: isSortDirDesc.value,
          ...filters,
        },
      })

      const { total, last_page } = response.data.meta

      totalPages.value = last_page
      companies.value = response.data.data
      totalRecords.value = total
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const fetchCompaniesList = async role => {
    isLoading.value = true
    try {
      const response = await axios.get(route('fetch-companies'), {
        params: {
          ...filters,
        },
      })

      companies.value = response?.data?.data
    } catch (e) {
      console.log(e)
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }



  watch([currentPage, perPage, searchQuery, filters], () => {
    fetchCompanies()
  })

  return {
    user,
    isLoading,
    errors,
    getCompany,
    companyId,
    sortBy,
    perPage,
    totalPages,
    filters,
    currentCompany,
    respResult,
    companies,
    fetchCompanies,
    deleteCompany,
    updateCompany,
    currentPage,
    searchQuery,
    refListTable,
    totalRecords,
    isSortDirDesc,
    perPageOptions,
    storeCompany,
    fetchCompaniesList,
    updateCompanyStatus,
  }
}
