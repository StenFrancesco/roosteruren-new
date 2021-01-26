<template>
	<div class="userday">
		<input type="text" class="form-control text-center form-control-sm" :value="tijden" @change="UpdateTijden">
		<input type="text" class="form-control text-center form-control-sm" :value="$filters.int_to_time(uren)" @change="UpdateUren">
		<div v-for="andere_afdeling in andere_afdelingen" class="text-center">
			<b>{{ andere_afdeling.title }}</b><br>
			<i>{{ andere_afdeling.tijden }}</i>
		</div>
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
			return '';
		},
		uren() {
			let userday = this.Userday();
			if (userday) {
				for (let i in userday.rooster) {
					if (userday.rooster[i].afdeling == this.afdeling.id) {
						return userday.rooster[i].uren ? userday.rooster[i].uren : null;
					}
				}
			}
			return null;
		},
		andere_afdelingen() {
			let userday = this.Userday(), andere_afdelingen = [];
			if (userday) {
				for (let i in userday.rooster) {
					if (userday.rooster[i].afdeling != this.afdeling.id) {
						let afdeling = this.$store.getters.afdelingById(userday.rooster[i].afdeling);
						andere_afdelingen.push({
							title: afdeling ? afdeling.title : 'Onbekend',
							tijden: userday.rooster[i].tijden
						});
					}
				}
			}
			return andere_afdelingen;
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

<style scoped>
.userday {
	padding: 10px;
}
</style>