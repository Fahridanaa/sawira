import $ from 'jquery';
import './bootstrap';
import 'laravel-datatables-vite';
import 'material-dashboard/assets/js/material-dashboard.min.js';
import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels';

window.$ = window.jQuery = $;
window.Chart = Chart;
window.ChartDataLabels = ChartDataLabels;