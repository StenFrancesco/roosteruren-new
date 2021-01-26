<template>
    <div id="app">
		<weekrooster></weekrooster>
    </div>
</template>

<script>
import Weekrooster from './components/rooster/weekrooster.vue';

export default {
	name: 'App',
	mounted() {
		this.$store.dispatch('LoadAfdelingen');
	},
	components: {
		Weekrooster
	}
}
</script>