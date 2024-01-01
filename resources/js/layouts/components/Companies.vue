<script setup>
import axios from '@axios'
import AddCompany from '@core/components/AddCompany.vue'

const isAddNewDialogVisible = ref(false)

const companies = ref([])
const selectedCompany = ref({})

const bootstrapApp = async () => {
  try {
    const resp = await axios.get('/bootstrap')

    companies.value = resp.data.companies

    setCompany(resp.data.current_company)
  } catch (error) {
    console.log(error)
  }
}

const setCompany = company => {
 
  if(!company) return

  localStorage.setItem('companyId', company.id)

  selectedCompany.value = company

}

const selectCompany = company => {
  setCompany(company)

  window.location.reload()
}


onMounted(async () => {
  await bootstrapApp()
})
</script>



<template>
  <VMenu>
    <template #activator="{ props }">
      <VBtn
        color="primary"
        variant="text"
        v-bind="props"
      >
        <img
          v-if="selectedCompany?.logo_url"
          :src="selectedCompany?.logo_url ?? ''"
          alt="company logo"
          height="24"
        >


        <span>
          {{ selectedCompany?.name ?? 'Select Company' }}
        </span>

        <VIcon
          size="18"
          icon="tabler-chevron-down"
        />
      </VBtn>
    </template>
    <VList>
      <VListItem
        v-for="(company, index) in companies"
        :key="index"
        :value="index"
        @click="selectCompany(company)"
      >
        <VListItemTitle>
          {{ company.name }}
        </VListItemTitle>
      </VListItem>

      <VListItem @click="isAddNewDialogVisible = true">
        <template #prepend>
          <VIcon
            class="me-2"
            icon="tabler-plus"
            size="22"
          />
        </template>

        <VListItemTitle>Add New Company</VListItemTitle>
      </VListItem>
    </VList>
  </VMenu>

  <AddCompany
    v-if="isAddNewDialogVisible"
    v-model:isDialogVisible="isAddNewDialogVisible"
    @refetch-data="bootstrapApp"
  />
</template>
