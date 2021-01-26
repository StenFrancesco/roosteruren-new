<template>
	<div class="container-fluid">
		<div class="weekrooster-header">
			<div class="row">
				<div class="col">
					<b>{{ afdeling.title }}</b>
					<i>(new)</i>
				</div>
				<div class="col text-center" v-for="day in dayinfo" :key="day.date_str">
					{{ day.title_short }}
				</div>
			</div>
			<div class="row" v-for="user in afdeling_users" :key="user.id">
				<div class="col">
					<b>{{ user.name }}</b>
				</div>
				<div class="col" v-for="day in dayinfo" :key="day.date_str">
					<weekrooster-userday :day="day" :user="user" :afdeling="afdeling"></weekrooster-userday>
				</div>
			</div>
			<div class="row">
				<div class="col">
					Totaal:
				</div>
				<div class="col" v-for="day in dayinfo" :key="day.date_str">
					<weekrooster-day-total :day="day" :afdeling="afdeling"></weekrooster-day-total>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

import WeekroosterUserday from './weekrooster-userday.vue';
import WeekroosterDayTotal from './weekrooster-day-total.vue';

export default {
	name: 'Weekrooster',
	computed: {
		dayinfo() {
			return this.$store.state.dayinfo;
		},
		afdeling() {
			return this.$store.state.afdeling;
		},
		afdeling_users() {
			return this.$store.state.afdelingUsers;
		}
	},
	mounted() {
		this.$store.dispatch('SetWeekrooster', {from: 20210118, to: 20210124, afdeling: 2});
	},
	components: {
		WeekroosterUserday,
		WeekroosterDayTotal
	}
}
</script>