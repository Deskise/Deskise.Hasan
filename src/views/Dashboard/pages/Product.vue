<template>
  <div>
    <strong>Visits</strong>
    <p>{{ this.totalViews }}</p>
  </div>
  <Chart :data="productsViews" :labels="monthes" />
</template>
  
<script>
  import Chart from '../../../components/Products/Chart.vue'
  import { mapGetters } from "vuex";

  export default {
  components: { Chart },
  computed: {
    ...mapGetters("user", ["views", "productsIds", "monthlyViews", "totalViews"]),

    productsViews() {
      return Object.values(this.monthlyViews)
    },
    monthes() {
      return Object.keys(this.monthlyViews)
    }

    // productViews() {
    //   const views = Object.values(this.views)
    //   console.log(views);
    //   const viewSum = views.reduce((acc, val) => acc + val, 0);
    //     return [viewSum]
    // },
    // monthLabels() {
    //     const months = [];
    //     const date = new Date();
    //     for (let i = 0; i < 3; i++) {
    //       const month = date.toLocaleString('default', { month: 'long' });
    //       months.unshift(month);
    //       date.setMonth(date.getMonth() - 1);
    //     }
    //     return months;
    //   }
  }

}
</script>