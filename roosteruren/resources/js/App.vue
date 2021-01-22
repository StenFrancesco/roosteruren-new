<template>
    <div id="app">
		<weekrooster></weekrooster>
    </div>
</template>

<script>
import Weekrooster from './components/rooster/weekrooster.vue';

export default {
	name: 'App',
	components: {
		Weekrooster
	}
}
</script>