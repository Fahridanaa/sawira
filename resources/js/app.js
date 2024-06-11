import jQuery from 'jquery'

window.$ = window.jQuery = jQuery
// import 'jquery-selectric/src/jquery.selectric';
import 'jquery-ui-dist/jquery-ui.min';
import 'jquery.nicescroll';
import swal from 'sweetalert2'
import './bootstrap';
import './scripts';
import './stisla';
import './custom';
import './landingPage';
import 'laravel-datatables-vite';
import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels';

window.swal = swal;
window.Chart = Chart;
window.ChartDataLabels = ChartDataLabels;