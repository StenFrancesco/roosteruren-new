require('./bootstrap');

import { createApp } from 'vue';
import axios from 'axios';

import App from './App.vue';
import store from './store';

const app = createApp(App);
app.use(store);

app.mount('#app');


app.config.globalProperties.$filters = {
	int_to_time(num, parts) {
		if (num === null || isNaN(num)) return '';
		var neg = num < 0;
		num = Math.abs(num);
		if (!parts) parts = 2;
		var uren = Math.floor(num / 3600);
		var min = Math.floor((num - uren * 3600) / 60);
		var sec = Math.floor(num - uren * 3600 - min * 60);
		if (parts == 3) return (neg ? '-' : '') + uren + ':' + (min < 10 ? '0' : '') + min + ':' + (sec < 10 ? '0' : '') + sec;
		else return (neg ? '-' : '') + uren + ':' + (min < 10 ? '0' : '') + min;
	}
}