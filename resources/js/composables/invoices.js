import axios from '@axios'
import { debounce } from 'lodash'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import route from 'ziggy-js'

export default function useInvoices() {
  // Use toast
  const isLoading = ref(false)

  const respResult = ref(null)
  const refListTable = ref(null)

  // Table Handlers
  const headers = [
    {
      title: '#Invoice ID',
      key: 'invoice_id',
      sortable: false,
    },
    {
      title: 'Customer',
      key: 'customer.name',
      sortable: false,
    },
    {
      title: 'Email',
      key: 'customer.email',
      sortable: false,
    },
    {
      title: 'Total',
      key: 'total',
      sortable: false,
    },
    {
      title: 'Payment Method',
      key: 'payment_method.name',
      sortable: false,
    },
    {
      title: 'Status',
      key: 'status',
      sortable: false,
    },
   
    {
      title: 'Due Date',
      key: 'due_date',
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

  const invoices = ref([])
  const invoicesByStatus = ref([])
  const itemsPerPage = ref(10)
  const totalRecords = ref(0)
  const currentPage = ref(1)
  const totalPages = ref(1)
  const perPageOptions = [10, 25, 50, 100]
  const searchQuery = ref('')
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const invoiceId = ref(null)
  const invoiceData = ref({})


  const deleteInvoice = async id => {
    try {
      isLoading.value = true

      const res = await axios.delete(route('invoices.destroy', id))

      respResult.value = res
      toast.success(res.data.message)

      // refetchData()
    } catch (error) {
      console.log(error)
      toast.error('Error! Deleting invoice')
    } finally {
      isLoading.value = false
    }
  }

  const getInvoice = async id => {
    const response = await axios.get(route('invoices.show', id))


    invoiceData.value = response.data.data
  }

  // sendInvoice

  const sendInvoice = async (invoiceId, formData) => {

    try {
      isLoading.value = true

      const response =  await axios.post(route('invoices.send', invoiceId), formData)

      console.log(response)
     
      respResult.value = response
      toast.success(response.data.message)
    } catch (error) {
      console.log(error)
      toast.error(error.response.data.message)
    } finally {
      isLoading.value = false
    }

  }



  const updateInvoice = async (id, formData) => {
    try {
      isLoading.value = true

      const response = await axios.post(route('invoices.update', id), formData)

      respResult.value = response
      toast.success(response.data.message)
    } catch (error) {
    
      toast.error(error.response.data.message)
    } finally {
      isLoading.value = false
    }
  }


  const updateInvoiceStatus = async (id, formData) => {
    try {
      isLoading.value = true  

      const response = await axios.post(route('invoices.status', id), formData)

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



  const storeInvoice = async formData => {
    isLoading.value = true
    await axios
      .post(route('invoices.store'), formData)
      .then(resp => {
        respResult.value = resp
        toast.success(resp.data.message)
      })
      .catch(err => {
        respResult.value = err

        toast.error(err.response.data.message)
      }).finally(() => {
        isLoading.value = false
      })
  }


  const fetchInvoices = async () => {
    isLoading.value = true
    try {
      const response = await axios.get(route('invoices.index'), {
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
      invoices.value = response.data.data
      totalRecords.value = total
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const fetchInvoicesByStatus= async () => {
    isLoading.value = true
    try {
      const response = await axios.get(route('invoices.count-by-status'))

      invoicesByStatus.value = response.data.data
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const fetchInvoicesList = async role => {
    isLoading.value = true
    try {
      const response = await axios.get(route('invoices.index'), {
        params: {
          ...filters,
        },
      })

      invoices.value = response.data.data
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const resolveInvoiceStatusVariantAndIcon = status => {
    if (status === 'Paid')
      return {
        variant: 'primary',
        icon: 'tabler-circle-check',
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
        icon: 'tabler-mail',
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
    fetchInvoices()
  }, 500)

  watch(searchQuery, () => {
    debouncedSearch()
  })
  


  watch([currentPage, itemsPerPage], () => {
    fetchInvoices()
  })

  return {
    invoiceData,
    isLoading,
    getInvoice,
    invoiceId,
    sortBy,
    itemsPerPage,
    totalPages,
    filters,
    respResult,
    fetchInvoicesByStatus,
    invoices,
    invoicesByStatus,
    fetchInvoices,
    deleteInvoice,
    updateInvoice,
    sendInvoice,
    currentPage,
    searchQuery,
    totalRecords,
    headers,
    isSortDirDesc,
    perPageOptions,
    storeInvoice,
    fetchInvoicesList,
    resolveInvoiceStatusVariantAndIcon,
    updateInvoiceStatus,
  }
}
