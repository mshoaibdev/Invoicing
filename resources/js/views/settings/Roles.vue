<script setup>
import useRoles from '@/composables/roles'
import ability from '@/plugins/casl/ability'
import AddRole from './Roles/AddRole.vue'
import EditRole from './Roles/EditRole.vue'

const { fetchRoles, roles, respResult, tableColumns, searchQuery, perPage, currentPage, totalPages, paginationData, deleteRole, resolveRoleRoleVariant } = useRoles()

const roleId = ref('')
const isConfirmDialogOpen = ref(false)
const isAddNewDialogVisible = ref(false)
const isEditDialogVisible = ref(false)

onMounted(() => {
  fetchRoles()
})

const editRole = role => {
  roleId.value = role
  isEditDialogVisible.value = true
}

const roleDelete = async confirm => {
  if(confirm){
    await deleteRole(roleId.value)
    fetchRoles()
  }
}

const confirmDelete = role => {
  roleId.value = role
  isConfirmDialogOpen.value = true
}

watchEffect(() => {
  if (currentPage.value > totalPages.value)
    currentPage.value = totalPages.value
})
</script>

<template>
  <section>
    <VRow>
      <VCol cols="12">
        <VCard title="Roles">
          <VDivider />

          <VCardText class="d-flex flex-wrap py-4 gap-4">
            <VRow>
              <VCol
                lg="3"
                md="3"
                sm="3"
                cols="12"
              >
                <VBtn
                  v-if="ability.can('Create', 'settings-roles-create')"
                  prepend-icon="tabler-plus"
                  @click="isAddNewDialogVisible = true"
                >
                  Add New Role
                </VBtn>
              </VCol>

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

          <VTable class="text-no-wrap">
            <!-- 👉 Table head -->
            <thead>
              <tr>
                <th
                  v-for="(column, key) in tableColumns"
                  :key="key"
                  scope="col"
                >
                  {{ column.label }}
                </th>
                <th scope="col">
                  <span class="ms-2">ACTIONS</span>
                </th>
              </tr>
            </thead>

            <!-- 👉 Table Body -->
            <tbody>
              <tr
                v-for="role in roles"
                :key="role.id"
              >
                <td>{{ role.name }}</td>
                <!-- 👉 Role -->
              

                <td>
                  <div class="d-flex flex-wrap gap-2 mt-2 mb-2">
                    <VChip
                      v-for="permission in role.permissions"
                      :key="permission.id"
                      :color="resolveRoleRoleVariant(permission.name).color"
                      :icon="resolveRoleRoleVariant(role.name).icon"
                      class="text-capitalize font-weight-medium mr-2 "
                      label
                      small
                    >
                      {{ permission.name }}
                    </VChip>
                  </div>
                </td>

                <td style="width: 7.5rem;">
                  <VBtn
                    v-if="ability.can('Delete', 'settings-roles-delete')"
                    icon
                    variant="text"
                    color="default"
                    size="x-small"
                    @click="confirmDelete(role.id)"
                  >
                    <VIcon
                      size="22"
                      icon="tabler-trash"
                    />
                  </VBtn>

                  <VBtn
                    v-if="ability.can('Update', 'settings-roles-edit')"
                    icon
                    variant="text"
                    color="default"
                    size="x-small"
                    @click="editRole(role.id)"
                  >
                    <VIcon
                      size="22"
                      icon="tabler-pencil"
                    />
                  </VBtn>
                </td>
              </tr>
            </tbody>

            <!-- 👉 table footer  -->
            <tfoot v-show="!roles.length">
              <tr>
                <td
                  colspan="8"
                  class="text-center text-body-1"
                >
                  No data available
                </td>
              </tr>
            </tfoot>
          </VTable>

          <VDivider />

          <VCardText class="d-flex align-center flex-wrap justify-space-between gap-4 py-3 px-5">
            <span class="text-sm text-disabled">
              {{ paginationData }}
            </span>

            <VPagination
              v-model="currentPage"
              size="small"
              :total-visible="5"
              :length="totalPages"
            />
          </VCardText>
        </VCard>
      </VCol>
    </VRow>
  

    <AddRole
      v-if="isAddNewDialogVisible"
      v-model:isDialogVisible="isAddNewDialogVisible"
      @refetch-data="fetchRoles"
    />
    <EditRole
      v-if="isEditDialogVisible"
      v-model:isDialogVisible="isEditDialogVisible"
      :role-id="roleId"
      @refetch-data="fetchRoles"
    />

    <ConfirmDialog
      v-model:isDialogVisible="isConfirmDialogOpen"
      cancel-title="Cancelled"
      confirm-title="Deleted"
      confirm-msg="role deleted successfully."
      confirmation-question="Are you sure you want to delete role, This action is irreversible?"
      cancel-msg="role deletion cancelled."
      @confirm="roleDelete"
    />
  </section>
</template>

<style scoped lang="scss">
@use "@/@layouts/styles/mediaStyles.scss";

.app-role-search-filter {
  inline-size: 31.6rem;
}

.text-capitalize {
  text-transform: capitalize;
}

.role-list-name:not(:hover) {
  color: rgba(var(--v-theme-on-background), var(--v-high-emphasis-opacity));
}
</style>
