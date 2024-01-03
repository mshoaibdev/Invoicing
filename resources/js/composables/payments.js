import axios from '@axios'
import { debounce } from 'lodash'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import route from 'ziggy-js'

export default function usePayments() {
  // Use toast
  const isLoading = ref(false)

  const respResult = ref(null)
  const refListTable = ref(null)

  // Table Handlers
  const headers = [
    {
      title: '#Transaction ID',
      key: 'transaction_id',
      sortable: false,
    },
    {
      title: 'Customer',
      key: 'paymentable.customer.name',
      sortable: false,
    },
    {
      title: 'Email',
      key: 'paymentable.customer.email',
      sortable: false,
    },
    {
      title: 'Amount',
      key: 'amount',
      sortable: false,
    },
   
    {
      title: 'Payment Date',
      key: 'formattedPaymentDate',
      sortable: false,
    },
    {
      title: 'Order Details',
      key: 'order_details',
      sortable: false,
    },
    {
      title: 'Actions',
      key: 'actions',
      sortable: false,
    },

  ]

  const filters = reactive({
    status: '',
  })

  const payments = ref([])
  const paymentsByStatus = ref([])
  const itemsPerPage = ref(10)
  const totalRecords = ref(0)
  const currentPage = ref(1)
  const totalPages = ref(1)
  const perPageOptions = [10, 25, 50, 100]
  const searchQuery = ref('')
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const paymentId = ref(null)
  const paymentData = ref({})


  const deletePayment = async id => {
    try {
      isLoading.value = true

      const res = await axios.delete(route('payments.destroy', id))

      respResult.value = res
      toast.success(res.data.message)

      // refetchData()
    } catch (error) {
      console.log(error)
      toast.error('Error! Deleting payment')
    } finally {
      isLoading.value = false
    }
  }

  const getPayment = async id => {
    const response = await axios.get(route('payments.show', id))


    paymentData.value = response.data.data
  }

  // sendPayment

  const sendPayment = async (paymentId, formData) => {

    return axios.post(route('payments.send', paymentId), formData)

  }



  const updatePayment = async (id, formData) => {
    try {
      isLoading.value = true

      const response = await axios.post(route('payments.update', id), formData)

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


  const updatePaymentstatus = async (id, formData) => {
    try {
      isLoading.value = true  

      const response = await axios.post(route('payments.status', id), formData)

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



  const storePayment = async formData => {
    isLoading.value = true
    await axios
      .post(route('payments.store'), formData)
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


  const fetchPayments = async () => {
    isLoading.value = true
    try {
      const response = await axios.get(route('payments.index'), {
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
      payments.value = response.data.data
      totalRecords.value = total
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const fetchPaymentsByStatus= async () => {
    isLoading.value = true
    try {
      const response = await axios.get(route('payments.count-by-status'))

      paymentsByStatus.value = response.data.data
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const fetchPaymentsList = async role => {
    isLoading.value = true
    try {
      const response = await axios.get(route('payments.index'), {
        params: {
          ...filters,
        },
      })

      payments.value = response.data.data
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const resolvePaymentstatusVariantAndIcon = status => {
    if (status === 'Paid')
      return {
        variant: 'primary',
        icon: 'tabler-circle-half-2',
      }
    if (status === 'Unpaid')
      return {
        variant: 'warning',
        icon: 'tabler-chart-pie',
      }
    if (status === 'Downloaded')
      return {
        variant: 'info',
        icon: 'tabler-arrow-down-circle',
      }
    if (status === 'Draft')
      return {
        variant: 'secondary',
        icon: 'tabler-device-floppy',
      }
    if (status === 'Sent')
      return {
        variant: 'success',
        icon: 'tabler-circle-check',
      }
    if (status === 'Overdue')
      return {
        variant: 'error',
        icon: 'tabler-alert-circle',
      }
    
    return {
      variant: 'secondary',
      icon: 'tabler-x',
    }
  }
  

  const debouncedSearch = debounce(() => {
    fetchPayments()
  }, 500)

  watch(searchQuery, () => {
    debouncedSearch()
  })
  


  watch([currentPage, itemsPerPage, filters], () => {
    fetchPayments()
  })

  return {
    paymentData,
    isLoading,
    getPayment,
    paymentId,
    sortBy,
    itemsPerPage,
    totalPages,
    filters,
    respResult,
    fetchPaymentsByStatus,
    payments,
    paymentsByStatus,
    fetchPayments,
    deletePayment,
    updatePayment,
    sendPayment,
    currentPage,
    searchQuery,
    refListTable,
    totalRecords,
    headers,
    isSortDirDesc,
    perPageOptions,
    storePayment,
    fetchPaymentsList,
    resolvePaymentstatusVariantAndIcon,
    updatePaymentstatus,
  }
}
