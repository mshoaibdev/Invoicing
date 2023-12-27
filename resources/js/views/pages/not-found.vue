<script setup>
import { useGenerateImageVariant } from '@core/composable/useGenerateImageVariant'
import miscMaskDark from '@images/pages/misc-mask-dark.png'
import miscMaskLight from '@images/pages/misc-mask-light.png'

const authThemeMask = useGenerateImageVariant(miscMaskLight, miscMaskDark)
</script>

<template>
  <div class="misc-wrapper">
    <ErrorHeader
      error-title="Page Not Found :("
      error-description="We couldn't find the page you are looking for."
    />
   

    <!-- 👉 Image -->
    <div class="misc-avatar  text-center">
      <VBtn
        :to="{name: 'dashboard'}"
        class="mb-12"
      >
        Back to Home
      </VBtn>
    </div>

    <VImg
      :src="authThemeMask"
      class="misc-footer-img d-none d-md-block"
    />
  </div>
</template>

<style lang="scss">
@use "@core-scss/template/pages/misc.scss";
</style>

