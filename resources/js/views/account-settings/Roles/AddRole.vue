<script setup>
import usePermissions from '@/composables/permissions'
import useRoles from '@/composables/roles'

import {
requiredValidator,
} from '@validators'

const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
})

const emit = defineEmits([
  'refetchData',
  'update:isDialogVisible',
])

const { storeRole,respResult, isBusy, errors } = useRoles()
const { permissions, fetchPermissionsList } = usePermissions()

const refForm = ref()

const initialState = {
  name: '',
  permissions: [],
}

onMounted(async () => {
  if(props.isDialogVisible){
    await fetchPermissionsList()
  }
})

//check and unchecked all permissions
const checkAll = ref(false)

const onCheckAll = () => {
  if (checkAll.value) {
    formData.value.permissions = permissions.value.map(permission => permission.id)
  } else {
    formData.value.permissions = []
  }
}




// create group of permission based on permission name with prefix first hyphen (-) character as group name and rest string as permission name 
const permissionsGroup = computed(() => {
  const permissionsGroup = {}

  permissions.value.forEach(permission => {
    const [groupName, permissionName] = permission.name.split('-')
    if (permissionsGroup[groupName]) {
      permissionsGroup[groupName].push(permission)
    } else {
      permissionsGroup[groupName] = [permission]
    }
  })
  
  return permissionsGroup
})



const formData = ref({ ...initialState })

const resetFormData = () => {
  formData.value = {
    ...initialState,
  }
  nextTick(() => {
    refForm.value?.reset()
    refForm.value?.resetValidation()
  })
}

const onSubmit = async() => {
  refForm.value?.validate().then(async ({ valid: isValid }) => {
    if (isValid){

      await storeRole(formData.value)
      if (respResult.value.status === 200) {
        emit('refetchData')
        emit('update:isDialogVisible', false)
        resetFormData()
      }
    }
  })
}


const onFormReset = () => {
  resetFormData()
  emit('update:isDialogVisible', false)
}


const dialogModelValueUpdate = val => {
  emit('update:isDialogVisible', val)
}
</script>

<template>
  <VDialog
    :width="$vuetify.display.smAndDown ? 'auto' : 800"
    :model-value="props.isDialogVisible"
    @update:model-value="dialogModelValueUpdate"
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="dialogModelValueUpdate(false)" />
    <VCard title="Add New Role">
      <VCardText>
        <!-- 👉 Form -->
        <VForm
          ref="refForm"
          @submit.prevent="onSubmit"
        >
          <VRow>
            <VCol
              cols="12"
              md="12"
            >
              <VTextField
                v-model="formData.name"
                label="Role Name"
                :rules="[requiredValidator]"
              />
            </VCol>

            <VCol
              cols="12"
              md="12"
            >
              <div class="d-flex justify-space-between align-center">
                <h4>Select Permissions</h4>
                <VCheckbox
                  v-model="checkAll"
                  :label="`Select All (${permissions.length})`"
                  @update:model-value="onCheckAll"
                />
              </div>
              <VList>
                <VListGroup
                  v-for="(permissionGroup, permissionGroupName) in permissionsGroup"
                  :key="permissionGroupName"
                  :value="permissionGroupName"
                >
                  <template #activator="{ props }">
                    <VListItem
                      v-bind="props"
                      :title="permissionGroupName"
                    />
                  </template>


                  <VListItem
                    v-for="permission in permissionGroup"
                    :key="permission.id"
                    class="pl-8"
                  >
                    <VListItemAction>
                      <VCheckbox
                        v-model="formData.permissions"
                        :value="permission.id"
                        :label="permission.name"
                      />
                    </VListItemAction>
                  </VListItem>
                </VListGroup>
              </VList>
            </VCol>

            <VCol
              cols="12"
              class="d-flex flex-wrap gap-4 justify-end"
            >
              <VBtn
                type="submit"
                :loading="isBusy"
                :disabled="isBusy"
                @click="refForm?.validate()"
              >
                Add New
              </VBtn>
              <VBtn
                color="secondary"
                variant="tonal"
                @click="onFormReset"
              >
                Cancel
              </VBtn>
            </VCol>
          </VRow>
        </VForm>
      </VCardText>
    </VCard>
  </VDialog>
</template>

<style lang="scss">
.v-list-item-title {
  font-weight: 500;
  text-transform: capitalize;
}
</style>