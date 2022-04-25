<template>
  <div class="container bg-white border-2 rounded-lg">
    <Pie
      :chart-options="chartOptions"
      :chart-data="chartData"
      :chart-id="chartId"
      :plugins="plugins"
      :css-classes="cssClasses"
      :styles="styles"
      :width="width"
      :height="height"
    />
  </div>
</template>

<script>
import { Pie } from "vue-chartjs";
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  ArcElement,
  CategoryScale,
  Plugin,
} from "chart.js";

ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale);

export default {
  name: "PieChart",
  components: { Pie },
  props: {
    arrayLabels: Array,
    arrayData: Array,
    chartId: {
      type: String,
      default: "pie-chart",
    },

    width: {
      type: Number,
      default: 400,
    },
    height: {
      type: Number,
      default: 400,
    },
    cssClasses: {
      default: "",
      type: String,
    },
    styles: {
      type: Object,
      default: () => {},
    },
    plugins: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      chartData: {
        labels: this.arrayLabels,
        datasets: [
          {
            label: "Estadística Pastorales Gráfico Pastel",
            backgroundColor: [
              "#3377FF",
              "#49D0A3",
              "#F06321 ",
              "#E46651",
              "#00D8FF",
              "#DD1B16",
            ],
            data: this.arrayData,
          },
        ],
      },
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false,
      },
    };
  },
};
</script>
