import axios from '@axios'
import { debounce } from 'lodash'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import route from 'ziggy-js'

export default function useCustomers() {
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
      title: 'Email',
      key: 'email',
      sortable: false,
      visible: true,
    },
    {
      title: 'Phone',
      key: 'phone',
      sortable: false,
      visible: true,
    },
    {
      title: 'Address',
      key: 'address',
      sortable: false,
      visible: true,
    },
    {
      title: 'Lead Type',
      key: 'lead_type',
      sortable: false,
      visible: true,
    },
   
    {
      title: 'Status',
      key: 'status',
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

  const customers = ref([])
  const customersByStatus = ref([])
  const itemsPerPage = ref(10)
  const totalRecords = ref(0)
  const currentPage = ref(1)
  const totalPages = ref(1)
  const perPageOptions = [10, 25, 50, 100]
  const searchQuery = ref('')
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const customerId = ref(null)
  const customerData = ref({})
  const errors = ref({})

  const paginationData = computed(() => {
    const firstIndex = customers.value.length ? (currentPage.value - 1) * itemsPerPage.value + 1 : 0
    const lastIndex = customers.value.length + (currentPage.value - 1) * itemsPerPage.value
  
    return `Showing ${ firstIndex } to ${ lastIndex } of ${ totalRecords.value } entries`
  })

  const refetchData = () => {
    refListTable.value.refresh()
  }


  const deleteCustomer = async id => {
    try {
      isLoading.value = true

      const res = await axios.delete(route('customers.destroy', id))

      respResult.value = res
      toast.success(res.data.message)

      // refetchData()
    } catch (error) {
      console.log(error)
      toast.error('Error! Deleting customer')
    } finally {
      isLoading.value = false
    }
  }

  const deleteMultipleCustomer = async ids => {
    try {
      isLoading.value = true

      const res = await axios.post(route('customers.delete'), { ids: ids })

      respResult.value = res
      toast.success(res.data.message)

      // refetchData()
    } catch (error) {
      console.log(error)
      toast.error('Error! Deleting customer')
    } finally {
      isLoading.value = false
    }
  }

  const getCustomer = async id => {
    const response = await axios.get(route('customers.show', id))

    customerData.value = response.data.data
  }


  const updateCustomer = async (id, formData) => {
    try {
      isLoading.value = true

      const response = await axios.put(route('customers.update', id), formData)

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


  const updateCustomerStatus = async (id, formData) => {
    try {
      isLoading.value = true  

      const response = await axios.post(route('customers.status', id), formData)

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



  const storeCustomer = async formData => {
    isLoading.value = true
    await axios
      .post(route('customers.store'), formData)
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


  const fetchCustomers = async () => {
    isLoading.value = true
    try {
      const response = await axios.get(route('customers.index'), {
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
      customers.value = response.data.data
      totalRecords.value = total
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const fetchCustomersByStatus= async () => {
    isLoading.value = true
    try {
      const response = await axios.get(route('customers.count-by-status'))

      customersByStatus.value = response.data.data
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const fetchCustomersList = async role => {
    isLoading.value = true
    try {
      const response = await axios.get(route('customers.index'), {
        params: {
          ...filters,
        },
      })

      customers.value = response.data.data
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const debouncedSearch = debounce(() => {
    fetchCustomers()
  }, 500)

  watch(searchQuery, () => {
    debouncedSearch()
  })
  


  watch([currentPage, itemsPerPage, filters], () => {
    fetchCustomers()
  })

  return {
    customerData,
    isLoading,
    errors,
    getCustomer,
    customerId,
    sortBy,
    itemsPerPage,
    totalPages,
    filters,
    paginationData,
    respResult,
    fetchCustomersByStatus,
    customers,
    customersByStatus,
    fetchCustomers,
    deleteMultipleCustomer,
    deleteCustomer,
    refetchData,
    updateCustomer,
    currentPage,
    searchQuery,
    refListTable,
    totalRecords,
    headers,
    isSortDirDesc,
    perPageOptions,
    storeCustomer,
    fetchCustomersList,
    updateCustomerStatus,
  }
}
