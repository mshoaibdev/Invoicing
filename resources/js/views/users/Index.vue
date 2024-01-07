<script setup>
import { VDataTableServer } from 'vuetify/labs/VDataTable'

import useUsers from '@/composables/users'
import ability from '@/plugins/casl/ability'
import { avatarText } from '@core/utils/formatters'
import AddUser from './AddUser.vue'
import EditUser from './EditUser.vue'

const { fetchUsers, users, headers, searchQuery, itemsPerPage, currentPage, deleteUser, resolveUserRoleVariant, isLoading, totalRecords } = useUsers()

const userId = ref('')
const isConfirmDialogOpen = ref(false)
const isAddNewDialogVisible = ref(false)
const isEditDialogVisible = ref(false)
const isMobileViewPort = ref(false)
const selectedRows = ref([])
const tableColumns = ref([])


onMounted(() => {

  if(window.innerWidth < 768) {
    tableColumns.value = headers.slice(0, 1)
    isMobileViewPort.value = true
  }

  fetchUsers()
})


const editUser = userObjId => {
  userId.value = userObjId
  isEditDialogVisible.value = true
}

const userDelete = async confirm => {
  if(confirm){
    await deleteUser(userId.value)
    fetchUsers()
  }
}

const confirmDelete = userObjId => {
  userId.value = userObjId
  isConfirmDialogOpen.value = true
}
</script>

<template>
  <section>
    <VRow>
      <VCol cols="12">
        <VCard title="Users">
          <VCardText class="d-flex flex-wrap py-4 gap-4">
            <VRow>
              <VCol
                lg="3"
                md="3"
                sm="3"
                cols="12"
              >
                <VBtn
                  v-if="ability.can('Create', 'users-create')"
                  prepend-icon="tabler-plus"
                  @click="isAddNewDialogVisible = true"
                >
                  Add New User
                </VBtn>
              </VCol>
              <!--
                <VCol
                lg="3"
                md="6"
                sm="8"
                cols="12"
                >
                <AppSelect
                v-model="tableColumns"
                multiple
                eager
                :items="headers"
                @update:model-value="toggleTableColumns"
                > 
                <template #selection="{ item, index }">
                <VChip v-if="index < 4">
                <span>{{ item.title }}</span>
                </VChip>
                <span
                v-if="index === 4"
                class="text-grey text-caption align-self-center"
                >
                (+{{ tableColumns.length - 4 }} others)
                </span>
                </template>
                </AppSelect>
                </VCol>
              -->
              <VCol
                lg="6"
                md="6"
                sm="6"
                cols="12"
              />
              <VCol
                lg="3"
                md="3"
                sm="3"
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
            v-model="selectedRows"
            v-model:items-per-page="itemsPerPage"
            v-model:page="currentPage"
            :loading="isLoading"
            :items-length="totalRecords"
            :headers="headers"
            :items="users"
            class="text-no-wrap"
          >

            <template #item.email="{ item }">
              <a
                :href="`mailto:${item.raw.customer.email}`"
                class="text-decoration-none"
              >
                {{ item.raw.customer.email }}
              </a>
            </template>

            <template #item.role="{ item }">
              <span class="text-capitalize text-base">{{ item.raw.roles[0]?.name }}</span>
            </template>

            
            <template #item.phone="{ item }">
              <a
                :href="`tel:${item.raw.phone}`"
                class="text-decoration-none"
              >
                {{ item.raw.phone }}
              </a>
            </template>

            <template #item.name="{ item }">
              <div class="d-flex align-center justify-space-between">
                <div class="d-flex flex-column">
                  <h6 class="text-base">
                    {{ item.raw.name }}
                  </h6>
                  <span class="text-sm text-disabled">
                    <a
                      :href="`mailto:${item.raw.email}`"
                      class="text-decoration-none"
                    >
                      {{ item.raw.email }}
                    </a>
                  </span>
                </div>
                <IconBtn
                  v-if="isMobileViewPort"
                  @click="editUser(item.raw.id)"
                >
                  <VIcon icon="tabler-pencil" />
                </IconBtn>
              </div>
            </template>


            
            <!-- Actions -->
            <template #item.actions="{ item }">
              <VBtn
                v-if="ability.can('Delete', 'users-delete')"
                icon
                variant="text"
                color="default"
                size="x-small"
                @click="confirmDelete(item.raw.id)"
              >
                <VIcon
                  size="22"
                  icon="tabler-trash"
                />
              </VBtn>

              <VBtn
                v-if="ability.can('Update', 'users-edit')"
                icon
                variant="text"
                color="default"
                size="x-small"
                @click="editUser(item.raw.id)"
              >
                <VIcon
                  size="22"
                  icon="tabler-pencil"
                />
              </VBtn>
            </template>
          </VDataTableServer>
        </VCard>
      </VCol>
    </VRow>
  

    <AddUser
      v-if="isAddNewDialogVisible"
      v-model:isDialogVisible="isAddNewDialogVisible"
      @refetch-data="fetchUsers"
    />
    <EditUser
      v-if="isEditDialogVisible"
      v-model:isDialogVisible="isEditDialogVisible"
      :user-id="userId"
      @refetch-data="fetchUsers"
    />

    <ConfirmDialog
      v-model:isDialogVisible="isConfirmDialogOpen"
      cancel-title="Cancelled"
      confirm-title="Deleted"
      confirm-msg="role deleted successfully."
      confirmation-question="Are you sure you want to delete user, This action is irreversible?"
      cancel-msg="user deletion cancelled."
      @confirm="userDelete"
    />
  </section>
</template>

<style scoped lang="scss">
@use "@/@layouts/styles/mediaStyles.scss";

.app-user-search-filter {
  inline-size: 31.6rem;
}

.text-capitalize {
  text-transform: capitalize;
}

.user-list-name:not(:hover) {
  color: rgba(var(--v-theme-on-background), var(--v-high-emphasis-opacity));
}
</style>
