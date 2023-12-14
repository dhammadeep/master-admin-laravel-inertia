<template>
	<section class="headerSection2">
		<div class="breadcrumbList desktop">
			<ul>
				<li v-for="item in breadcrumbList" :key="item">
					<a :href="item.href">{{ item.text }}</a>
				</li>
			</ul>
		</div>
		<div>
			<Link v-if="type == 'Add'" :href="url" class="btn btn-primary ms-2 btn-sm"> <i class="fa-solid fa-arrow-left"></i> Back </Link>
			<Link v-if="type == 'List'" :href="url + '/create'" type="button" class="btn btn-success ms-2 btn-sm"> <i class="fa-solid fa-plus"></i> Add </Link>
			<Link v-if="type == 'List'" :href="url + '/missing'" type="button" class="btn btn-secondary ms-2 btn-sm"> <i class="fa-solid fa-bug"></i> Missing </Link>
		</div>
	</section>
</template>

<script>
export default {
	props: {
		url: String,
		type: String,
	},
	data() {
		return {
			breadcrumbList: [
				{
					text: "Home",
					href: "#",
				},
				{
					text: "Agriculture",
					href: "#",
				},
				{
					text: "Activity",
					active: true,
				},
			],
		};
	},
};
</script>
