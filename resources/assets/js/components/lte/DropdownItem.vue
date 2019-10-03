<template>
	<li>
		<a :href="to">
			<i :class="['fa fa-' + icon]"></i>
			<slot></slot>
		</a>
	</li>
</template>

<script>
	export default {
		props: ['to', 'icon']
	}
</script>