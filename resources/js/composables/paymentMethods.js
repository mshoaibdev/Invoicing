import axios from '@axios'
import { debounce } from 'lodash'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import route from 'ziggy-js'

export default function usePaymentMethods() {
  // Use toast
  const isLoading = ref(false)

  const respResult = ref(null)
  const refListTable = ref(null)

  // Table Handlers
  const headers = [
   
    {
      title: 'Name',
      key: 'name',
      sortable: false,
      visible: true,
    },
    {
      title: 'Mode',
      key: 'mode',
      sortable: false,
      visible: true,
    },
    {
      title: 'Is Enabled',
      key: 'is_enabled',
      sortable: false,
      visible: true,
    },
    {
      title: 'Is Default',
      key: 'is_default',
      sortable: false,
      visible: true,
    },
    {
      title: 'Actions',
      key: 'actions',
      sortable: false,
      visible: true,
    },

  ]

  const filters = reactive({
    status: '',
  })

  const paymentMethods = ref([])
  const itemsPerPage = ref(10)
  const totalRecords = ref(0)
  const currentPage = ref(1)
  const totalPages = ref(1)
  const perPageOptions = [10, 25, 50, 100]
  const searchQuery = ref('')
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const paymentMethodId = ref(null)
  const paymentMethodData = ref({})
  const errors = ref({})


  const deletePaymentMethod = async id => {
    try {
      isLoading.value = true

      const res = await axios.delete(route('payment-methods.destroy', id))

      respResult.value = res
      toast.success(res.data.message)

      // refetchData()
    } catch (error) {
      console.log(error)
      toast.error('Error! Deleting paymentMethod')
    } finally {
      isLoading.value = false
    }
  }

  const deleteMultiplePaymentMethod = async ids => {
    try {
      isLoading.value = true

      const res = await axios.post(route('payment-methods.delete'), { ids: ids })

      respResult.value = res
      toast.success(res.data.message)

      // refetchData()
    } catch (error) {
      console.log(error)
      toast.error('Error! Deleting paymentMethod')
    } finally {
      isLoading.value = false
    }
  }

  const getPaymentMethod = async id => {
    const response = await axios.get(route('payment-methods.show', id))

    paymentMethodData.value = response.data.data
  }


  const updatePaymentMethod = async (id, formData) => {
    try {
      isLoading.value = true

      const response = await axios.post(route('payment-methods.update', id), formData)

      respResult.value = response
      toast.success(response.data.message)
    } catch (error) {
      if (error.response.status === 422) {
        errors.value = error.response.data.errors
      }
      toast.error(error.response.data.message)
    } finally {
      isLoading.value = false
    }
  }


  const updatePaymentMethodStatus = async (id, formData) => {
    try {
      isLoading.value = true  

      const response = await axios.post(route('payment-methods.status', id), formData)

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


  const storePaymentMethod = async formData => {
    isLoading.value = true
    await axios
      .post(route('payment-methods.store'), formData)
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


  const fetchPaymentMethods = async () => {
    isLoading.value = true
    try {
      const response = await axios.get(route('payment-methods.index'), {
        params: {
          q: searchQuery.value,
          perPage: itemsPerPage.value,
          page: currentPage.value,
          sortBy: sortBy.value,
          sortDesc: isSortDirDesc.value,
          ...filters,
        },
      })

      const { total, last_page } = response.data.meta

      totalPages.value = last_page
      paymentMethods.value = response.data.data
      totalRecords.value = total
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }


  const fetchPaymentMethodsList = async role => {
    isLoading.value = true
    try {
      const response = await axios.get(route('fetch-payment-methods'), {
        params: {
          ...filters,
        },
      })

      paymentMethods.value = response.data.data
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const debouncedSearch = debounce(() => {
    fetchPaymentMethods()
  }, 500)

  watch(searchQuery, () => {
    debouncedSearch()
  })
  


  watch([currentPage, itemsPerPage, filters], () => {
    fetchPaymentMethods()
  })

  return {
    paymentMethodData,
    isLoading,
    getPaymentMethod,
    sortBy,
    itemsPerPage,
    totalPages,
    filters,
    respResult,
    paymentMethods,
    fetchPaymentMethods,
    deletePaymentMethod,
    updatePaymentMethod,
    currentPage,
    searchQuery,
    totalRecords,
    headers,
    isSortDirDesc,
    perPageOptions,
    storePaymentMethod,
    fetchPaymentMethodsList,
    updatePaymentMethodStatus,
  }
}
