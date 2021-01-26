<template>
	<div class="text-center">
		{{ $filters.int_to_time(uren_total) }}
	</div>
</template>

<script>

export default {
	props: ['day', 'afdeling'],
	name: 'WeekroosterDayTotal',
	computed: {
		uren_total() {
			var sum = 0;
			for (let i in this.$store.state.userdays) {
				let userday = this.$store.state.userdays[i];
				if (userday.date == this.day.date) {
					for (let i in userday.rooster) {
						if (userday.rooster[i].afdeling == this.afdeling.id) {
							sum += userday.rooster[i].uren;
						}
					}
				}
			}
			return sum;
		}
	},
	methods: {
		
	}
}
</script>