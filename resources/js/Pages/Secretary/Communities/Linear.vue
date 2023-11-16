<template>
  <div class="container bg-white border-2 rounded-lg"></div>
</template>

<script>
import { generateChart } from "vue-chartjs";

import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  LineController,
  LineElement,
  PointElement,
  CategoryScale,
  LinearScale,
  Plugin,
} from "chart.js";

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  LineElement,
  PointElement,
  CategoryScale,
  LinearScale
);

class LineWithLineController extends LineController {
  draw() {
    super.draw();
    if (this.chart?.tooltip?.active) {
      const ctx = this.chart.ctx;
      const x = this.chart.tooltip.x;
      const topY = this.chart.scales["y-axis-0"].top;
      const bottomY = this.chart.scales["y-axis-0"].bottom;

      ctx.save();
      ctx.beginPath();
      ctx.moveTo(x, topY);
      ctx.lineTo(x, bottomY);
      ctx.lineWidth = 2;
      ctx.strokeStyle = "#07C";
      ctx.stroke();
      ctx.restore();
    }
  }
}

const LineWithLine = generateChart("line-with-chart", "line", LineWithLineController);

export default {
  name: "CustomChart",
  components: {
    LineWithLine,
  },
  props: {
    arrayLabels: Array,
    arrayData: Array,
    chartId: {
      type: String,
      default: "-chart",
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
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
          {
            label: "Data One",
            backgroundColor: "#f87979",
            data: [40, 39, 10, 40, 39, 80, 40],
          },
        ],
      },

      chartOptions: {
        responsive: true,
        maintainAspectRatio: false,
        tooltips: {
          intersect: false,
        },
      },
    };
  },
};
</script>
