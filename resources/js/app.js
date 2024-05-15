import $ from 'jquery';
import './bootstrap';
import 'laravel-datatables-vite';
import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels';

window.$ = window.jQuery = $;
window.Chart = Chart;
window.ChartDataLabels = ChartDataLabels;