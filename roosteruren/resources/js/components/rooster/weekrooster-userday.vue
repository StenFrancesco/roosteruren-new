<template>
	<div>
		<input type="text" class="form-control" :value="tijden" @change="UpdateTijden">
		<input type="text" class="form-control" :value="uren" @change="UpdateUren">
	</div>
</template>

<script>

export default {
	props: ['user', 'day', 'afdeling'],
	name: 'WeekroosterUserday',
	computed: {
		tijden() {
			let userday = this.Userday();
			if (userday) {
				for (let i in userday.rooster) {
					if (userday.rooster[i].afdeling == this.afdeling.id) {
						return userday.rooster[i].tijden;
					}
				}
			}
			return false;
		},
		uren() {
			let userday = this.Userday();
			if (userday) {
				for (let i in userday.rooster) {
					if (userday.rooster[i].afdeling == this.afdeling.id) {
						return userday.rooster[i].uren;
					}
				}
			}
			return false;
		}
	},
	methods: {
		Userday() {
			for (let i in this.$store.state.userdays) {
				let userday = this.$store.state.userdays[i];
				if (userday.user == this.user.id && userday.date == this.day.date) {
					return userday;
				}
			}
			return false;
		},
		UpdateTijden(e) {
			this.$store.dispatch('UpdateRoosteritem', {
				user: this.user.id,
				date: this.day.date,
				afdeling: this.afdeling.id,
				tijden: e.target.value
			});
		},
		UpdateUren(e) {
			this.$store.dispatch('UpdateRoosteritem', {
				user: this.user.id,
				date: this.day.date,
				afdeling: this.afdeling.id,
				uren: e.target.value
			});
		}
	}
}
</script>