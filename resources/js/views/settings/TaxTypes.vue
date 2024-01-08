<script setup>
import useTaxTypes from '@/composables/taxTypes'
import ability from '@/plugins/casl/ability'
import Add from './TaxTypes/Add.vue'
import Edit from './TaxTypes/Edit.vue'
import { VDataTableServer } from 'vuetify/labs/VDataTable'

const { fetchTaxTypes, taxTypes,  headers, searchQuery, itemsPerPage, currentPage, totalRecords, isLoading, deleteTaxType } = useTaxTypes()

const taxTypeId = ref('')
const isConfirmDialogOpen = ref(false)
const isAddNewDialogVisible = ref(false)
const isEditDialogVisible = ref(false)

onMounted(() => {
  fetchTaxTypes()
})

const editTaxType = taxType => {
  taxTypeId.value = taxType
  isEditDialogVisible.value = true
}

const taxTypeDelete = async confirm => {
  if(confirm){
    await deleteTaxType(taxTypeId.value)
    fetchTaxTypes()
  }
}

const confirmDelete = taxType => {
  taxTypeId.value = taxType
  isConfirmDialogOpen.value = true
}
</script>

<template>
  <section>
    <VRow>
      <VCol cols="12">
        <VCard title="Tax Types">
          <VDivider />

          <VCardText class="d-flex flex-wrap py-4 gap-4">
            <VRow>
              <VCol
                lg="3"
                md="3"
                sm="4"
                cols="12"
              >
                <VBtn
                  v-if="ability.can('Create', 'tax-types-create')"
                  prepend-icon="tabler-plus"
                  @click="isAddNewDialogVisible = true"
                >
                  Add New Tax Type
                </VBtn>
              </VCol>

              <VCol
                offset="5"
                lg="4"
                md="4"
                sm="4"
                cols="12"
              >
                <VTextField
                  v-model="searchQuery"
                  placeholder="Search"
                  density="compact"
                />
              </VCol>
            </VRow>
          </VCardText>

          <VDivider />

          <VDataTableServer
            v-model:items-per-page="itemsPerPage"
            v-model:page="currentPage"
            :loading="isLoading"
            :items-length="totalRecords"
            :headers="headers"
            :items="taxTypes"
            class="text-no-wrap"
          >
            <template #item.name="{ item }">
              <h6 class="text-h6 font-weight-bold">
                {{ item.raw.name }}
              </h6>
              <span class="text-sm">
                {{ item.raw.description }}
              </span>
            </template>

            
            <template #item.actions="{ item }">
              <IconBtn
                v-if="ability.can('Update', 'tax-types-edit')" 
                @click="editTaxType(item.raw.id)"
              >
                <VIcon icon="tabler-pencil" />
              </IconBtn>

              <IconBtn
                v-if="ability.can('Delete', 'tax-types-delete')"
                @click="confirmDelete(item.raw.id)"
              >
                <VIcon icon="tabler-trash" />
              </IconBtn>
            </template>
          </VDataTableServer>
        </VCard>
      </VCol>
    </VRow>
  

    <Add
      v-if="isAddNewDialogVisible"
      v-model:isDialogVisible="isAddNewDialogVisible"
      @refetch-data="fetchTaxTypes"
    />
    <Edit
      v-if="isEditDialogVisible"
      v-model:isDialogVisible="isEditDialogVisible"
      :tax-type-id="taxTypeId"
      @refetch-data="fetchTaxTypes"
    />

    <ConfirmDialog
      v-model:isDialogVisible="isConfirmDialogOpen"
      cancel-title="Cancelled"
      confirm-title="Deleted"
      confirm-msg="Tax Type deleted successfully."
      confirmation-question="Are you sure you want to delete Tax Type, This action is irreversible?"
      cancel-msg="Tax Type deletion cancelled."
      @confirm="taxTypeDelete"
    />
  </section>
</template>
