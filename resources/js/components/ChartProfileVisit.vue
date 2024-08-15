<template>
  <div>
    <apexchart type="bar" height="300" :options="optionsProfileVisit" />
  </div>
</template>

<script>
import VueApexCharts from "vue-apexcharts";

export default {
  components: {
    apexchart: VueApexCharts,
  },
  props: ["optionsProfileVisit"],
};
</script>
