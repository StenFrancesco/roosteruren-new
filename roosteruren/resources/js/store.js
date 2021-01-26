import Vuex from 'vuex';

const store = new Vuex.Store({
	state: {
		dayinfo: [],
		afdeling: {},
		afdelingen: [],
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
					state.userdays[i] = userday;
					return;
				}
			}
			state.userdays.push(userday);
		},
		SET_AFDELINGEN(state, afdelingen) {
			state.afdelingen = afdelingen;
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
		},
		LoadAfdelingen({commit}, params) {
			axios.get('/afdelingen').then((response) => {
				commit('SET_AFDELINGEN', response.data);
			});
		}
	},
	getters: {
		afdelingById: (state) => (id) => {
			return state.afdelingen.find(afdeling => afdeling.id == id);
		}
	}
});

export default store;