<script setup>
import { hexToRgb } from "@layouts/utils"
import { useTheme } from "vuetify"
import VueApexCharts from 'vue3-apexcharts'
import { formatCurrency } from "@core/utils/formatters"

import { useI18n } from "vue-i18n"

const props = defineProps({
  monthlySales: {
    type: Object,
  },
  companyCurrency: {
    type: Object,
  },
})


const vuetifyTheme = useTheme()
const currentTab = ref(0)
const refVueApexChart = ref()
const months = ref(Object.values(props.monthlySales).map(item => item.month))
const monthsValues = ref(Object.values(props.monthlySales).map(item => item.sales))


const chartConfigs = computed(() => {
  const currentTheme = vuetifyTheme.current.value.colors
  const variableTheme = vuetifyTheme.current.value.variables

  const labelPrimaryColor = `rgba(${hexToRgb(currentTheme.primary)},${
    variableTheme["dragged-opacity"]
  })`

  const legendColor = `rgba(${hexToRgb(currentTheme["on-background"])},${
    variableTheme["high-emphasis-opacity"]
  })`

  const borderColor = `rgba(${hexToRgb(
    String(variableTheme["border-color"]),
  )},${variableTheme["border-opacity"]})`

  const labelColor = `rgba(${hexToRgb(currentTheme["on-surface"])},${
    variableTheme["disabled-opacity"]
  })`

  return [
    {
      title: "Earning",
      icon: "tabler-shopping-cart",
      chartOptions: {
        chart: {
          parentHeightOffset: 0,
          type: "bar",
          toolbar: { show: false },
        },
        plotOptions: {
          bar: {
            columnWidth: "32%",
            startingShape: "rounded",
            borderRadius: 4,
            distributed: true,
            dataLabels: { position: "top" },
          },
        },
        grid: {
          show: false,
          padding: {
            top: 0,
            bottom: 0,
            left: -10,
            right: -10,
          },
        },
        colors: [currentTheme.primary],

        dataLabels: {
          enabled: true,
          offsetY: -25,
          style: {
            fontSize: "15px",
            colors: [legendColor],
            fontWeight: "600",
            fontFamily: "Public Sans",
          },
          formatter: function (value) {
            return formatCurrency(value, props.companyCurrency.code)
          },
        },
        legend: { show: false },
        tooltip: { enabled: false },
        xaxis: {
          categories: months.value,
          axisBorder: {
            show: true,
            color: borderColor,
          },
          axisTicks: { show: false },
          labels: {
            style: {
              colors: labelColor,
              fontSize: "13px",
              fontFamily: "Public Sans",
            },
           
          },
        },
        yaxis: {
          labels: {
            offsetX: -15,
            style: {
              fontSize: "13px",
              colors: labelColor,
              fontFamily: "Public Sans",
            },
            formatter: function (value) {
              return value / 1000 + "k"
            },
            min: 0,
            max: 60000,
            tickAmount: 6,
          },

        },
        responsive: [
          {
            breakpoint: 1441,
            options: { plotOptions: { bar: { columnWidth: "41%" } } },
          },
          {
            breakpoint: 590,
            options: {
              plotOptions: { bar: { columnWidth: "61%" } },
              yaxis: { labels: { show: false } },
              grid: {
                padding: {
                  right: 0,
                  left: -20,
                },
              },
              dataLabels: {
                style: {
                  fontSize: "12px",
                  fontWeight: "400",
                },
              },
            },
          },
        ],
      },
      series: [
        {
          data: monthsValues.value,
        },
      ],
    },
  ]
})
</script>

<template>
  <VCard title="Monthly Sales">
    <VCardText>
      <VueApexCharts
        ref="refVueApexChart"
        :key="currentTab"
        :options="chartConfigs[Number(currentTab)].chartOptions"
        :series="chartConfigs[Number(currentTab)].series"
        height="350"
        class="mt-3"
      />
    </VCardText>
  </VCard>
</template>
