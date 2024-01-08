import axios from '@axios'
import { debounce } from 'lodash'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import route from 'ziggy-js'

export default function useTaxTypes() {
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
      title: 'Actions',
      key: 'actions',
      sortable: false,
      visible: true,
    },

  ]

  const filters = reactive({
  })

  const taxTypes = ref([])
  const itemsPerPage = ref(10)
  const totalRecords = ref(0)
  const currentPage = ref(1)
  const totalPages = ref(1)
  const perPageOptions = [10, 25, 50, 100]
  const searchQuery = ref('')
  const sortBy = ref('id')
  const isSortDirDesc = ref(true)
  const taxTypeId = ref(null)
  const taxTypeData = ref({})
  const errors = ref({})


  const deleteTaxType = async id => {
    try {
      isLoading.value = true

      const res = await axios.delete(route('tax-types.destroy', id))

      respResult.value = res
      toast.success(res.data.message)

      // refetchData()
    } catch (error) {
      console.log(error)
      toast.error('Error! Deleting tax type')
    } finally {
      isLoading.value = false
    }
  }


  const getTaxType = async id => {
    const response = await axios.get(route('tax-types.show', id))

    taxTypeData.value = response.data.data
  }


  const updateTaxType = async (id, formData) => {
    try {
      isLoading.value = true

      const response = await axios.post(route('tax-types.update', id), formData)

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


  const storeTaxType = async formData => {
    isLoading.value = true
    await axios
      .post(route('tax-types.store'), formData)
      .then(resp => {
        respResult.value = resp
        toast.success(resp.data.message)
      })
      .catch(err => {
        respResult.value = err
        if (err.response.status === 422) {
          errors.value = error.response.data.errors
        }
        toast.error(error.response.data.message)
      }).finally(() => {
        isLoading.value = false
      })
  }


  const fetchTaxTypes = async () => {
    isLoading.value = true
    try {
      const response = await axios.get(route('tax-types.index'), {
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
      taxTypes.value = response.data.data
      totalRecords.value = total
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }


  const fetchTaxTypesList = async role => {
    isLoading.value = true
    try {
      const response = await axios.get(route('fetch-tax-types'), {
        params: {
          ...filters,
        },
      })

      taxTypes.value = response.data.data
    } catch (e) {
      toast.error(e.response.data.message)
    } finally {
      isLoading.value = false
    }
  }

  const debouncedSearch = debounce(() => {
    fetchTaxTypes()
  }, 500)

  watch(searchQuery, () => {
    debouncedSearch()
  })
  


  watch([currentPage, itemsPerPage, filters], () => {
    fetchTaxTypes()
  })

  return {
    taxTypeData,
    isLoading,
    getTaxType,
    sortBy,
    itemsPerPage,
    totalPages,
    filters,
    respResult,
    taxTypes,
    fetchTaxTypes,
    deleteTaxType,
    updateTaxType,
    currentPage,
    searchQuery,
    totalRecords,
    headers,
    isSortDirDesc,
    perPageOptions,
    storeTaxType,
    fetchTaxTypesList,
  }
}
