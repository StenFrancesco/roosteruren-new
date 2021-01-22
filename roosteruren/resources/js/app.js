/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import App from './App.vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import Vuex from 'vuex';

Vue.use(VueAxios, axios);
Vue.use(Vuex);

const store = new Vuex.Store({
	state: {
		dayinfo: [],
		afdeling: {},
		afdelingUsers: [],
		userdays: []
	},
	mutations: {
		SET_DAYINFO(state, dayinfo) {
			state.dayinfo = dayinfo;
		},
		SET_AFDELING(state, afdeling) {
			state.afdeling = afdeling;
		},
		SET_AFDELING_USERS(state, users) {
			state.afdelingUsers = users;
		},
		SET_USERDAYS(state, userdays) {
			state.userdays = userdays;
		},
		SET_USERDAY(state, userday) {
			for (let i in state.userdays) {
				if (state.userdays[i].date == userday.date && state.userdays[i].user == userday.user) {
					Vue.set(state.userdays, i, userday);
					return;
				}
			}
			state.userdays.push(userday);
		}
	},
	actions: {
		SetWeekrooster({commit}, params) {
			axios.get('/dayinfo', {params: {from: params.from, to: params.to, afdeling: params.afdeling}}).then((response) => {
				commit('SET_DAYINFO', response.data);
			});
			axios.get('/afdelingen/' + params.afdeling).then((response) => {
				commit('SET_AFDELING', response.data);
			});
			axios.get('/afdelingen/users/' + params.afdeling).then((response) => {
				commit('SET_AFDELING_USERS', response.data);
			});
			axios.get('/userday', {params: {from: params.from, to: params.to, afdeling: params.afdeling}}).then((response) => {
				commit('SET_USERDAYS', response.data);
			});
		},
		UpdateRoosteritem({commit}, params) {
			axios.post('/roosteritems', params).then((response) => {
				if (response.data.userday) {
					commit('SET_USERDAY', response.data.userday);
				}
			});
		}
	}
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
	store,
	el: '#app',
	render: h => h(App)
});